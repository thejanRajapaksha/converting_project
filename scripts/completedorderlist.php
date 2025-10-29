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
$table = 'tbl_order';

// Table's primary key
$primaryKey = 'idtbl_order';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`idtbl_order`', 'dt' => 'idtbl_order', 'field' => 'idtbl_order' ),
	array( 'db' => '`ud`.`quot_date`', 'dt' => 'quot_date', 'field' => 'quot_date' ),
	array( 'db' => '`uc`.`quantity`', 'dt' => 'quantity', 'field' => 'quantity' ),
	array( 'db' => '`up`.`product`', 'dt' => 'product', 'field' => 'product' ),
	array( 'db' => '`ul`.`completed_date`', 'dt' => 'completed_date', 'field' => 'completed_date' ),
	array( 'db' => '`u`.`is_complete`', 'dt' => 'is_complete', 'field' => 'is_complete' ),
	array( 'db' => '`ub`.`name`', 'dt' => 'name', 'field' => 'name' ),
	array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' )
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

// $getid = $_POST['getid'];

$joinQuery = "FROM `tbl_order` AS `u` 
			  LEFT JOIN `tbl_order_detail` AS `uc` ON (`uc`.`tbl_order_idtbl_order` = `u`.`idtbl_order`)
			  LEFT JOIN `completed_orders` AS `ul` ON (`ul`.`tbl_order_idtbl_order` = `u`.`idtbl_order`)
			  LEFT JOIN `tbl_products` AS `up` ON (`up`.`idtbl_product` = `uc`.`tbl_products_idtbl_products`)
              LEFT JOIN `tbl_inquiry` AS `ua` ON (`ua`.`idtbl_inquiry` = `uc`.`tbl_inquiry_idtbl_inquiry`) 
			  LEFT JOIN `tbl_quotation` AS `ud` ON (`ud`.`tbl_inquiry_idtbl_inquiry` = `ua`.`idtbl_inquiry`)
			  LEFT JOIN `tbl_quotation_detail` AS `uf` ON (`uf`.`tbl_quotation_idtbl_quotation` = `ud`.`idtbl_quotation`)
              LEFT JOIN `tbl_customer` AS `ub` ON (`ub`.`idtbl_customer` = `ud`.`tbl_customer_idtbl_customer`)";

$extraWhere = "`u`.`status` IN (1,2) AND `u`.`is_complete` IN (1) AND `ud`.`status` = 1";
// AND `u`.`tbl_inquiry_idtbl_inquiry` = '$getid'

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
