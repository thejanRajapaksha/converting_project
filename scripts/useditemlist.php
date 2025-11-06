<?php
require('config.php');
header('Content-Type: application/json');

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check for DB connection errors
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// DataTables server-side parameters
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;


// Filters
$machinetype  = isset($_POST['machinetype']) ? intval($_POST['machinetype']) : 0;
$machinemodel = isset($_POST['machinemodel']) ? intval($_POST['machinemodel']) : 0;
$machine      = isset($_POST['machine']) ? intval($_POST['machine']) : 0;
$search_date  = isset($_POST['search_date']) && $_POST['search_date'] != '' ? $_POST['search_date'] : null;


// Base query (UNION of Repairs and Services)
$baseQuery = "
SELECT 
    sp.name AS spare_part_name,
    sp.unit_price AS spares_unit_price,
    COALESCE(dri.quantity,0) AS qty,
    mt.name AS machine_type,
    mm.name AS machine_model,
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
    sp.unit_price As spares_unit_price,
    COALESCE(sri.qty,0) AS qty,
    mt.name AS machine_type,
    mm.name AS machine_model,
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

$where = " WHERE 1=1 ";

if ($machinetype > 0) {
    $where .= " AND mt.id = $machinetype ";
}
if ($machinemodel > 0) {
    $where .= " AND mm.id = $machinemodel ";
}
if ($machine > 0) {
    $where .= " AND mi.id = $machine ";
}

if ($search_date) {
    $where .= " AND DATE(combined.used_date) = '$search_date' ";
}


// Total records without filtering
$totalQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS combined";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult ? intval($totalResult->fetch_assoc()['cnt']) : 0;

// Total records with filtering
$filteredQuery = "SELECT COUNT(*) AS cnt FROM ($baseQuery) AS combined
                  LEFT JOIN machine_types AS mt ON combined.machine_type = mt.name
                  LEFT JOIN machine_models AS mm ON combined.machine_model = mm.name
                  LEFT JOIN machine_ins AS mi ON combined.machine_name = mi.reference
                  $where";
$filteredResult = $conn->query($filteredQuery);
$recordsFiltered = $filteredResult ? intval($filteredResult->fetch_assoc()['cnt']) : 0;

// Fetch data with limit for pagination
$dataQuery = "SELECT * FROM ($baseQuery) AS combined
              LEFT JOIN machine_types AS mt ON combined.machine_type = mt.name
              LEFT JOIN machine_models AS mm ON combined.machine_model = mm.name
              LEFT JOIN machine_ins AS mi ON combined.machine_name = mi.reference
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
            'used_date' => $row['created_at']
        ];
    }
}

// Output JSON for DataTables
echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
], JSON_UNESCAPED_UNICODE);
?>
