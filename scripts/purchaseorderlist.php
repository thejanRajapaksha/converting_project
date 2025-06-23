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
<<<<<<< Updated upstream
$table = 'tbl_print_porder';

// Table's primary key
$primaryKey = 'idtbl_print_porder';
=======
$table = 'tbl_porder';

// Table's primary key
$primaryKey = 'idtbl_porder';
>>>>>>> Stashed changes

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
<<<<<<< Updated upstream
	array( 'db' => '`u`.`idtbl_print_porder`', 'dt' => 'idtbl_print_porder', 'field' => 'idtbl_print_porder' ),
	array( 'db' => '`u`.`orderdate`', 'dt' => 'orderdate', 'field' => 'orderdate' ),
	array( 'db' => '`u`.`tbl_print_porder_req_idtbl_print_porder_req`', 'dt' => 'tbl_print_porder_req_idtbl_print_porder_req', 'field' => 'tbl_print_porder_req_idtbl_print_porder_req' ),
	array( 'db' => '`u`.`nettotal`', 'dt' => 'nettotal', 'field' => 'nettotal' ),
	array( 'db' => '`u`.`confirmstatus`', 'dt' => 'confirmstatus', 'field' => 'confirmstatus' ),
	array( 'db' => '`u`.`grnconfirm`', 'dt' => 'grnconfirm', 'field' => 'grnconfirm' ),
	array( 'db' => '`u`.`porder_no`', 'dt' => 'porder_no', 'field' => 'porder_no' ),
	array( 'db' => '`ua`.`suppliername`', 'dt' => 'suppliername', 'field' => 'suppliername' ),
	array( 'db' => '`uc`.`type`', 'dt' => 'type', 'field' => 'type' ),
	array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
	array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' ),
	array( 'db' => '`u`.`check_by`', 'dt' => 'check_by', 'field' => 'check_by' ),
	array( 'db' => '`ue`.`name`', 'dt' => 'name', 'field' => 'name' ),
	array(
	'db' => "CONCAT(
		CASE 
			WHEN `u`.`confirmstatus` = 1 THEN '<i class=\"fas fa-check text-success mr-2\"></i>Confirm Order Request'
			WHEN `u`.`confirmstatus` = 2 THEN '<i class=\"fa fa-times text-danger mr-2\"></i>Reject Order Request'
			ELSE '<i class=\"fa fa-spinner text-warning mr-2\"></i>Pending Order Request'
		END
	)",
	'dt' => 'confirmstatus_display',
	'field' => 'confirmstatus_display',
	'as' => 'confirmstatus_display'
	),
		array(
	'db' => "CONCAT(
		CASE 
			WHEN `u`.`grnconfirm` = 1 THEN '<i class=\"fas fa-check text-success mr-2\"></i>GRN Issued'
			ELSE '<i class=\"fa fa-times text-danger mr-2\"></i>Pending GRN'
		END
	)",
	'dt' => 'grnconfirm_display',
	'field' => 'grnconfirm_display',
	'as' => 'grnconfirm_display'
)
=======
	array( 'db' => '`u`.`idtbl_porder`', 'dt' => 'idtbl_porder', 'field' => 'idtbl_porder' ),
	array( 'db' => '`u`.`po_no`', 'dt' => 'po_no', 'field' => 'po_no' ),
	array( 'db' => '`u`.`orderdate`', 'dt' => 'orderdate', 'field' => 'orderdate' ),
	array( 'db' => '`u`.`nettotal`', 'dt' => 'nettotal', 'field' => 'nettotal' ),
	array( 'db' => '`u`.`confirmstatus`', 'dt' => 'confirmstatus', 'field' => 'confirmstatus' ),
	array( 'db' => '`u`.`grnconfirm`', 'dt' => 'grnconfirm', 'field' => 'grnconfirm' ),
	array( 'db' => '`u`.`remark`', 'dt' => 'remark', 'field' => 'remark' ),
	array( 'db' => '`ua`.`suppliername`', 'dt' => 'suppliername', 'field' => 'suppliername' ),
	array( 'db' => '`ub`.`location`', 'dt' => 'location', 'field' => 'location' ),
	array( 'db' => '`uc`.`type`', 'dt' => 'type', 'field' => 'type' ),
	array( 'db' => '`u`.`status`', 'dt' => 'status', 'field' => 'status' )
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
$companyID = $_POST['company_id'];

$joinQuery = "FROM `tbl_print_porder` AS `u` LEFT JOIN `tbl_supplier` AS `ua` ON (`ua`.`idtbl_supplier` = `u`.`tbl_supplier_idtbl_supplier`) 
	LEFT JOIN `tbl_order_type` AS `uc` ON (`uc`.`idtbl_order_type` = `u`.`tbl_order_type_idtbl_order_type`) 
	LEFT JOIN `tbl_print_porder_req` AS `ud` ON (`ud`.`idtbl_print_porder_req` = `u`.`tbl_print_porder_req_idtbl_print_porder_req`) 
	LEFT JOIN `tbl_user` AS `ue` ON (`ue`.`idtbl_user` = `u`.`check_by`)";

$extraWhere = "`u`.`status` IN (1,2) AND `u`.`tbl_company_idtbl_company`='$companyID'";
=======

$joinQuery = "FROM `tbl_porder` AS `u`
 LEFT JOIN `tbl_supplier` AS `ua` ON (`ua`.`idtbl_supplier` = `u`.`tbl_supplier_idtbl_supplier`) 
 LEFT JOIN `tbl_location` AS `ub` ON (`ub`.`idtbl_location` = `u`.`tbl_location_idtbl_location`) 
 LEFT JOIN `tbl_order_type` AS `uc` ON (`uc`.`idtbl_order_type` = `u`.`tbl_order_type_idtbl_order_type`)";

$extraWhere = "`u`.`status` IN (1,2)";
>>>>>>> Stashed changes

echo json_encode(
	SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
