<?php
require('config.php');
header('Content-Type: application/json');

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$draw   = intval($_POST['draw'] ?? 1);
$start  = intval($_POST['start'] ?? 0);
$length = intval($_POST['length'] ?? 10);

$machinetype = intval($_POST['machinetype'] ?? 0);
$from_date   = $_POST['from_date'] ?? null;
$to_date     = $_POST['to_date'] ?? null;

/* SERVICE QUERY */
/* SERVICE QUERY */
$serviceQuery = "
SELECT 
    mt.id AS machine_type_id,
    mt.name AS machine_type,
    CONCAT(mi.reference, ' (', mi.bar_code, ')') AS machine,
    'Service' AS source,
    sd.sub_total,
    sd.service_charge,
    sd.transport_charge,
    NULL AS repair_charge,
    NULL AS repair_type,
    DATE(s.created_at) AS used_date,       -- ★ ADD THIS
    (sd.sub_total + sd.service_charge + sd.transport_charge) AS total
FROM machine_services AS s
INNER JOIN machine_service_details AS sd ON s.id = sd.service_id
INNER JOIN machine_ins AS mi ON s.machine_in_id = mi.id
LEFT JOIN machine_types AS mt ON mi.machine_type_id = mt.id
";

/* REPAIR QUERY */
$repairQuery = "
SELECT 
    mt.id AS machine_type_id,
    mt.name AS machine_type,
    CONCAT(mi.reference, ' (', mi.bar_code, ')') AS machine,
    'Repair' AS source,
    rd.sub_total,
    rd.repair_charge AS service_charge,
    NULL AS transport_charge,
    rd.repair_charge AS repair_charge,
    rd.repair_type AS repair_type,
    DATE(r.created_at) AS used_date,       -- ★ ADD THIS
    (rd.sub_total + rd.repair_charge) AS total
FROM machine_repairs AS r
INNER JOIN machine_repair_details AS rd ON r.id = rd.repair_id
INNER JOIN machine_ins AS mi ON r.machine_in_id = mi.id
LEFT JOIN machine_types AS mt ON mi.machine_type_id = mt.id
";


$baseQuery = "$serviceQuery UNION ALL $repairQuery";

/* WHERE FILTERS */
$where = " WHERE 1=1 ";
if ($machinetype > 0) {
    $where .= " AND t.machine_type_id = $machinetype ";
}
if ($from_date && $to_date) {
    $where .= " AND DATE(t.used_date) BETWEEN '$from_date' AND '$to_date' ";
} elseif ($from_date) {
    $where .= " AND DATE(t.used_date) >= '$from_date' ";
} elseif ($to_date) {
    $where .= " AND DATE(t.used_date) <= '$to_date' ";
}


/* TOTAL RECORDS */
$totalQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS t";
$totalResult = $conn->query($totalQuery);
$totalData = intval($totalResult->fetch_assoc()['cnt']);

/* FILTERED RECORDS */
$filteredQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS t $where";
$filteredResult = $conn->query($filteredQuery);
$recordsFiltered = intval($filteredResult->fetch_assoc()['cnt']);

/* MAIN QUERY */
$dataQuery = "
SELECT * FROM ($baseQuery) AS t
$where
ORDER BY total DESC
LIMIT $start, $length
";

$resultData = $conn->query($dataQuery);
if (!$resultData) {
    echo json_encode(["error" => $conn->error, "query" => $dataQuery]);
    exit;
}

$data = [];
while ($row = $resultData->fetch_assoc()) {
    $charge = ($row['source'] == 'Service') ? ($row['service_charge'] ?? 0) : ($row['repair_charge'] ?? 0);
    $data[] = [
        "machine_type"      => $row['machine_type'],
        "machine"           => $row['machine'],
        "source"            => $row['source'],
        "sub_total"         => number_format($row['sub_total'], 2),
        "transport_charge"  => number_format($row['transport_charge'] ?? 0, 2),
        "charge"            => number_format($charge, 2),
        "total"             => number_format($row['total'], 2),
        "repair_type"       => $row['repair_type']
    ];
}

echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
]);
