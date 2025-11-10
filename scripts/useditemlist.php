<?php
require('config.php');
header('Content-Type: application/json');

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check DB connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// DataTables server-side params
$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;

// Filters
$machinetype  = isset($_POST['machinetype']) ? intval($_POST['machinetype']) : 0;
$machinemodel = isset($_POST['machinemodel']) ? intval($_POST['machinemodel']) : 0;
$machine      = isset($_POST['machine']) ? intval($_POST['machine']) : 0;
$from_date    = !empty($_POST['from_date']) ? $_POST['from_date'] : null;
$to_date      = !empty($_POST['to_date']) ? $_POST['to_date'] : null;

// Base UNION query
$baseQuery = "
SELECT 
    sp.name AS spare_part_name,
    sp.unit_price AS spares_unit_price,
    COALESCE(dri.quantity,0) AS qty,
    mt.id AS machine_type_id,
    mt.name AS machine_type,
    mm.id AS machine_model_id,
    mm.name AS machine_model,
    mi.id AS machine_id,
    mi.reference AS machine_name,
    'Repair' AS source,
    DATE(dri.created_at) AS used_date
FROM machine_repair_details_items AS dri
INNER JOIN machine_repair_details AS dr ON dri.machine_repair_details_id = dr.id
INNER JOIN machine_repairs AS r ON dr.repair_id = r.id
INNER JOIN machine_ins AS mi ON r.machine_in_id = mi.id
LEFT JOIN machine_models AS mm ON mi.machine_model_id = mm.id
LEFT JOIN machine_types AS mt ON mi.machine_type_id = mt.id
LEFT JOIN spare_parts AS sp ON dri.service_item_id = sp.id

UNION ALL

SELECT 
    sp.name AS spare_part_name,
    sp.unit_price AS spares_unit_price,
    COALESCE(sri.qty,0) AS qty,
    mt.id AS machine_type_id,
    mt.name AS machine_type,
    mm.id AS machine_model_id,
    mm.name AS machine_model,
    mi.id AS machine_id,
    mi.reference AS machine_name,
    'Service' AS source,
    DATE(sri.created_at) AS used_date
FROM machine_service_received_items AS sri
INNER JOIN machine_services AS s ON sri.machine_service_id = s.id
INNER JOIN machine_ins AS mi ON s.machine_in_id = mi.id
LEFT JOIN machine_models AS mm ON mi.machine_model_id = mm.id
LEFT JOIN machine_types AS mt ON mi.machine_type_id = mt.id
LEFT JOIN spare_parts AS sp ON sri.spare_part_id = sp.id
";

// Initialize WHERE clause
$where = " WHERE 1=1 ";

// Apply filters
if ($machinetype > 0) {
    $where .= " AND combined.machine_type_id = $machinetype ";
}
if ($machinemodel > 0) {
    $where .= " AND combined.machine_model_id = $machinemodel ";
}
if ($machine > 0) {
    $where .= " AND combined.machine_id = $machine ";
}
if ($from_date && $to_date) {
    $where .= " AND combined.used_date BETWEEN '$from_date' AND '$to_date' ";
} elseif ($from_date) {
    $where .= " AND combined.used_date >= '$from_date' ";
} elseif ($to_date) {
    $where .= " AND combined.used_date <= '$to_date' ";
}

// Count total records
$totalQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS combined";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult ? intval($totalResult->fetch_assoc()['cnt']) : 0;

// Count filtered records
$filteredQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS combined $where";
$filteredResult = $conn->query($filteredQuery);
$recordsFiltered = $filteredResult ? intval($filteredResult->fetch_assoc()['cnt']) : 0;

// Fetch paginated data
$dataQuery = "SELECT * FROM ($baseQuery) AS combined
              $where
              ORDER BY combined.source ASC, combined.machine_name ASC
              LIMIT $start, $length";

$dataResult = $conn->query($dataQuery);
$data = [];

if ($dataResult) {
    while ($row = $dataResult->fetch_assoc()) {
        $data[] = [
            'source' => $row['source'],
            'machine_type' => $row['machine_type'],
            'machine_model' => $row['machine_model'],
            'machine_name' => $row['machine_name'],
            'spare_part_name' => $row['spare_part_name'],
            'unit_price' => $row['spares_unit_price'],
            'qty' => $row['qty'],
            'used_date' => $row['used_date'],
        ];
    }
}

// Output JSON
echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
], JSON_UNESCAPED_UNICODE);
?>
