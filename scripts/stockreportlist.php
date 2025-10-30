<?php
$table = 'tbl_print_stock';
$primaryKey = 'idtbl_print_stock';

$columns = array(
    array( 'db' => '`u`.`idtbl_print_stock`', 'dt' => 'idtbl_print_stock', 'field' => 'idtbl_print_stock' ),
    array( 'db' => '`ua`.`name`', 'dt' => 'name', 'field' => 'name' ),
    array( 'db' => '`u`.`batchno`', 'dt' => 'batchno', 'field' => 'batchno' ),
    array( 'db' => '`u`.`qty`', 'dt' => 'qty', 'field' => 'qty' ),
    array( 'db' => '`u`.`unitprice`', 'dt' => 'unitprice', 'field' => 'unitprice' ),
    array( 'db' => '`sup`.`suppliername`', 'dt' => 'suppliername', 'field' => 'suppliername' )
);

require('config.php');
$sql_details = array(
    'user' => $db_username,
    'pass' => $db_password,
    'db'   => $db_name,
    'host' => $db_host
);

require('ssp.customized.class.php');

$type     = isset($_POST['type']) ? intval($_POST['type']) : 0;
$supplier = isset($_POST['supplier']) ? intval($_POST['supplier']) : 0;
$machinemodel = isset($_POST['machinemodel']) ? intval($_POST['machinemodel']) : 0;
$partname = isset($_POST['partname']) ? intval($_POST['partname']) : 0;
$machinetype = isset($_POST['machinetype']) ? intval($_POST['machinetype']) : 0;
$machinemodel = isset($_POST['machinemodel']) ? intval($_POST['machinemodel']) : 0;

// default extraWhere
$extraWhere = " `u`.`status` = 1 AND `u`.`qty` > 0 ";

// Build joinQuery depending on type
if ($type == 1) {
    $joinQuery = "FROM `tbl_print_stock` AS `u`
                  LEFT JOIN `spare_parts` AS `ua`
                  ON `u`.`tbl_sparepart_id` = `ua`.`id`
                  LEFT JOIN `spare_part_suppliers` AS `sps`
                  ON `u`.`tbl_sparepart_id` = `sps`.`sp_id`
                  LEFT JOIN `tbl_supplier` AS `sup`
                  ON `sps`.`supplier_id` = `sup`.`idtbl_supplier`";
} elseif ($type == 2) {
    $joinQuery = "FROM `tbl_print_stock` AS `u`
                  LEFT JOIN `materials` AS `ua` 
                  ON `u`.`tbl_print_material_info_idtbl_print_material_info` = `ua`.`id`";
} elseif ($type == 3) {
    $joinQuery = "FROM `tbl_print_stock` AS `u`
                  LEFT JOIN `machines` AS `ua` 
                  ON `u`.`tbl_machine_id` = `ua`.`id`";
} else {
    // fallback to spare_parts
    $joinQuery = "FROM `tbl_print_stock` AS `u`
                  LEFT JOIN `spare_parts` AS `ua` 
                  ON `u`.`tbl_sparepart_id` = `ua`.`id`";
}

// supplier filter
if ($supplier > 0) {
    $extraWhere .= " AND `u`.`supplier_id` = {$supplier}";
}
if ($machinemodel > 0 && $type == 1) {
    $extraWhere .= " AND `ua`.`model` = {$machinemodel}";
}
if ($partname > 0 && $type == 1) {
    $extraWhere .= " AND `ua`.`id` = {$partname}";
}
if ($machinetype > 0 && $type == 1) {
    $extraWhere .= " AND ua.type = {$machinetype}";
}

echo json_encode(
    SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
