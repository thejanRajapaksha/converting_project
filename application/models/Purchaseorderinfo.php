<?php class Purchaseorderinfo extends CI_Model {
	public function Getcompany() {
		$this->db->select('`idtbl_company`, `company`');
		$this->db->from('tbl_company');
		$this->db->where('status', 1);

		return $respond=$this->db->get();
	}

	public function Getmeasuretype() {
		$this->db->select('`idtbl_mesurements`, `measure_type`');
		$this->db->from('tbl_measurements');
		$this->db->where('status', 1);

		return $respond=$this->db->get();
	}

	public function Getporder() {

		$comapnyID=$_SESSION['company_id'];

		$this->db->select('`idtbl_print_porder_req`,`porder_req_no`');
		$this->db->from('tbl_print_porder_req');
		$this->db->where('status', 1);
		$this->db->where('confirmstatus', 1);
        $this->db->where('porderconfirm', 0);
		$this->db->where('tbl_print_porder_req.tbl_company_idtbl_company', $comapnyID);


		return $respond=$this->db->get();
	}

	public function Getservicetype() {
		$this->db->select('`idtbl_service_type`, `service_name`');
		$this->db->from('tbl_service_type');
		$this->db->where('status', 1);

		return $respond=$this->db->get();
	}

	public function Getsupplier() {

		$companyID=$_SESSION['company_id'];

		$this->db->select('`idtbl_supplier`, `suppliername`');
		$this->db->from('tbl_supplier');
		$this->db->where('status', 1);
		$this->db->where('company_id', $companyID);

		return $respond=$this->db->get();
	}

	public function Getordertype() {
		$this->db->select('`idtbl_order_type`, `type`');
		$this->db->from('tbl_order_type');
		$this->db->where('status', 1);

		return $respond=$this->db->get();
	}

    public function Getproductaccoporder(){
        $recordID=$this->input->post('recordID');

        $sql="SELECT `tbl_print_material_info`.`idtbl_print_material_info`, `tbl_print_material_info`.`materialinfocode`, `tbl_print_material_info`.`materialname` FROM `tbl_print_porder_req_detail` LEFT JOIN `tbl_print_material_info` ON `tbl_print_material_info`.`idtbl_print_material_info`=`tbl_print_porder_req_detail`.`tbl_material_id` WHERE `tbl_print_material_info`.`status`=? AND `tbl_print_porder_req_detail`.`tbl_print_porder_idtbl_print_porder`=?";
        $respond=$this->db->query($sql, array(1, $recordID));

        echo json_encode($respond->result());
    }

	public function Getproductformachine() {
		$recordID=$this->input->post('recordID');

		$sql="SELECT `tbl_machine`.`idtbl_machine`, `tbl_machine`.`machine` FROM `tbl_print_porder_req_detail` LEFT JOIN `tbl_machine` ON `tbl_machine`.`idtbl_machine` = `tbl_print_porder_req_detail`.`tbl_machine_id` WHERE `tbl_machine`.`status` = ? AND `tbl_print_porder_req_detail`.`tbl_print_porder_idtbl_print_porder` = ?";
		$respond=$this->db->query($sql, array(1, $recordID));

		echo json_encode($respond->result());
	}


    public function Getservicetyperequest() {
		$recordID=$this->input->post('recordID');

		$sql="SELECT `tbl_service_type`.`idtbl_service_type`, `tbl_service_type`.`service_name` FROM `tbl_print_porder_req_detail` LEFT JOIN `tbl_service_type` ON `tbl_service_type`.`idtbl_service_type` = `tbl_print_porder_req_detail`.`tbl_service_type_id` WHERE `tbl_service_type`.`status` = ? AND `tbl_print_porder_req_detail`.`tbl_print_porder_idtbl_print_porder` = ?";
		$respond=$this->db->query($sql, array(1, $recordID));

		echo json_encode($respond->result());
	}


    public function Getproductforsparepart() {
		$recordID=$this->input->post('recordID');

		$sql="SELECT `spare_parts`.`id`, `spare_parts`.`name` FROM `tbl_print_porder_req_detail` LEFT JOIN `spare_parts` ON `spare_parts`.`id` = `tbl_print_porder_req_detail`.`tbl_sparepart_id` WHERE `spare_parts`.`active` = ? AND `tbl_print_porder_req_detail`.`tbl_print_porder_idtbl_print_porder` = ?";
		$respond=$this->db->query($sql, array(1, $recordID));

		echo json_encode($respond->result());
	}

	public function Getproductinfoaccoproduct() {
		$recordID = $this->input->post('recordID');
		$supplier = $this->input->post('supplier');
	
		$this->db->select('unitprice');
		$this->db->from('tbl_print_material_info');
		$this->db->where('status', 1);
		$this->db->where('idtbl_print_material_info', $recordID);
		$respond = $this->db->get();
	
		$unitprice = $this->getLatestGRNUnitPrice($supplier, $recordID);
	
		$obj = new stdClass();
		if ($respond->num_rows() > 0) {
			$obj->unitprice = ($unitprice !== null) ? $unitprice : $respond->row(0)->unitprice;
		} else {
			$obj->unitprice = 0;
		}
	
		echo json_encode($obj);
	}

	public function Getproductinfosparepart() {
		$recordID = $this->input->post('recordID');
		$supplier = $this->input->post('supplier');
	
		$this->db->select('unit_price');
		$this->db->from('spare_parts');
		$this->db->where('active', 1);
		$this->db->where('id', $recordID);
		$respond = $this->db->get();
	
		$unitprice = $this->getLatestGRNUnitPrice($supplier, $recordID);
	
		$obj = new stdClass();
		if ($respond->num_rows() > 0) {
			$obj->unitprice = ($unitprice !== null) ? $unitprice : $respond->row(0)->unit_price;
		} else {
			$obj->unitprice = 0;
		}
	
		echo json_encode($obj);
	}
	
	private function getLatestGRNUnitPrice($supplier, $recordID) {
		$this->db->select('grnd.unitprice');
		$this->db->from('tbl_print_grndetail grnd');
		$this->db->join('tbl_print_grn grn', 'grn.idtbl_print_grn = grnd.tbl_print_grn_idtbl_print_grn');
		$this->db->where('grn.tbl_supplier_idtbl_supplier', $supplier);
		$this->db->where('grnd.tbl_print_material_info_idtbl_print_material_info', $recordID);
		$this->db->where('grn.status', 1);
		$this->db->order_by('grn.insertdatetime', 'desc');
		$this->db->limit(1);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row(0)->unitprice : null;
	}
	
	public function Getpiecesforqty() {
		$uomID = $this->input->post('recordID');
		$productId = $this->input->post('productId');
		$qty = $this->input->post('qty');
	
		$this->db->select('qty, measure_type');
		$this->db->from('tbl_material_uom_qty');
		$this->db->join('tbl_measurements', 'tbl_measurements.idtbl_mesurements=tbl_material_uom_qty.measurement');
		$this->db->join('tbl_material_uom_qty_has_tbl_print_material_info', 'tbl_material_uom_qty_has_tbl_print_material_info.tbl_material_uom_qty_idtbl_material_uom_qty =tbl_material_uom_qty.idtbl_material_uom_qty');
		$this->db->where('tbl_print_material_info_idtbl_print_material_info', $productId);
		$this->db->where('tbl_measurements_idtbl_mesurements', $uomID);
		$this->db->where('tbl_material_uom_qty.status', 1);
	
		$query = $this->db->get();
		$result = $query->row();
	
		$response = new stdClass();
		if ($result) {
			$response->piecesper_qty = $result->qty*$qty;  
			$response->measure_type = $result->measure_type;  
		} else {
			$response->piecesper_qty = 0;
			$response->measure_type = 0;
		}
	
		echo json_encode($response);
	}

    public function Getproductinfoamachine(){
        $recordID=$this->input->post('recordID');
		$purchaseorder_id=$this->input->post('purchaseorder_id');

        $this->db->select('`qty`, `unitprice`, `tbl_measurements_idtbl_measurements`');
        $this->db->from('tbl_print_porder_req_detail');
        $this->db->where('status', 1);
		$this->db->where('tbl_print_porder_idtbl_print_porder', $purchaseorder_id);
        $this->db->where('tbl_machine_id', $recordID);
        $respond=$this->db->get();

		$this->db->select('*');
        $this->db->from('tbl_print_stock');
        $this->db->where('status', 1);
		$this->db->where('tbl_machine_id ', $recordID);
		$this->db->order_by('idtbl_print_stock', 'desc');
		$this->db->limit(1);
        $respond2=$this->db->get();
		$count = $respond2->num_rows();

		$unitprice='';
		if($respond2->num_rows()>0){
            $obj=new stdClass();
            $unitprice=$respond2->row(0)->unitprice;
        }


        if($respond->num_rows()>0){
            $obj=new stdClass();
            $obj->qty=$respond->row(0)->qty;
			($count==0 ?  $obj->unitprice=$respond->row(0)->unitprice : $obj->unitprice=$unitprice);
            $obj->uom=$respond->row(0)->tbl_measurements_idtbl_measurements;
        }

        else{
            $obj=new stdClass();
            $obj->qty=0;
            $obj->unitprice=0;
            $obj->uom='';
        }
        echo json_encode($obj);
    }


    public function Getproductinfoservice(){
        $recordID=$this->input->post('recordID');
		$purchaseorder_id=$this->input->post('purchaseorder_id');

        $this->db->select('`qty`, `unitprice`, `tbl_measurements_idtbl_measurements`');
        $this->db->from('tbl_print_porder_req_detail');
        $this->db->where('status', 1);
		$this->db->where('tbl_print_porder_idtbl_print_porder', $purchaseorder_id);
        $this->db->where('tbl_service_type_id', $recordID);

        $respond=$this->db->get();

        if($respond->num_rows()>0){
            $obj=new stdClass();
            $obj->qty=$respond->row(0)->qty;
            $obj->unitprice=$respond->row(0)->unitprice;
            $obj->uom=$respond->row(0)->tbl_measurements_idtbl_measurements;
        }

        else{
            $obj=new stdClass();
            $obj->qty=0;
            $obj->unitprice=0;
            $obj->uom='';
        }
        echo json_encode($obj);
    }


	public function Purchaseorderinsertupdate() {
		$this->db->trans_begin();

		$userID=$_SESSION['userid'];

		$companyID=$_SESSION['company_id'];


		$tableData=$this->input->post('tableData');
		$orderdate=$this->input->post('orderdate');
		$discounttotal=$this->input->post('discounttotal');
		$vat=$this->input->post('vat');
		$vat_type=$this->input->post('vat_type');
		$vatamount=$this->input->post('vatamount');
		$discount=$this->input->post('discount');
		$vatamounttotal=$this->input->post('vatamounttotal');
		$grosstotal=$this->input->post('grosstotal');
		$total=$this->input->post('total');
		$remark=$this->input->post('remark');
		$supplier=$this->input->post('supplier');
		$location=$this->input->post('location');
		$ordertype=$this->input->post('ordertype');
		$company_id=$this->input->post('company_id');
		$branch_id=$this->input->post('branch_id');
		$porderrequest=$this->input->post('porderrequest');
		$modeltotalpayment=$this->input->post('modeltotalpayment');

		$updatedatetime=date('Y-m-d H:i:s');

		$data=array(
			'orderdate'=> $orderdate,
			'duedate'=> 'null',
			'subtotal'=>'0',
			'vat'=> $vat,
			'vat_type' => $vat_type,
			'vattotamount'=> $vatamount,
			'discountamount'=> '0',
			'nettotal'=>$modeltotalpayment,
			'confirmstatus'=> '0',
			'grnconfirm'=>'0',
			'remark'=> $remark,
			'status'=> '1',
			'insertdatetime'=> $updatedatetime,
			'tbl_user_idtbl_user'=> $userID,
			'tbl_supplier_idtbl_supplier'=> $supplier,
			'tbl_order_type_idtbl_order_type'=> $ordertype,
			'tbl_service_type_idtbl_service_type'=>'0',
			'tbl_company_idtbl_company'=> $company_id, 
			'tbl_company_branch_idtbl_company_branch'=> $branch_id, 
			'tbl_print_porder_req_idtbl_print_porder_req'=> $porderrequest,

		);

		$this->db->insert('tbl_print_porder', $data);

		$porderID=$this->db->insert_id();


		if($ordertype==3) {
			foreach ($tableData as $rowtabledata) {
				$materialname=$rowtabledata['col_1'];
				$comment=$rowtabledata['col_2'];
				$materialID=$rowtabledata['col_3'];
				$qty=$rowtabledata['col_4'];
				$uom=$rowtabledata['col_5'];
				$uomID=$rowtabledata['col_6'];
				$unit=$rowtabledata['col_7'];
				$packetprice=$rowtabledata['col_8'];
				$nettotal=$rowtabledata['col_9'];
				$pieces=$rowtabledata['col_11'];
				

				$dataone=array(
					'qty'=> $qty,
					'pieces'=> $pieces,
					'tbl_measurements_idtbl_measurements'=> $uomID,
					'unitprice'=> $unit,
					'packetprice'=> $packetprice,
					'discount'=>'0',
					'vat'=>'0',
					'vatamount'=>'0',
					'grossprice'=>'0',
					'netprice'=>  $nettotal,
					'comment'=> $comment,
					'status'=> '1',
					'insertdatetime'=> $updatedatetime,
					'tbl_print_porder_idtbl_print_porder'=> $porderID,
					'tbl_material_id'=> $materialID,
					'tbl_user_idtbl_user'=> $userID
					
				);

				$this->db->insert('tbl_print_porder_detail', $dataone);
			}
		}

		else if($ordertype==4) {
			foreach ($tableData as $rowtabledata) {
				$materialname=$rowtabledata['col_1'];
				$comment=$rowtabledata['col_2'];
				$materialID=$rowtabledata['col_3'];
				$qty=$rowtabledata['col_4'];
				$uom=$rowtabledata['col_5'];
				$uomID=$rowtabledata['col_6'];
				$unit=$rowtabledata['col_7'];
				$nettotal=$rowtabledata['col_9'];

				$dataone=array(
					'qty'=> $qty,
					'unitprice'=> $unit,
					'tbl_measurements_idtbl_measurements'=> $uomID,
					'discount'=>'0',
					'vat'=> '0',
					'vatamount'=>'0',
					'grossprice'=>'0',
					'netprice'=> $nettotal,
					'comment'=> $comment,
					'status'=> '1',
					'insertdatetime'=> $updatedatetime,
					'tbl_print_porder_idtbl_print_porder'=> $porderID,
					'tbl_machine_id'=> $materialID,
					'tbl_user_idtbl_user'=> $userID
				);

				$this->db->insert('tbl_print_porder_detail', $dataone);
			}
		}

		else if($ordertype==1) {
			foreach ($tableData as $rowtabledata) {
				$materialname=$rowtabledata['col_1'];
				$comment=$rowtabledata['col_2'];
				$materialID=$rowtabledata['col_3'];
				$qty=$rowtabledata['col_4'];
				$uom=$rowtabledata['col_5'];
				$uomID=$rowtabledata['col_6'];
				$unit=$rowtabledata['col_7'];
				$nettotal=$rowtabledata['col_9'];

				$dataone=array('qty'=> $qty,
					'unitprice'=> $unit,
					'tbl_measurements_idtbl_measurements'=> $uomID,
					'discount'=> $discount,
					'vat'=> $vat,
					'vatamount'=>'0',
					'grossprice'=>'0',
					'netprice'=> $nettotal,
					'comment'=> $comment,
					'status'=> '1',
					'insertdatetime'=> $updatedatetime,
					'tbl_print_porder_idtbl_print_porder'=> $porderID,
					'tbl_sparepart_id'=> $materialID,
					'tbl_user_idtbl_user'=> $userID
				);

				$this->db->insert('tbl_print_porder_detail', $dataone);
			}
		}

		else {
			foreach ($tableData as $rowtabledata) {
				$materialname=$rowtabledata['col_1'];
				$comment=$rowtabledata['col_2'];
				$materialID=$rowtabledata['col_3'];
				$qty=$rowtabledata['col_4'];
				$uom=$rowtabledata['col_5'];
				$uomID=$rowtabledata['col_6'];
				$unit=$rowtabledata['col_7'];
				$nettotal=$rowtabledata['col_9'];

				$dataone=array('qty'=> $qty,
					'unitprice'=> $unit,
					'tbl_measurements_idtbl_measurements'=> $uomID,
					'discount'=>'0',
					'vat'=>'0',
					'vatamount'=>'0',
					'grossprice'=> '0',
					'netprice'=> $nettotal,
					'comment'=> $comment,
					'status'=> '1',
					'insertdatetime'=> $updatedatetime,
					'tbl_print_porder_idtbl_print_porder'=> $porderID,
					'tbl_service_type_id'=> $materialID,
					'tbl_user_idtbl_user'=> $userID
				);

				$this->db->insert('tbl_print_porder_detail', $dataone);
			}
		}

		// Generate the PO NO
		
		$currentYear = date("Y", strtotime($orderdate));
		$currentMonth = date("m", strtotime($orderdate));
	
		if ($currentMonth < 4) { //03
			$startDate = $currentYear."-04-01";
			$startDate = date('Y-m-d',  strtotime($startDate.'-1 year'));
			$endDate = $currentYear."-03-31";
		} else {
			$startDate = $currentYear."-04-01";
			$endDate = $currentYear."-03-31";
			$endDate = date('Y-m-d',  strtotime($endDate.'+1 year'));
		}
	
		$fromyear = date("Y-m-d", strtotime($startDate));
		$toyear = date("Y-m-d", strtotime($endDate));

		$this->db->select('porder_no');
		$this->db->from('tbl_print_porder');
		$this->db->where('tbl_company_idtbl_company', $companyID);
        $this->db->where("DATE(insertdatetime) >=", $fromyear);
        $this->db->where("DATE(insertdatetime) <=", $toyear);
		$this->db->order_by('porder_no', 'DESC');
		$this->db->limit(1);
		$respond = $this->db->get();
		
		if ($respond->num_rows() > 0) {
			$last_po_no = $respond->row()->porder_no;
			$po_number = intval(substr($last_po_no, -4));
			$count = $po_number;
		} else {
			$count = 0;
		}

		$count++; 
		$countPrefix = sprintf('%04d', $count);

		$yearDigit = substr(date("Y", strtotime($fromyear)), -2);

		$reqno = 'PO' . $yearDigit . $countPrefix;

		$datadetail = array(
			'porder_no'=> $reqno, 
			'updatedatetime'=> $updatedatetime
		);

		$this->db->where('idtbl_print_porder', $porderID);
		$this->db->update('tbl_print_porder', $datadetail);


		if ($this->db->trans_status()===TRUE) {
			$this->db->trans_commit();

			$actionObj=new stdClass();
			$actionObj->icon='fas fa-save';
			$actionObj->title='';
			$actionObj->message='Record Added Successfully';
			$actionObj->url='';
			$actionObj->target='_blank';
			$actionObj->type='success';

			$actionJSON=json_encode($actionObj);

			$obj=new stdClass();
			$obj->status=1;
			$obj->action=$actionJSON;

			echo json_encode($obj);
		}

		else {
			$this->db->trans_rollback();

			$actionObj=new stdClass();
			$actionObj->icon='fas fa-exclamation-triangle';
			$actionObj->title='';
			$actionObj->message='Record Error';
			$actionObj->url='';
			$actionObj->target='_blank';
			$actionObj->type='danger';

			$actionJSON=json_encode($actionObj);

			$obj=new stdClass();
			$obj->status=0;
			$obj->action=$actionJSON;

			echo json_encode($obj);
		}
	}

	public function Purchaseorderview() {
		$recordID=$this->input->post('recordID');

		$sql="SELECT `u`.*, `ua`.`suppliername`, `ua`.`address_line1`, `ub`.`branch`, `ub`.`phone`, `ub`.`address1`, `ub`.`address2`, `ub`.`mobile`, `ub`.`email` AS `locemail`, `uc`.`company` FROM `tbl_print_porder` AS `u` LEFT JOIN `tbl_supplier` AS `ua` ON (`ua`.`idtbl_supplier` = `u`.`tbl_supplier_idtbl_supplier`) LEFT JOIN `tbl_company_branch` AS `ub` ON (`ub`.`idtbl_company_branch` = `u`.`tbl_company_branch_idtbl_company_branch`) LEFT JOIN `tbl_company` AS `uc` ON (`uc`.`idtbl_company` = `u`.`tbl_company_idtbl_company`) WHERE `u`.`status`=? AND `u`.`idtbl_print_porder`=?";
		$respond=$this->db->query($sql, array(1, $recordID));

		$this->db->select('tbl_print_porder_detail.*,tbl_print_porder.porder_no,tbl_print_porder.orderdate As orderdate,tbl_print_porder.tbl_order_type_idtbl_order_type, tbl_print_material_info.materialinfocode, tbl_print_material_info.materialname,tbl_machine.machine,tbl_machine.machinecode, tbl_service_type.service_name, tbl_measurements.measure_type, spare_parts.name AS spare_part_name, spare_parts.part_no AS spare_part_no');
		$this->db->from('tbl_print_porder_detail');
		$this->db->join('tbl_print_material_info', 'tbl_print_material_info.idtbl_print_material_info = tbl_print_porder_detail.tbl_material_id', 'left');
		$this->db->join('tbl_measurements', 'tbl_measurements.idtbl_mesurements = tbl_print_porder_detail.tbl_measurements_idtbl_measurements', 'left'); // get measurements 
		$this->db->join('tbl_machine', 'tbl_machine.idtbl_machine = tbl_print_porder_detail.tbl_machine_id', 'left');
		$this->db->join('spare_parts', 'spare_parts.id = tbl_print_porder_detail.tbl_sparepart_id', 'left');
		$this->db->join('tbl_print_porder', 'tbl_print_porder.idtbl_print_porder = tbl_print_porder_detail.tbl_print_porder_idtbl_print_porder', 'left');
		$this->db->join('tbl_service_type', 'tbl_service_type.idtbl_service_type = tbl_print_porder_detail.tbl_service_type_id', 'left'); // Add this line to join tbl_service_type
		$this->db->where('tbl_print_porder_detail.tbl_print_porder_idtbl_print_porder', $recordID);
		$this->db->where('tbl_print_porder_detail.status', 1);

		$responddetail=$this->db->get();

		$html='';

		$html.='
		        <div class="row">
            <div class="col-6 small"><label class="small font-weight-bold text-dark mb-1">Date:</label> '.$responddetail->row(0)->orderdate.'<br><label class="small font-weight-bold text-dark mb-1">PO No:</label> '.$responddetail->row(0)->porder_no.'<br><label class="small font-weight-bold text-dark mb-1">Customer:</label> '.$respond->row(0)->suppliername.'</div>
            <div class="col-6 small"><label class="small font-weight-bold text-dark mb-1">Company:</label> '.$respond->row(0)->company.'<br><label class="small font-weight-bold text-dark mb-1">Branch:</label> '.$respond->row(0)->branch.'</div>
        </div>
        <hr class="border-dark">
			<div class="row"></div><div class="row"><div class="col-12"><hr><table class="table table-striped table-bordered table-sm"><thead><tr><th>Product Info</th><th class="text-right">Unit Price</th><th class="text-right">Qty</th><th class="text-center">Uom</th><th class="text-right">Total</th></tr></thead><tbody>';
			foreach($responddetail->result() as $roworderinfo) {
						if($roworderinfo->tbl_order_type_idtbl_order_type==3) {
							$html .= '<tr>
							<td>' . $roworderinfo->materialname . '/ ' . $roworderinfo->materialinfocode . '</td>
							<td class="text-right">' . (!empty($roworderinfo->packetprice) ? $roworderinfo->packetprice : $roworderinfo->unitprice) . '</td>
							<td class="text-right">' . $roworderinfo->qty . '</td>
							<td class="text-center">' . $roworderinfo->measure_type . '</td>
							<td class="text-right">' . number_format(($roworderinfo->netprice), 2) . '</td>
						</tr>';			

						}

						else if($roworderinfo->tbl_order_type_idtbl_order_type==1) {
							$html .= '<tr>
							<td>' . $roworderinfo->spare_part_name . ' / ' . $roworderinfo->spare_part_no . '</td>
							<td class="text-right">' . (!empty($roworderinfo->packetprice) ? $roworderinfo->packetprice : $roworderinfo->unitprice) . '</td>
							<td class="text-right">' . $roworderinfo->qty . '</td>
							<td class="text-center">' . $roworderinfo->measure_type . '</td>
							<td class="text-right">' . number_format(($roworderinfo->netprice), 2) . '</td>
						</tr>';			

						}

						else if($roworderinfo->tbl_order_type_idtbl_order_type==4) {
							$html.='<tr>
			<td>'.$roworderinfo->machine.'/ '.$roworderinfo->machinecode.'</td><td class="text-right">'.$roworderinfo->unitprice.'</td><td class="text-right">'.$roworderinfo->qty.'</td><td class="text-center">'.$roworderinfo->measure_type.'</td><td class="text-right">'.number_format(($roworderinfo->netprice), 2).'</td></tr>';

						}

						else {
							$html.='<tr>
			<td>'.$roworderinfo->service_name.'</td><td class="text-right">'.$roworderinfo->unitprice.'</td><td class="text-right">'.$roworderinfo->qty.'</td><td class="text-center">'.$roworderinfo->measure_type.'</td><td class="text-right">'.number_format(($roworderinfo->netprice), 2).'</td></tr>';

						}
					}

			$html .= '</tbody></table></div></div><div class="row mt-3" ><div class="col-12 text-right"><h3 class="font-weight-normal"><strong style="background-color: yellow;">Final Price</strong> &nbsp; &nbsp;<b>Rs. ' . number_format(($respond->row(0)->nettotal), 2) . '</b></h3></div></div>';

			echo $html;

	}

	public function porderviewheader() {
		$recordID=$this->input->post('recordID');

		$this->db->select('tbl_print_porder.*,tbl_supplier.suppliername AS suppliername,tbl_supplier.telephone_no AS suppliercontact,tbl_supplier.address_line1 AS address1,tbl_supplier.address_line2 AS address2,tbl_supplier.city AS city,tbl_supplier.state AS supplierstate,
								tbl_company.company AS companyname,tbl_company.address1 As companyaddress,tbl_company.mobile AS companymobile,
                                tbl_company.phone companyphone,tbl_company.email AS companyemail,
                                tbl_company_branch.branch AS branchname');
		$this->db->from('tbl_print_porder');
		$this->db->join('tbl_supplier', 'tbl_supplier.idtbl_supplier  = tbl_print_porder.tbl_supplier_idtbl_supplier ', 'left');
		$this->db->join('tbl_company', 'tbl_company.idtbl_company = tbl_print_porder.tbl_company_idtbl_company', 'left');
		$this->db->join('tbl_company_branch', 'tbl_company_branch.idtbl_company_branch = tbl_print_porder.tbl_company_branch_idtbl_company_branch', 'left');
		$this->db->where('idtbl_print_porder', $recordID);
		$this->db->where('tbl_print_porder.status', 1);

		$respond=$this->db->get();

		$obj=new stdClass();
		$obj->orderdate=$respond->row(0)->orderdate;
		$obj->suppliername=$respond->row(0)->suppliername;
		$obj->suppliercontact=$respond->row(0)->suppliercontact;
		$obj->address1=$respond->row(0)->address1;
		$obj->address2=$respond->row(0)->address2;
		$obj->city=$respond->row(0)->city;
		$obj->state=$respond->row(0)->supplierstate;
		$obj->companyname=$respond->row(0)->companyname;
		$obj->companyaddress=$respond->row(0)->companyaddress;
		$obj->companymobile=$respond->row(0)->companymobile;
		$obj->companyphone=$respond->row(0)->companyphone;
		$obj->companyemail=$respond->row(0)->companyemail;
		$obj->branchname=$respond->row(0)->branchname;

		echo json_encode($obj);
	}

	public function Purchaseorderstatus() {
		$this->db->trans_begin();

		$userID=$_SESSION['userid'];
		$recordID=$this->input->post('porderid');
        $reqid=$this->input->post('reqestid');
		$confirmnot=$this->input->post('confirmnot');
		$updatedatetime=date('Y-m-d H:i:s');

		// if($type==1) {
			$data=array(
				'confirmstatus'=> $confirmnot,
				'updateuser'=> $userID,
				'updatedatetime'=> $updatedatetime);

			$this->db->where('idtbl_print_porder', $recordID);
			$this->db->update('tbl_print_porder', $data);

            $data1 = array(
                'porderconfirm' => '1',
                'updateuser'=> $userID, 
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_print_porder_req', $reqid);
            $this->db->update('tbl_print_porder_req', $data1);


			$this->db->select('tbl_print_porder.idtbl_print_porder,tbl_print_porder.orderdate, tbl_print_porder.nettotal,tbl_print_porder.tbl_order_type_idtbl_order_type,tbl_print_porder.tbl_supplier_idtbl_supplier');
			$this->db->from('tbl_print_porder');
			$this->db->where('tbl_print_porder.status', 1);
			$this->db->where('tbl_print_porder.idtbl_print_porder', $recordID);

			$respond=$this->db->get();

			if ($respond->num_rows() > 0) {
				foreach ($respond->result() as $row) {
					$grnid=$row->idtbl_print_porder;
					$totalamount=$row->nettotal;
					$supplier=$row->tbl_supplier_idtbl_supplier;
					$grndate=$row->orderdate;
					$orderType=$row->tbl_order_type_idtbl_order_type;


					if ($orderType == 2) {
						$accountsData = array(
							'grndate' => $grndate,
							'tbl_supplier_idtbl_supplier' => $supplier,
							'exptype' => '2',
							'grnno' => $grnid,
							'expcode' => 'SER',
							'amount' => $totalamount,
							'status' => '1',
							'insertdatetime' => $updatedatetime,
							'tbl_user_idtbl_user' => $userID
						);
						$this->db->insert('tbl_expence_info', $accountsData);
					} elseif ($orderType == 3 || $orderType == 4) {
					}
				}
			}



			$this->db->trans_complete();

			if ($this->db->trans_status()===TRUE) {
				$this->db->trans_commit();

				$actionObj=new stdClass();
				$actionObj->icon='fas fa-check';
				$actionObj->title='';
				if($confirmnot==1){$actionObj->message='Record Approved Successfully';}
				else{$actionObj->message='Record Rejected Successfully';}
				$actionObj->url='';
				$actionObj->target='_blank';
				$actionObj->type='success';

				$actionJSON=json_encode($actionObj);

				$obj=new stdClass();
				$obj->status=1;
				$obj->action=$actionJSON;

				echo json_encode($obj);
			}

			else {
				$this->db->trans_rollback();

				$actionObj=new stdClass();
				$actionObj->icon='fas fa-warning';
				$actionObj->title='';
				$actionObj->message='Record Error';
				$actionObj->url='';
				$actionObj->target='_blank';
				$actionObj->type='danger';

				$actionJSON=json_encode($actionObj);

				$obj=new stdClass();
				$obj->status=2;
				$obj->action=$actionJSON;

				echo json_encode($obj);
			}
	}

    public function POmanualconfirm($x){
        $this->db->trans_begin();

        $userID=$_SESSION['userid'];
        $recordID=$x;
        $updatedatetime=date('Y-m-d H:i:s');

            $data = array(
                'grnconfirm' => '1',
                'tbl_user_idtbl_user'=> $userID, 
                'updatedatetime'=> $updatedatetime
            );

			$this->db->where('idtbl_print_porder', $recordID);
            $this->db->update('tbl_print_porder', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-check';
                $actionObj->title='';
                $actionObj->message='Manually Completed';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Purchaseorder');                
            } else {
                $this->db->trans_rollback();

                $actionObj=new stdClass();
                $actionObj->icon='fas fa-warning';
                $actionObj->title='';
                $actionObj->message='Record Error';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Purchaseorder');
            }
        
    }

	public function Getsupplieraccoporderreq() {
		$recordID=$this->input->post('recordID');

		$this->db->select('`tbl_supplier_idtbl_supplier`');
		$this->db->from('tbl_print_porder_req');
		$this->db->where('status', 1);
		$this->db->where('idtbl_print_porder_req', $recordID);

		$respond=$this->db->get();

		echo $respond->row(0)->tbl_supplier_idtbl_supplier;
	}

	public function Getporderreqdetails() {
		$recordID = $this->input->post('recordID');
		
		$this->db->select('requestname, qty, measure_type, type');
		$this->db->from('tbl_print_porder_req_detail');
		$this->db->join('tbl_print_porder_req', 'tbl_print_porder_req.idtbl_print_porder_req = tbl_print_porder_req_detail.tbl_print_porder_req_idtbl_print_porder_req', 'left');
		$this->db->join('tbl_order_type', 'tbl_order_type.idtbl_order_type = tbl_print_porder_req.tbl_order_type_idtbl_order_type ', 'left');
		$this->db->join('tbl_measurements', 'tbl_measurements.idtbl_mesurements = tbl_print_porder_req_detail.tbl_measurements_idtbl_measurements', 'left');
		$this->db->where('tbl_print_porder_req_detail.status', 1);
		$this->db->where('tbl_print_porder_req_idtbl_print_porder_req', $recordID);
		
		$response = $this->db->get();
		
		if ($response->num_rows() > 0) {
			$result = [];
			foreach ($response->result() as $row) {
				$result[] = [
					'requestname' => $row->requestname,
					'qty' => $row->qty,
					'measure_type' => $row->measure_type,
					'order_type' => $row->type
				];
			}
			echo json_encode($result);
		} else {
			echo json_encode([]);
		}
	}			

	public function getProductsByType() {
		$companyID=$_SESSION['company_id'];
		$branchID=$_SESSION['branch_id'];
		$searchTerm=$this->input->post('searchTerm');
		$ordertype = $this->input->post('ordertype');

        if ($ordertype == 1) {
			$this->db->select("id, CONCAT(name, ' - ', part_no) AS name", false);
			$this->db->where('is_deleted', 0);
			if (!empty($searchTerm)) {
				$this->db->group_start();
				$this->db->like('name', $searchTerm);
				$this->db->or_like('part_no', $searchTerm);
				$this->db->group_end();
			}
			$this->db->limit(5);
			$query = $this->db->get('spare_parts');
        } elseif ($ordertype == 2) {
            $this->db->select('idtbl_service_type as id, service_name as name');
			$this->db->where('status', 1);
            $query = $this->db->get('tbl_service_type');
        } elseif ($ordertype == 3) {
			if(!isset($searchTerm)){
				$this->db->select('idtbl_print_material_info as id, materialname as name');
				$this->db->where('status', 1);
				$this->db->where('tbl_company_idtbl_company', $companyID);
				$this->db->limit(5);
				$query = $this->db->get('tbl_print_material_info');                     
			}
			else{            
				if(!empty($searchTerm)){
					$this->db->select('idtbl_print_material_info as id, materialname as name');
					$this->db->where('status', 1);
					$this->db->where('tbl_company_idtbl_company', $companyID);
					$this->db->like('materialname', $searchTerm, 'after');
					$query = $this->db->get('tbl_print_material_info');  
				}
				else{
					$this->db->select('idtbl_print_material_info as id, materialname as name');
					$this->db->where('status', 1);
					$this->db->where('tbl_company_idtbl_company', $companyID);
					$this->db->limit(5);
					$query = $this->db->get('tbl_print_material_info');             
				}
			}            
        } elseif ($ordertype == 4) {
            $this->db->select('idtbl_machine as id, machine as name');
			$this->db->where('status', 1);
            $query = $this->db->get('tbl_machine');
        }
        
		$data=array();
        
        foreach ($query->result() as $row) {
            $data[]=array("id"=>$row->id, "text"=>$row->name);
        }
        
        echo json_encode($data);
    }

	public function GetSemimateriallist(){
        $searchTerm=$this->input->post('searchTerm');

        if(!isset($searchTerm)){
            $sql="SELECT `tbl_material_info`.`idtbl_material_info`, `tbl_material_info`.`materialinfocode`, `tbl_material_code`.`materialname`, `tbl_unit`.`unitcode` FROM `tbl_material_info` LEFT JOIN `tbl_material_code` ON `tbl_material_code`.`idtbl_material_code`=`tbl_material_info`.`tbl_material_code_idtbl_material_code` LEFT JOIN `tbl_unit` ON `tbl_unit`.`idtbl_unit`=`tbl_material_info`.`tbl_unit_idtbl_unit` WHERE `tbl_material_info`.`status`=? AND `tbl_material_info`.`semistatus`=? LIMIT 5";
            $respond=$this->db->query($sql, array(1, 1));                       
        }
        else{            
            if(!empty($searchTerm)){
                $sql="SELECT `tbl_material_info`.`idtbl_material_info`, `tbl_material_info`.`materialinfocode`, `tbl_material_code`.`materialname`, `tbl_unit`.`unitcode` FROM `tbl_material_info` LEFT JOIN `tbl_material_code` ON `tbl_material_code`.`idtbl_material_code`=`tbl_material_info`.`tbl_material_code_idtbl_material_code` LEFT JOIN `tbl_unit` ON `tbl_unit`.`idtbl_unit`=`tbl_material_info`.`tbl_unit_idtbl_unit` WHERE `tbl_material_info`.`status`=? AND `tbl_material_info`.`semistatus`=? AND `tbl_material_code`.`materialname` LIKE '$searchTerm%'";
                $respond=$this->db->query($sql, array(1, 1));    
            }
            else{
                $sql="SELECT `tbl_material_info`.`idtbl_material_info`, `tbl_material_info`.`materialinfocode`, `tbl_material_code`.`materialname`, `tbl_unit`.`unitcode` FROM `tbl_material_info` LEFT JOIN `tbl_material_code` ON `tbl_material_code`.`idtbl_material_code`=`tbl_material_info`.`tbl_material_code_idtbl_material_code` LEFT JOIN `tbl_unit` ON `tbl_unit`.`idtbl_unit`=`tbl_material_info`.`tbl_unit_idtbl_unit` WHERE `tbl_material_info`.`status`=? AND `tbl_material_info`.`semistatus`=? LIMIT 5";
                $respond=$this->db->query($sql, array(1, 1));                
            }
        }
        
        $data=array();
        
        foreach ($respond->result() as $row) {
            $data[]=array("id"=>$row->idtbl_material_info, "text"=>$row->materialname.' - '.$row->materialinfocode.'/'.$row->unitcode);
        }
        
        echo json_encode($data);
    }

	public function Getpordertpeaccoporderrequest() {
		$recordID=$this->input->post('recordID');

		$this->db->select('`tbl_order_type_idtbl_order_type`');
		$this->db->from('tbl_print_porder_req');
		$this->db->where('status', 1);
		$this->db->where('idtbl_print_porder_req', $recordID);

		$respond=$this->db->get();

		echo $respond->row(0)->tbl_order_type_idtbl_order_type;
	}

	public function Getmesuretpeaccorproduct() {
		$recordID=$this->input->post('recordID');

		$this->db->select('`tbl_measurements_idtbl_measurements`');
		$this->db->from('tbl_print_porder_req_detail');
		$this->db->where('status', 1);
		$this->db->where('tbl_print_porder_idtbl_print_porder', $recordID);

		$respond=$this->db->get();

		echo $respond->row(0)->tbl_measurements_idtbl_measurements;
	}

	public function Purchaseorderedit()
	{
		$recordID = $this->input->post('recordID');
		$comapnyID=$_SESSION['company_id'];
	
		$this->db->select('tbl_print_porder.*, tbl_print_porder_detail.*, tbl_supplier.*, tbl_order_type.*, tbl_measurements.*, tbl_print_material_info.*, tbl_machine.*, tbl_service_type.*, spare_parts.*, tbl_print_porder_detail.unitprice AS detail_unitprice');
		$this->db->from('tbl_print_porder');
		$this->db->join('tbl_print_porder_detail', 'tbl_print_porder.idtbl_print_porder = tbl_print_porder_detail.tbl_print_porder_idtbl_print_porder', 'left');
		$this->db->join('tbl_supplier', 'tbl_supplier.idtbl_supplier = tbl_print_porder.tbl_supplier_idtbl_supplier', 'left');
		$this->db->join('tbl_order_type', 'tbl_order_type.idtbl_order_type = tbl_print_porder.tbl_order_type_idtbl_order_type', 'left');
		$this->db->join('tbl_measurements', 'tbl_measurements.idtbl_mesurements = tbl_print_porder_detail.tbl_measurements_idtbl_measurements', 'left');
		$this->db->join('tbl_print_material_info', 'tbl_print_material_info.idtbl_print_material_info = tbl_print_porder_detail.tbl_material_id', 'left');
		$this->db->join('tbl_machine', 'tbl_machine.idtbl_machine = tbl_print_porder_detail.tbl_machine_id', 'left');
		$this->db->join('tbl_service_type', 'tbl_service_type.idtbl_service_type = tbl_print_porder_detail.tbl_service_type_id', 'left');
		$this->db->join('spare_parts', 'spare_parts.id = tbl_print_porder_detail.tbl_sparepart_id', 'left');
		$this->db->where('idtbl_print_porder', $recordID);
		$this->db->where('tbl_print_porder.tbl_company_idtbl_company', $comapnyID);
		$this->db->where('tbl_print_porder.status', 1);
	
		$respond = $this->db->get();
	
		$obj = new stdClass();
		$obj->id = $respond->row(0)->idtbl_print_porder;
		$obj->requestid = $respond->row(0)->tbl_print_porder_req_idtbl_print_porder_req ;
		$obj->orderdate = $respond->row(0)->orderdate;
		$obj->supplier = $respond->row(0)->idtbl_supplier;
		$obj->type = $respond->row(0)->idtbl_order_type;
	
		$items = array();
		foreach ($respond->result() as $row) {
			$item = new stdClass();
			$item->pieces = $row->pieces;
			$item->actual_qty = $row->actual_qty;
			$item->unitprice = $row->detail_unitprice;
			$item->packetprice = $row->packetprice;
			$item->comment = $row->comment;
			$item->measureID = $row->idtbl_mesurements;
			$item->measure = $row->measure_type;
			$item->materialID = $row->idtbl_print_material_info;
			$item->material = $row->materialname;
			$item->machineID = $row->idtbl_machine;
			$item->machine = $row->machine;
			$item->servicetypeID = $row->idtbl_service_type;
			$item->service = $row->service_name;
			$item->sparepartsID = $row->id;
			$item->sparepart = $row->name;
			$item->netprice = $row->netprice;
			$item->qty = $row->qty;
			$item->vat = $row->vat;
			$item->vat_type = $row->vat_type;
			$item->vatamount = $row->vattotamount;
			$items[] = $item;
		}
		$obj->items = $items;
	
		echo json_encode($obj);
	}

	public function Purchaseorderupdate(){
        $this->db->trans_begin();
    
        $userID=$_SESSION['userid'];
    
        $tableData=$this->input->post('tableData');
    
        // Check if $tableData is an array and not empty
        if(is_array($tableData) && !empty($tableData)){
			$orderdate=$this->input->post('orderdate');
			$discounttotal=$this->input->post('discounttotal');
			$vat=$this->input->post('vat');
			$vatamount=$this->input->post('vatamount');
			$vat_type=$this->input->post('vat_type');
			$grosstotal=$this->input->post('grosstotal');
			$total=$this->input->post('total');
			$remark=$this->input->post('remark');
			$supplier=$this->input->post('supplier');
			$location=$this->input->post('location');
			$ordertype=$this->input->post('ordertype');
			$company_id=$this->input->post('company_id');
			$branch_id=$this->input->post('branch_id');
			$porderID=$this->input->post('porderID');
			$porderreqID=$this->input->post('porderreqID');
            $updatedatetime=date('Y-m-d H:i:s');
			$modeltotalpayment=$this->input->post('modeltotalpayment');
    
			$data=array(
			'orderdate'=> $orderdate,
			'duedate'=> 'null',
			'subtotal'=>'0',
			'vat'=> $vat,
			'vat_type'=> $vat_type,
			'vattotamount'=> $vatamount,
			'discountamount'=> '0',
			'nettotal'=>$modeltotalpayment,
			'confirmstatus'=> '0',
			'grnconfirm'=>'0',
			'remark'=> $remark,
			'status'=> '1',
			'updatedatetime'=> $updatedatetime,
			'updateuser'=> $userID,
			'tbl_supplier_idtbl_supplier'=> $supplier,
			'tbl_order_type_idtbl_order_type'=> $ordertype,
			'tbl_service_type_idtbl_service_type'=>'0',
			'tbl_company_idtbl_company'=> $company_id, 
			'tbl_company_branch_idtbl_company_branch'=> $branch_id, 
			'tbl_print_porder_req_idtbl_print_porder_req '=> $porderreqID,

		);
    
            $this->db->where('idtbl_print_porder', $porderID);
            $this->db->update('tbl_print_porder', $data);
    
    
            $this->db->where('tbl_print_porder_idtbl_print_porder', $porderID);
            $this->db->delete('tbl_print_porder_detail');
    
			if($ordertype==3) {
				foreach ($tableData as $rowtabledata) {
					$materialname=$rowtabledata['col_1'];
					$comment=$rowtabledata['col_2'];
					$materialID=$rowtabledata['col_3'];
					$qty=$rowtabledata['col_4'];
					$uom=$rowtabledata['col_5'];
					$uomID=$rowtabledata['col_6'];
					$unit=$rowtabledata['col_7'];
					$nettotal=$rowtabledata['col_8'];
					$pieces=$rowtabledata['col_10'];
					
	
					$dataone=array(
						'qty'=> $qty,
						'pieces'=> $pieces,
						'tbl_measurements_idtbl_measurements'=> $uomID,
						'unitprice'=> $unit,
						'packetprice'=> '0',
						'discount'=>'0',
						'vat'=>'0',
						'vatamount'=>'0',
						'grossprice'=>'0',
						'netprice'=>  $nettotal,
						'comment'=> $comment,
						'status'=> '1',
						'updatedatetime'=> $updatedatetime,
						'tbl_print_porder_idtbl_print_porder'=> $porderID,
						'tbl_material_id'=> $materialID,
						'tbl_user_idtbl_user'=> $userID
						
					);
	
					$this->db->insert('tbl_print_porder_detail', $dataone);
				}
			}
	
			else if($ordertype==4) {
				foreach ($tableData as $rowtabledata) {
					$materialname=$rowtabledata['col_1'];
					$comment=$rowtabledata['col_2'];
					$materialID=$rowtabledata['col_3'];
					$qty=$rowtabledata['col_4'];
					$uom=$rowtabledata['col_5'];
					$uomID=$rowtabledata['col_6'];
					$unit=$rowtabledata['col_7'];
					$nettotal=$rowtabledata['col_8'];
	
					$dataone=array('qty'=> $qty,
						'unitprice'=> $unit,
						'tbl_measurements_idtbl_measurements'=> $uomID,
						'discount'=>'0',
						'vat'=> '0',
						'vatamount'=>'0',
						'grossprice'=>'0',
						'netprice'=> $nettotal,
						'comment'=> $comment,
						'status'=> '1',
						'updatedatetime'=> $updatedatetime,
						'tbl_print_porder_idtbl_print_porder'=> $porderID,
						'tbl_machine_id'=> $materialID,
						'tbl_user_idtbl_user'=> $userID
					);
	
					$this->db->insert('tbl_print_porder_detail', $dataone);
				}
			}
	
			else if($ordertype==1) {
				foreach ($tableData as $rowtabledata) {
					$materialname=$rowtabledata['col_1'];
					$comment=$rowtabledata['col_2'];
					$materialID=$rowtabledata['col_3'];
					$qty=$rowtabledata['col_4'];
					$uom=$rowtabledata['col_5'];
					$uomID=$rowtabledata['col_6'];
					$unit=$rowtabledata['col_7'];
					$nettotal=$rowtabledata['col_8'];
	
					$dataone=array('qty'=> $qty,
						'unitprice'=> $unit,
						'tbl_measurements_idtbl_measurements'=> $uomID,
						'discount'=>'0',
						'vat'=> '0',
						'vatamount'=>'0',
						'grossprice'=>'0',
						'netprice'=> $nettotal,
						'comment'=> $comment,
						'status'=> '1',
						'updatedatetime'=> $updatedatetime,
						'tbl_print_porder_idtbl_print_porder'=> $porderID,
						'tbl_sparepart_id'=> $materialID,
						'tbl_user_idtbl_user'=> $userID
					);
	
					$this->db->insert('tbl_print_porder_detail', $dataone);
				}
			}
	
			else {
				foreach ($tableData as $rowtabledata) {
					$materialname=$rowtabledata['col_1'];
					$comment=$rowtabledata['col_2'];
					$materialID=$rowtabledata['col_3'];
					$qty=$rowtabledata['col_4'];
					$uom=$rowtabledata['col_5'];
					$uomID=$rowtabledata['col_6'];
					$unit=$rowtabledata['col_7'];
					$nettotal=$rowtabledata['col_8'];
	
					$dataone=array('qty'=> $qty,
						'unitprice'=> $unit,
						'tbl_measurements_idtbl_measurements'=> $uomID,
						'discount'=>'0',
						'vat'=>'0',
						'vatamount'=>'0',
						'grossprice'=> '0',
						'netprice'=> $nettotal,
						'comment'=> $comment,
						'status'=> '1',
						'updatedatetime'=> $updatedatetime,
						'tbl_print_porder_idtbl_print_porder'=> $porderID,
						'tbl_service_type_id'=> $materialID,
						'tbl_user_idtbl_user'=> $userID
					);
	
					$this->db->insert('tbl_print_porder_detail', $dataone);
				}
			}

			$this->db->trans_complete();

			if ($this->db->trans_status() === TRUE) {
				$this->db->trans_commit();
				
				$actionObj=new stdClass();
				$actionObj->icon='fas fa-save';
				$actionObj->title='';
				$actionObj->message='Record Added Successfully';
				$actionObj->url='';
				$actionObj->target='_blank';
				$actionObj->type='success';

				$actionJSON=json_encode($actionObj);

				$obj=new stdClass();
				$obj->status=1;          
				$obj->action=$actionJSON;  
				
				echo json_encode($obj);
			} else {
				$this->db->trans_rollback();

				$actionObj=new stdClass();
				$actionObj->icon='fas fa-exclamation-triangle';
				$actionObj->title='';
				$actionObj->message='Record Error';
				$actionObj->url='';
				$actionObj->target='_blank';
				$actionObj->type='danger';

				$actionJSON=json_encode($actionObj);

				$obj=new stdClass();
				$obj->status=0;          
				$obj->action=$actionJSON;  
				
				echo json_encode($obj);
			}
		}
    }
}