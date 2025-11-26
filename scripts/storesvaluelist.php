<?php
require('config.php');
header('Content-Type: application/json');

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;

$machinetype  = isset($_POST['machinetype']) ? intval($_POST['machinetype']) : 0;
$machinemodel = isset($_POST['machinemodel']) ? intval($_POST['machinemodel']) : 0;
$partname     = isset($_POST['partname']) ? intval($_POST['partname']) : 0;
$month        = $_POST['select_month'] ?? '';

if (empty($month)) {
    echo json_encode(["error" => "Month is required"]);
    exit;
}

// Month calculations
$monthStart = $month . "-01";
$prevMonth = date("Y-m", strtotime("-1 month", strtotime($monthStart)));
$prevMonthEnd = date("Y-m-t", strtotime($prevMonth . "-01"));
$selectedMonthEnd = date("Y-m-t", strtotime($monthStart));

// Build WHERE conditions
$where = ["tpms.date = '$selectedMonthEnd'", "tpms.status = 1"];
if ($machinetype > 0) $where[] = "sp.type = $machinetype";
if ($machinemodel > 0) $where[] = "sp.model = $machinemodel";
if ($partname > 0) $where[] = "sp.id = $partname";
$whereClause = "WHERE " . implode(" AND ", $where);

// Get total count
$countQuery = "
    SELECT COUNT(*) as total 
    FROM spare_parts sp
    INNER JOIN tbl_print_monthly_stock tpms ON sp.id = tpms.spare_parts_id
    $whereClause
";
$totalRecords = $conn->query($countQuery)->fetch_assoc()['total'];

// Get spare parts with LIMIT
$limitClause = ($length == -1) ? "" : "LIMIT $start, $length";
$spQuery = "
    SELECT sp.id, sp.name 
    FROM spare_parts sp
    INNER JOIN tbl_print_monthly_stock tpms ON sp.id = tpms.spare_parts_id
    $whereClause
    ORDER BY sp.name ASC
    $limitClause
";
$spResult = $conn->query($spQuery);

$data = [];

while ($sp = $spResult->fetch_assoc()) {
    $sp_id = $sp['id'];

    // Starting quantity
    $startQuery = "SELECT qty FROM tbl_print_monthly_stock WHERE spare_parts_id = $sp_id AND date = '$prevMonthEnd' AND status = 1 LIMIT 1";
    $startRes = $conn->query($startQuery);
    $startQty = $startRes && $startRes->num_rows ? intval($startRes->fetch_assoc()['qty']) : 0;

    // GRN quantity
    $grnQuery = "
        SELECT SUM(pd.qty) AS grn_qty
        FROM tbl_print_grndetail AS pd
        INNER JOIN tbl_print_grn AS pg ON pd.tbl_print_grn_idtbl_print_grn = pg.idtbl_print_grn
        WHERE pd.tbl_sparepart_id = $sp_id
          AND pd.status = 1 AND pg.status = 1 AND pg.approvestatus = 1
          AND DATE_FORMAT(pg.grndate, '%Y-%m') = '$month'
    ";
    $grnRes = $conn->query($grnQuery);
    $grnQty = $grnRes ? intval($grnRes->fetch_assoc()['grn_qty']) : 0;

    // Consumption quantity
    $consQuery = "
        SELECT SUM(qty) AS total_cons
        FROM (
            SELECT COALESCE(dri.quantity,0) AS qty
            FROM machine_repair_details_items AS dri
            INNER JOIN machine_repair_details AS dr ON dri.machine_repair_details_id = dr.id
            INNER JOIN machine_repairs AS r ON dr.repair_id = r.id
            INNER JOIN machine_ins AS mi ON r.machine_in_id = mi.id
            WHERE dri.service_item_id = $sp_id AND DATE_FORMAT(dri.created_at,'%Y-%m') = '$month'
            
            UNION ALL
            
            SELECT COALESCE(sri.qty,0) AS qty
            FROM machine_service_received_items AS sri
            WHERE sri.spare_part_id = $sp_id AND DATE_FORMAT(sri.created_at,'%Y-%m') = '$month'
        ) AS combined
    ";
    $consRes = $conn->query($consQuery);
    $consQty = $consRes ? intval($consRes->fetch_assoc()['total_cons']) : 0;

    // Finishing quantity
    $finishQuery = "SELECT qty FROM tbl_print_monthly_stock WHERE spare_parts_id = $sp_id AND date = '$selectedMonthEnd' AND status = 1 LIMIT 1";
    $finishRes = $conn->query($finishQuery);
    $finishQty = intval($finishRes->fetch_assoc()['qty']);

    $data[] = [
        "spare_part"   => $sp['name'],
        "starting"     => $startQty,
        "grn"          => $grnQty,
        "consumption"  => $consQty,
        "finishing"    => $finishQty
    ];
}

echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
]);
?>