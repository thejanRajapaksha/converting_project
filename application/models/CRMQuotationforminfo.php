<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class CRMQuotationforminfo extends CI_Model
{
    public function Getquotationid($z, $y)
    {
        $qua = $y;

        $quatationid = $z;

        return  $quatationid;
    }

    public function Getproductlistimagesdelete()
    { //Status
        $this->db->trans_begin();


        $recordID = $this->input->post('imageID');

        $data = array(
            'status' => '3'
        );

        $this->db->where('idtbl_product_image', $recordID);
        $this->db->update('tbl_product_image', $data);

        $this->db->trans_complete();

        // if ($this->db->trans_status() === TRUE) {
        //     $this->db->trans_commit();

        //     $actionObj = new stdClass();
        //     $actionObj->icon = 'fas fa-warning';
        //     $actionObj->title = '';
        //     $actionObj->message = ' Delete Successfully';
        //     $actionObj->url = '';
        //     $actionObj->target = '_blank';
        //     $actionObj->type = 'danger';

        //     $actionJSON = json_encode($actionObj);

        //     $obj = new stdClass();
        //     $obj->status = 1;
        //     $obj->action = $actionJSON;

        //     echo json_encode($obj);
        // } else {
        //     $this->db->trans_rollback();

        //     $actionObj = new stdClass();
        //     $actionObj->icon = 'fas fa-warning';
        //     $actionObj->title = '';
        //     $actionObj->message = 'Record Error';
        //     $actionObj->url = '';
        //     $actionObj->target = '_blank';
        //     $actionObj->type = 'danger';

        //     $actionJSON = json_encode($actionObj);

        //     $obj = new stdClass();
        //     $obj->status = 1;
        //     $obj->action = $actionJSON;

        //     echo json_encode($obj);
        // }
    }

    public function GetItemByInquiry($customer_id){
        
		$this->db->select('DISTINCT(p.idtbl_product), p.product');
		$this->db->from('tbl_inquiry i');
        $this->db->join('tbl_inquiry_detail d', 'd.tbl_inquiry_idtbl_inquiry = i.idtbl_inquiry');
		$this->db->join('tbl_products p', 'p.idtbl_product = d.tbl_products_idtbl_product');
		$this->db->where('i.tbl_customer_idtbl_customer', $customer_id);

		$query = $this->db->get();
		return $result = $query->result();

    }

    public function Getproductlistimages()
    {
        $productID = $this->input->post('productID');

        $this->db->select('*');
        $this->db->from('tbl_product_image AS u');
        $this->db->where('u.tbl_quotation_idtbl_quotation', $productID);
        $this->db->where_in('u.status', array(1, 2));
        $query = $this->db->get();
        $html = '';
        foreach ($query->result() as $row) {

            $html .= '<table class="table table-striped table-bordered table-sm" id="productimagetable">
    <tbody>
    <tr>
            <td>
                <img src="' . base_url() . '/' . $row->imagepath . '" width="150" height="150">
            </td>
            <td class="text-center">
                <button class="btn btn-outline-danger btn-sm btnremoveimage mt-5" id="' . $row->idtbl_product_image . '"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr></tbody>
</table>';
        }
        return $html;
    }
    public function Getproduct($z, $y)
    {
        $getinq = $z;
        $get = $y;

        $this->db->select('`quantity`,`date`,`bag_length`,`bag_width`,`colour_no`,`off_print`,`status`,`tbl_inquiry_idtbl_inquiry`');
        $this->db->from('tbl_inquiry_detail');
        $this->db->where('status', 1);
        $this->db->where('tbl_inquiry_idtbl_inquiry', $getinq);

        $query = $this->db->get();
        return $query-> result();
    }

    public function Quotationformmeterial()
    {
        $productid = $this->input->post('productid');
        $getid = $this->input->post('getid');

        $this->db->select('ua.idtbl_material, ua.type');
        $this->db->from('tbl_inquiry_detail AS u');
        $this->db->join('tbl_material AS ua', 'ua.idtbl_material = u.tbl_material_idtbl_material', 'left');
        $this->db->where('u.tbl_cloth_idtbl_cloth', $productid);
        $this->db->where('u.tbl_inquiry_idtbl_inquiry', $getid);
        $this->db->where('u.status', 1);

        $respond = $this->db->get();
        $result = $respond->result();
        $arraylist = array();
        foreach ($result as $res) {
            $obj = new stdClass();
            $obj->idtbl_material = $res->idtbl_material;
            $obj->type = $res->type;

            array_push($arraylist, $obj);
        }

        return json_encode($arraylist);
    }

    public function Quotationformunitprice()
    {
        $productid = $this->input->post('productid');
        $getid = $this->input->post('getid');
        $customer = $this->input->post('customer');

        $this->db->select('`u.quantity`');
        $this->db->from('tbl_inquiry_detail AS u');
        $this->db->join('tbl_inquiry AS ua', 'ua.idtbl_inquiry = u.tbl_inquiry_idtbl_inquiry', 'left');
        $this->db->where('u.tbl_material_idtbl_material', $productid);
        $this->db->where('ua.tbl_customer_idtbl_customer', $customer);
        $this->db->where('u.tbl_inquiry_idtbl_inquiry', $getid);
        $this->db->where('u.tbl_inquiry_idtbl_inquiry', $getid);
        $this->db->where('u.status', 1);

        $respond = $this->db->get();

        if ($respond->num_rows() > 0) {
            $obj = new stdClass();
            $obj->quantity = $respond->row(0)->quantity;

            echo json_encode($obj);
        } else {

            echo json_encode(['error' => 'No data found']);
        }

        return $respond;
    }

    public function Getcustomer($z, $y)
    {

        $getid = $z;
        $getcusid = $y;

        $this->db->select('`tbl_customer_idtbl_customer`, `name`');
        $this->db->from('tbl_inquiry AS u');
        $this->db->join('tbl_customer AS ua', 'ua.idtbl_customer = u.tbl_customer_idtbl_customer', 'left');
        $this->db->where('u.status', 1);
        $this->db->where('tbl_customer_idtbl_customer', $getcusid);
        $this->db->group_by('tbl_customer_idtbl_customer');
         $query = $this->db->get();
         return $query->result();
    }

    public function Quotationformgetinfodata()
    {

        $cusId = $this->input->post('cusId');

        $this->db->select('*');
        $this->db->from('tbl_quotation AS u');
        $this->db->join('tbl_quotation_detail AS ua', 'ua.tbl_quotation_idtbl_quotation = u.idtbl_quotation', 'left');
        $this->db->join('tbl_products AS uc', 'uc.idtbl_product = ua.idtbl_product', 'left');
        $this->db->join('tbl_customer AS ub', 'ub.idtbl_customer = u.tbl_customer_idtbl_customer', 'left');
        $this->db->where('u.idtbl_quotation', $cusId);
        $this->db->where_in('u.status', array(1, 2));

        $query = $this->db->get();

        $html = '';
        $total_amount = 0;
        $count = 0;

        foreach ($query->result() as $row) {

            $html .= '<tr>
            <td scope="row" class="d-none">' . $count . '</td>
            <td scope="row" class="d-none">' . $row->tbl_inquiry_idtbl_inquiry . '</td>
            <td scope="row">' . $row->duedate . '</td>
            <td scope="row">' . $row->comment . '</td>
            <td scope="row">' . $row->product . '</td>
            <td scope="row">' . $row->qty . '</td>
            <td scope="row">' . $row->duration . '</td>
            <td scope="row">' . $row->unitprice . '</td>
            <td scope="row" class="text-right">' . number_format($row->total, 2) . '</td>
            </tr>';
            $total_amount += $row->total;
        }

        $html .= '<tr>
    <td colspan="6" class="text-right font-weight-bold">Included Vat</td>
    <td class="text-right font-weight-bold">15%</td>
    </tr>';
    $html .= '<tr>
    <td colspan="6" class="text-right font-weight-bold">Net Total</td>
    <td class="text-right font-weight-bold">' . number_format($total_amount, 2) . '</td>
    </tr>';

        return $html;
    }

    public function Quotationforminsertupdate()
{
    $this->db->trans_begin();
    $userID = $_SESSION['userid'];
    $jsonObj = json_decode($this->input->post('tableData'), true);
    $remarks = $this->input->post('remarks');
    $getid = $this->input->post('getid');
    $trimmedValue = $this->input->post('trimmedValue');
    $sumdis = $this->input->post('sumdis');
    $quotdate = $this->input->post('quotdate');
    $duedate = $this->input->post('duedate');
    $customer = $this->input->post('customer');
    $recordOption = $this->input->post('recordOption');
    
    if (!empty($this->input->post('recordID'))) {
        $recordID = $this->input->post('recordID');
    }

    $updatedatetime = date('Y-m-d H:i:s');
    if ($recordOption == 1) { 
        $data = array(
            'quot_date' => $quotdate,
            'duedate' => $duedate,
            'total' => $trimmedValue,
            'discount' => '0',
            'nettotal' => '0',
            'delivery_charge' => '0',
            'approvestatus' => '0',
            'approvedate' => '0',
            'approveuser' => '0',
            'reject_resone' => '',
            'remarks' => $remarks,
            'status' => '1',
            'insertdatetime' => $updatedatetime,
            'tbl_user_idtbl_user' => $userID,
            'tbl_inquiry_idtbl_inquiry' => $getid,
            'tbl_customer_idtbl_customer' => $customer,
        );

        $this->db->insert('tbl_quotation', $data);
        $tbl_quotation_idtbl_quotation = $this->db->insert_id();

        foreach ($jsonObj as $rowdata) {
            $productID   = $rowdata['col_1']; 
            $product     = $rowdata['col_2']; 
            $meterialID  = $rowdata['col_3']; 
            $description = $rowdata['col_4']; 
            $qty         = $rowdata['col_5']; 
            $duration    = $rowdata['col_6']; 
            $unitprice   = $rowdata['col_7']; 
            $showtotal   = $rowdata['col_8']; 
            $total = (float) str_replace(',', '', $rowdata['col_9']);

            $data2 = array(
                'idtbl_product' => $productID,
                'tbl_material_idtbl_material' => $meterialID, 
                'qty' => $qty,
                'unitprice' => $unitprice,
                'duration' => $duration,
                'total' => $total,
                'comment' => $description,
                'status' => '1',
                'tbl_quotation_idtbl_quotation' => $tbl_quotation_idtbl_quotation
            );

            $this->db->insert('tbl_quotation_detail', $data2);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();

            $actionObj = new stdClass();
            $actionObj->icon = 'fas fa-save';
            $actionObj->title = '';
            $actionObj->message = 'Record Added Successfully';
            $actionObj->url = '';
            $actionObj->target = '_blank';
            $actionObj->type = 'success';

            echo json_encode(['status' => 1, 'action' => json_encode($actionObj)]);
        } else {
            $this->db->trans_rollback();

            $actionObj = new stdClass();
            $actionObj->icon = 'fas fa-warning';
            $actionObj->title = '';
            $actionObj->message = 'Record Error';
            $actionObj->url = '';
            $actionObj->target = '_blank';
            $actionObj->type = 'danger';

            echo json_encode(['status' => 0, 'action' => json_encode($actionObj)]);
        }
    }
}


    public function Quotationformedit()
    {
        $recordID = $this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('tbl_quotation');
        $this->db->where('idtbl_quotation', $recordID);
        $this->db->where('status', 1);

        $respond = $this->db->get();

        $obj = new stdClass();
        $obj->id = $respond->row(0)->idtbl_quotation;
        $obj->quot_date = $respond->row(0)->quot_date;
        $obj->duedate = $respond->row(0)->duedate;
        $obj->total = $respond->row(0)->total;
        $obj->discount = $respond->row(0)->discount;
        $obj->nettotal = $respond->row(0)->nettotal;
        $obj->delivery_charge = $respond->row(0)->delivery_charge;
        $obj->remarks = $respond->row(0)->remarks;

        echo json_encode($obj);
    }

    public function Quotationformstatus()
    { //Status
        $this->db->trans_begin();

        $userID = $_SESSION['userid'];
        $recordID = $this->input->post('recordID');
        $type = $this->input->post('type');
        $cancelMsg = $this->input->post('cancelMsg');
        $updatedatetime = date('Y-m-d H:i:s');

        if ($type == 1) {
            $data = array(
                'status' => '1',
                'updatedatetime' => $updatedatetime
            );

            $this->db->where('idtbl_quotation', $recordID);
            $this->db->update('tbl_quotation', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-check';
                $actionObj->title = '';
                $actionObj->message = 'Record Activate Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'success';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 1;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 1;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            }
        } else if ($type == 2) {
            $data2 = array(
                'status' => '2',
                'updatedatetime' => $updatedatetime
            );

            $this->db->where('idtbl_quotation', $recordID);
            $this->db->update('tbl_quotation', $data2);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-times';
                $actionObj->title = '';
                $actionObj->message = 'Record Deactivate Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'warning';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 1;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 0;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            }
        } else if ($type == 3) {
            $data3 = array(
                'reject_resone' => $cancelMsg,
                'status' => '3',
                'updatedatetime' => $updatedatetime,

            );

            $this->db->where('idtbl_quotation', $recordID);
            $this->db->update('tbl_quotation', $data3);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-trash-alt';
                $actionObj->title = '';
                $actionObj->message = 'Record Remove Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 0;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 0;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            }
        }
    }



    public function Quotationformapprovestatus()
    { //Status
        $this->db->trans_begin();

        $userID = $_SESSION['userid'];
        $recordID = $this->input->post('recordID');
        $type = $this->input->post('type');
        $reasonID = $this->input->post('reasonID');
        $reasonAdd = $this->input->post('reasonAdd');
        $updatedatetime = date('Y-m-d H:i:s');

        if ($type == 1) {
            $data = array(
                'approvestatus' => '1',
                'approvedate' => $updatedatetime,
                'approveuser' => $userID,
                'tbl_user_idtbl_user' => $userID,
                'updatedatetime' => $updatedatetime
            );

            $this->db->where('idtbl_quotation', $recordID);
            $this->db->update('tbl_quotation', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-check';
                $actionObj->title = '';
                $actionObj->message = 'Record Approve Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'success';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 1;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 0;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            }
        } else if ($type == 2) {
            $data2 = array(
                'approvestatus' => '2',
                'approvedate' => $updatedatetime,
                'approveuser' => $userID,
                // 'updateuser' => $userID,
                'updatedatetime' => $updatedatetime,
                'tbl_reason_idtbl_reason' => $reasonID,
                'reject_resone' => $reasonAdd
            );

            $this->db->where('idtbl_quotation', $recordID);
            $this->db->update('tbl_quotation', $data2);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-times';
                $actionObj->title = '';
                $actionObj->message = 'Record Disapprove Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'warning';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 1;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $obj = new stdClass();
                $obj->status = 0;
                $obj->action = $actionJSON;

                echo json_encode($obj);
            }
        }
    }
    // public function Quotationdetailsinsertupdate()
    // {
    //     $this->db->trans_begin();

    //     $userID = $_SESSION['userid'];
    //     $qty = $this->input->post('qty');
    //     $unitprice = $this->input->post('unitprice');
    //     $discountamount = $this->input->post('discountamount');
    //     $total = $this->input->post('total');
    //     $comment = $this->input->post('comment');
    //     // $id=$this->input->post('id');

    //     $QuotationdetailsrecordOption = $this->input->post('QuotationdetailsrecordOption');
    //     $QuotationdetailsrecordID = $this->input->post('QuotationdetailsrecordID');
    //     $recordID = $this->input->post('recordQdetails');
    //     $updatedatetime = date('Y-m-d H:i:s');

    //     $data = array(
    //         'qty' => $qty,
    //         'unitprice' => $unitprice,
    //         'discountamount' => $discountamount,
    //         'total' => $total,
    //         'comment' => $comment,
    //         'status' => '1',
    //         'tbl_quotation_idtbl_quotation' => $QuotationdetailsrecordOption,
    //         'tbl_product_idtbl_product' => '0'

    //     );

    //     $this->db->insert('tbl_quotation_detail', $data);

    //     $this->db->trans_complete();

    //     if ($this->db->trans_status() === TRUE) {
    //         $this->db->trans_commit();

    //         $actionObj = new stdClass();
    //         $actionObj->icon = 'fas fa-save';
    //         $actionObj->title = '';
    //         $actionObj->message = 'Record Added Successfully';
    //         $actionObj->url = '';
    //         $actionObj->target = '_blank';
    //         $actionObj->type = 'success';

    //         $actionJSON = json_encode($actionObj);

    //         $this->session->set_flashdata('msg', $actionJSON);
    //         redirect('CRMQuotationforminfo');
    //     } else {
    //         $this->db->trans_rollback();

    //         $actionObj = new stdClass();
    //         $actionObj->icon = 'fas fa-warning';
    //         $actionObj->title = '';
    //         $actionObj->message = 'Record Error';
    //         $actionObj->url = '';
    //         $actionObj->target = '_blank';
    //         $actionObj->type = 'danger';

    //         $actionJSON = json_encode($actionObj);

    //         $this->session->set_flashdata('msg', $actionJSON);
    //         redirect('CRMQuotationforminfo');
    //     }
    // }

    public function Quotationdetailsedit()
    {

        $recordID = $this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('tbl_quotation_detail');
        $this->db->where('idtbl_quotation_detail', $recordID);
        $this->db->where('tbl_quotation_detail.status', 1);

        $respond = $this->db->get();

        $obj = new stdClass();
        $obj->id = $respond->row(0)->idtbl_quotation_detail;
        $obj->qty = $respond->row(0)->qty;
        $obj->unitprice = $respond->row(0)->unitprice;
        $obj->discountamount = $respond->row(0)->discountamount;
        $obj->total = $respond->row(0)->total;
        $obj->comment = $respond->row(0)->comment;

        echo json_encode($obj);
    }

    public function Getreasontype(){
        $this->db->select('idtbl_reason, type');
        $this->db->from('tbl_reason');
        $this->db->where('status', 1);
    
        $respond=$this->db->get();

        $data=array();

        foreach ($respond->result() as $row) {
            $data[]=array("id"=>$row->idtbl_reason, "text"=>$row->type);
        }

        echo json_encode($data);
    }

    public function QuotationformDetailsstatus($x, $y)
    {   //Status
        $this->db->trans_begin();

        $userID = $_SESSION['userid'];
        $recordID = $x;
        $type = $y;
        $updatedatetime = date('Y-m-d H:i:s');

        if ($type == 1) {
            $data = array(
                'status' => '1',
                'updatedatetime' => $updatedatetime,
                'updateuser' => $userID
            );

            $this->db->where('idtbl_quotation_detail', $recordID);
            $this->db->update('tbl_quotation_detail', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-check';
                $actionObj->title = '';
                $actionObj->message = 'Record Activate Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'success';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            }
        } else if ($type == 2) {
            $data = array(
                'status' => '2',
                'updatedatetime' => $updatedatetime,
                'updateuser' => $userID
            );

            $this->db->where('idtbl_quotation_detail', $recordID);
            $this->db->update('tbl_quotation_detail', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-times';
                $actionObj->title = '';
                $actionObj->message = 'Record Deactivate Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'warning';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            }
        } else if ($type == 3) {
            $data = array(
                'status' => '3',
                'updatedatetime' => $updatedatetime,
                'updateuser' => $userID
            );

            $this->db->where('idtbl_quotation_detail', $recordID);
            $this->db->update('tbl_quotation_detail', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-trash-alt';
                $actionObj->title = '';
                $actionObj->message = 'Record Remove Successfully';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            } else {
                $this->db->trans_rollback();

                $actionObj = new stdClass();
                $actionObj->icon = 'fas fa-warning';
                $actionObj->title = '';
                $actionObj->message = 'Record Error';
                $actionObj->url = '';
                $actionObj->target = '_blank';
                $actionObj->type = 'danger';

                $actionJSON = json_encode($actionObj);

                $this->session->set_flashdata('msg', $actionJSON);
                redirect('CRMQuotationforminfo');
            }
        }
    }

    public function Quotationformpdf($x)
{
    $quotaitonid = $x;
    $cusId = $this->input->post('cusId');
    $userID = $_SESSION['userid'];

    // --- Load Quotation Data ---
    $this->db->select('*');
    $this->db->from('tbl_quotation AS u');
    $this->db->join('tbl_quotation_detail AS ua', 'ua.tbl_quotation_idtbl_quotation = u.idtbl_quotation', 'left');
    $this->db->join('tbl_customer AS ub', 'ub.idtbl_customer = u.tbl_customer_idtbl_customer', 'left');
    $this->db->join('tbl_products AS uc', 'uc.idtbl_product = ua.idtbl_product', 'left');
    $this->db->where('u.idtbl_quotation', $quotaitonid);
    $this->db->where_in('u.status', array(1, 2));
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        $quot_date = $row->quot_date;
        $duedate = $row->duedate;
        $name = $row->name;
        $address1 = $row->address_line1;
    } else {
        show_error("No quotation found!");
        return;
    }

    // --- Load User Name ---
    $this->db->select('`name`');
    $this->db->from('tbl_user');
    $this->db->where('idtbl_user', $userID);
    $this->db->where_in('status', array(1, 2));
    $query3 = $this->db->get();

    $name2 = ($query3->num_rows() > 0) ? $query3->row()->name : 'User';

    // --- Initialize Totals ---
    $count = 0;
    $sub_total_amount = 0;
    $total_discount = 0;
    $price = 0;

    // --- HTML START ---
    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quotation PDF</title>
        <style>
            * { font-family: "Calibri", sans-serif; font-size: 12px; }
            .specific-tables2 table, .specific-tables2 th, .specific-tables2 td {
                border: 1px solid #656262;
                border-collapse: collapse;
                height: 25px;
            }
            .specific-tables2 th { height:20px; background-color: #0070c0; color: white; }
            .specific-tables2 tr:nth-child(even) { background-color: #f2f2f2; }
            .txtalign2 { padding-left: 5px; }
            .hrtext { padding-left: 25px; padding-right: 25px; }
        </style>
    </head>
    <body style="padding:20px;">

    <table style="width:100%;">
        <tr>
            <td style="width:60%;">
                <b>TO:</b><br>' . $name . '<br>' . $address1 . '
            </td>
            <td style="width:40%; text-align:right;">
                <h2 style="background-color:#5b9bd5; color:white; padding:8px; border-radius:6px;">QUOTATION</h2>
                <table style="width:100%; border:1px solid #8bbce7; border-collapse:collapse;">
                    <tr><td>QTY NO</td><td>QT' . $quotaitonid . '</td></tr>
                    <tr><td>DATE</td><td>' . $quot_date . '</td></tr>
                    <tr><td>DUE DATE</td><td>' . $duedate . '</td></tr>
                    <tr><td>PREPARED BY</td><td>' . $name2 . '</td></tr>
                    <tr><td>APPROVED BY</td><td>' . $name2 . '</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <br><hr>
    <p>With reference to your request made, we present our best quotation below:</p>

    <div class="specific-tables2 hrtext">
        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="width:4%;">NO</th>
                    <th style="width:40%;">Description</th>
                    <th style="width:15%;">QTY</th>
                    <th style="width:15%;">UNIT (Rs)</th>
                    <th style="width:20%;">PRICE (LKR)</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($query->result() as $row) {
        $count++;
        $price = $row->qty * $row->unitprice;
        $sub_total_amount += $price;
        $total_discount += $row->discountamount;

        $html .= '
            <tr>
                <td style="text-align:center;">' . $count . '</td>
                <td>' . $row->product . '</td>
                <td style="text-align:center;">' . $row->qty . '</td>
                <td style="text-align:right;">' . number_format($row->unitprice, 2) . '</td>
                <td style="text-align:right;">' . number_format($price, 2) . '</td>
            </tr>';
    }

    $sub_total_amount2 = $sub_total_amount - $total_discount;
    $total_amount = $sub_total_amount2 + $row->delivery_charge;

    $html .= '
            <tr>
                <td colspan="4" style="text-align:right;"><b>Sub Total</b></td>
                <td style="text-align:right;"><b>' . number_format($sub_total_amount, 2) . '</b></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">Total Discount</td>
                <td style="text-align:right;">' . number_format($total_discount, 2) . '</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">Delivery Charges</td>
                <td style="text-align:right;">' . number_format($row->delivery_charge, 2) . '</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; font-size:14px;"><b>TOTAL</b></td>
                <td style="text-align:right; font-size:16px;"><b>' . number_format($total_amount, 2) . '</b></td>
            </tr>
        </tbody>
        </table>
    </div>

    <br><br>
    <p>Sincerely,</p>
    <p><b>LANKASPIN PVT LTD</b><br>
    TEL: +94 011-2260060 | FAX: +94 011-2260166<br>
    Address: 531,15 Negombo Rd, Seeduwa | Web: www.lankaspin.com</p>

    </body>
    </html>';

    // --- Render PDF ---
    $this->load->library('pdf');
    $this->pdf->loadHtml($html);
    $this->pdf->setPaper('A4', 'portrait');
    $this->pdf->render();
    $this->pdf->stream("quotation_" . $quotaitonid . ".pdf", array("Attachment" => 0));
}

}

