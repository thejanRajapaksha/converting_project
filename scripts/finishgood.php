<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_finished_goods';

// Table's primary key
$primaryKey = 'id1tbl_finished_goods';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'fg.id1tbl_finished_goods', 'dt' => 'id1tbl_finished_goods', 'field' => 'id1tbl_finished_goods'),
    array('db' => 'p.product', 'dt' => 'product', 'field' => 'product'),
    array('db' => 'fg.quantity', 'dt' => 'quantity', 'field' => 'quantity'),
    array('db' => 'sl.name', 'dt' => 'name', 'field' => 'name'),
    array('db' => 'fg.status', 'dt' => 'status', 'field' => 'status'),
);


// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$joinQuery = "
FROM `tbl_finished_goods` AS `fg`
LEFT JOIN `tbl_stock_location` AS `sl` 
    ON `sl`.`idtbl_location` = `fg`.`tbl_stock_location_idtbl_location`
LEFT JOIN `tbl_order` AS `o` 
    ON `o`.`idtbl_order` = `fg`.`tbl_order_idtbl_order`
LEFT JOIN `tbl_order_detail` AS `od` 
    ON `od`.`tbl_order_idtbl_order` = `o`.`idtbl_order`
LEFT JOIN `tbl_products` AS `p` 
    ON `p`.`idtbl_product` = `od`.`tbl_products_idtbl_products`
";


$extraWhere = "`fg`.`status` IN (1, 2)";

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
