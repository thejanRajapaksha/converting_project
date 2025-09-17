<?php
class InvoicePrintinfo extends CI_Model{

    public function Printinvoice($x){
        $recordID=$x;
        $sql =" SELECT * FROM `tbl_print_porder` 
        LEFT JOIN `tbl_supplier` ON `tbl_supplier`.`idtbl_supplier` = `tbl_print_porder`.`tbl_supplier_idtbl_supplier` 
        WHERE `idtbl_print_porder` = '$recordID'";
        $respond=$this->db->query($sql, array(1, $recordID));

        if ($respond->num_rows() > 0) {
            $company_id = $respond->row(0)->tbl_company_idtbl_company;
        
            $prefix = 'MO';
            if ($company_id == 2) {
                $prefix = 'FT';
            } elseif ($company_id == 3) {
                $prefix = 'RM';
            }
        }

        $this->db->select('tbl_company.company AS companyname,tbl_company.address1 As companyaddress,tbl_company.mobile AS companymobile,
                                tbl_company.phone companyphone,tbl_company.email AS companyemail,
                                tbl_company_branch.branch AS branchname');
		$this->db->from('tbl_print_porder');
		$this->db->join('tbl_company', 'tbl_company.idtbl_company = tbl_print_porder.tbl_company_idtbl_company', 'left');
        $this->db->join('tbl_company_branch', 'tbl_company_branch.idtbl_company_branch = tbl_print_porder.tbl_company_branch_idtbl_company_branch', 'left');
		$this->db->where('tbl_print_porder.idtbl_print_porder', $recordID);
		$companydetails = $this->db->get();

        $net = sprintf('%0.2f', $respond->row(0)->nettotal);
    
        $sql2="SELECT 
        `tbl_print_porder_detail`.*,
        `tbl_print_porder`.*,
        `spare_parts`.`part_no`,
        `spare_parts`.`name`,
        `tbl_service_type`.`service_name`,
        `tbl_machine`.`machine`,
        `tbl_measurements`.`measure_type`
        FROM `tbl_print_porder`
        LEFT JOIN `tbl_print_porder_detail` ON `tbl_print_porder`.`idtbl_print_porder` = `tbl_print_porder_detail`.`tbl_print_porder_idtbl_print_porder`
        LEFT JOIN `tbl_order_type` ON `tbl_order_type`.`idtbl_order_type` = `tbl_print_porder`.`tbl_order_type_idtbl_order_type`
        LEFT JOIN `tbl_print_material_info` ON `tbl_print_material_info`.`idtbl_print_material_info` = `tbl_print_porder_detail`.`tbl_material_id`
        LEFT JOIN `tbl_machine` ON `tbl_machine`.`idtbl_machine` = `tbl_print_porder_detail`.`tbl_machine_id`
        LEFT JOIN `spare_parts` ON `spare_parts`.`id` = `tbl_print_porder_detail`.`tbl_sparepart_id`
        LEFT JOIN `tbl_service_type` ON `tbl_service_type`.`idtbl_service_type` = `tbl_print_porder_detail`.`tbl_service_type_id`
        LEFT JOIN `tbl_measurements` ON `tbl_measurements`.`idtbl_mesurements` = `tbl_print_porder_detail`.`tbl_measurements_idtbl_measurements`
        WHERE 
        `tbl_print_porder_detail`.`status` = '1'
        AND `tbl_print_porder`.`idtbl_print_porder` = '$recordID'";
        $respond2=$this->db->query($sql2, array(1, $recordID));

        $dataArray = [];
        $count = 0;
        $section = 1;
        foreach ($respond2->result() as $rowlist) {
            $unitPrice = !empty($rowlist->packetprice) ? $rowlist->packetprice : $rowlist->unitprice;
        
            $nettotal = $unitPrice * $rowlist->qty;
            $part_no = $rowlist->part_no;
            $qty = $rowlist->qty;
            $measureType = $rowlist->measure_type;
        
            if ($respond2->row()->tbl_order_type_idtbl_order_type == 2) {
                $itemDescription = $rowlist->service_name;
            } elseif ($respond2->row()->tbl_order_type_idtbl_order_type == 3) {
                $itemDescription = $rowlist->name;
            } elseif ($respond2->row()->tbl_order_type_idtbl_order_type == 1) {
                $itemDescription = $rowlist->name;
            } else {
                $itemDescription = $rowlist->machine;
            }
        
            if ($count % 5 == 0) {
                $dataArray[$section] = [];
            }
        
            $dataArray[$section][] = [
                'part_no' => $part_no,
                'itemDescription' => $itemDescription,
                'qty' => $qty,
                'measureType' => $measureType,
                'unitPrice' => $unitPrice,
                'nettotal' => $nettotal
            ];
        
            $count++;
        
            if ($count % 5 == 0) {
                $section++;
            }
        }        



        $htmlcusdetail='';
        $travelinfotbl='';
        $additional ='';
        $chequeinfotbl ='';
        $cashinfotbl ='';

        $tpnumber='&nbsp;';
        if(strlen($respond->row(0)->telephone_no)>=9){$tpnumber=$respond->row(0)->telephone_no;}
        
        $logo_base64 = $this->getBase64Logo();

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Multi Offset Printers</title>
            <style>
                @page {
                    size: 220mm 140mm;
                    margin: 5mm 5mm 5mm 5mm; /* top right bottom left */
                    font-family: Arial, sans-serif;
                }
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.5;
                    text-align:left;
                    margin-top: 160px;
                }

                /** Define the header rules **/
                header {
                    position: fixed;
                    top: 0px;
                    left: 0px;
                    right: 0px;
                    height: 250px;
                }

                /** Define the footer rules **/
                footer {
                    position: fixed; 
                    bottom: 0px; 
                    left: 0px; 
                    right: 0px;
                    height: 100px;
                }
            </style>
        </head>
        <body>
            <header>
                <table style="width:100%; border-collapse: collapse;">
                    <tr>
                        <!-- Left: Logo + Supplier details side by side -->
                        <td style="width:40%; vertical-align: top; padding:0px;">
                            <div style="display:flex; align-items:flex-start;">
                                <!-- Logo -->
                                <div style="flex:0 0 auto; width:60px; margin-right:10px;">
                                    <img src="' . $logo_base64 . '" alt="Company Logo" style="max-width:60px; max-height:60px;">
                                </div>
                                <!-- Supplier details -->
                                <div style="flex:1 1 auto; margin-left:60px;">
                                    <p style="margin:0px; font-size:13px; font-weight:bold;">To: '.$respond->row(0)->suppliername.'</p>
                                    <p style="margin:0px; font-size:13px;">'.$respond->row(0)->address_line1.'</p>
                                    <p style="margin:0px; font-size:13px;">'.$respond->row(0)->address_line2.'</p>
                                    <p style="margin:0px; font-size:13px;">'.$respond->row(0)->city.'</p>
                                    <p style="margin:0px; font-size:13px;">'.$tpnumber.'</p>
                                    <p style="margin:0px; font-size:13px;">Atten ....................................................</p>
                                </div>
                            </div>
                        </td>

                        <!-- Center: PURCHASE ORDER -->
                        <td style="width:20%; text-align:center; vertical-align: top; padding:0px;">
                            <p style="margin:0px; font-size:16px; font-weight:bold; text-transform: uppercase;">
                                PURCHASE ORDER
                            </p>
                        </td>
                        <td style="width:5%;"></td> <!-- Spacer column -->

                        <!-- Right: Company info -->
                        <td style="width:35%; vertical-align: top; text-align:left; padding:0px;">
                            <p style="margin:0px; font-size:13px; font-weight:bold; text-transform: uppercase;">'.$companydetails->row()->companyname.'</p>
                            <p style="margin:0px; font-size:13px; font-weight:normal; text-transform: uppercase;">'.$companydetails->row()->companyaddress.'</p>
                            <p style="margin:0px; font-size:13px; font-weight:normal;">Phone : '.$companydetails->row()->companymobile.'/'.$companydetails->row()->companyphone.'</p>
                            <p style="margin:0px; font-size:13px; font-weight:normal;"><u>E-Mail : '.$companydetails->row()->companyemail.'</u></p>
                            <p style="margin:0px; font-size:13px; font-weight:normal;">PO No : ' . $prefix . '/' . $respond->row(0)->porder_no . '</p>
                            <p style="margin:0px; font-size:13px; font-weight:normal;">Date : '.$respond->row(0)->orderdate.'</p>
                        </td>
                    </tr>
                </table>
            </header>
            <footer>
                <table style="width:100%;">
                    <tr>
                        <td style="vertical-align: top;">
                            <table style="width:100%;font-size:12px;margin-top: 15px;">
                                <tr>
                                    <td>Prepared by</td>
                                    <td style="width: 5%;">:</td>
                                    <td>...................................</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 15px;">Checked by</td>
                                    <td style="width: 5%;padding-top: 15px;">:</td>
                                    <td style="padding-top: 15px;">...................................</td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align: top;">
                            <table style="width:100%;font-size:12px;margin-top: 15px;">
                                <tr>
                                    <td>Contact Person</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 15px;">Contact No</td>
                                </tr>
                            </table>
                        </td>
                        <td style="text-align: center;vertical-align: top;">
                            <p style="margin:0;font-size:12px;text-transform: uppercase;font-weight: bold;">'.$companydetails->row()->companyname.'</p>
                            <p style="margin:0;margin-top:25px;font-size:12px;">..........................................................</p>
                            <p style="margin:0;font-size:12px;">Authorise Officer</p>
                        </td>
                    </tr>
                </table>
            </footer>';

            foreach ($dataArray as $index => $section) {
                $html.='<main>
                    <table style="width:100%; border-collapse: collapse; font-size: 13px;">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align:center; border: 1px solid #000;">S/No</th>
                                <th style="width: 10%;text-align:center; border: 1px solid #000;">Code</th>
                                <th style="width: 40%;text-align:center; border: 1px solid #000;">Item Description</th>
                                <th style="width: 10%;text-align:center; border: 1px solid #000;">Quantity</th>
                                <th style="width: 10%;text-align:center; border: 1px solid #000;">UOM</th>
                                <th style="width: 15%;text-align:right; border: 1px solid #000;padding-right: 10px;">Unit Price</th>
                                <th style="width: 15%;text-align:right; border: 1px solid #000;padding-right: 10px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>';
                            $serial = 1;
                            foreach ($section as $row) {
                                $html .= '<tr>
                                    <td style="text-align:center; border: 1px solid #000;">' . $serial++ . '</td>
                                    <td style="text-align:center; border: 1px solid #000;">' . htmlspecialchars($row['part_no']) . '</td>
                                    <td style="border: 1px solid #000; padding-left: 10px;">' . htmlspecialchars($row['itemDescription']) . '</td>
                                    <td style="text-align:center; border: 1px solid #000;">' . htmlspecialchars($row['qty']) . '</td>
                                    <td style="text-align:center; border: 1px solid #000;">' . htmlspecialchars($row['measureType']) . '</td>
                                    <td style="text-align:right; border: 1px solid #000;padding-right: 10px;">' . htmlspecialchars(number_format($row['unitPrice'],2)) . '</td>
                                    <td style="text-align:right; border: 1px solid #000;padding-right: 10px;">' . htmlspecialchars(number_format($row['nettotal'],2)) . '</td>
                                </tr>';
                            }
                        $html.='</tbody>';
                        if ($index === count($dataArray) - 1) {
                            $html .= '<tfoot>
                                <tr>
                                    <td colspan="5" style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; font-size:12px; padding: 5px;">PRF INV DETAILS.</td>
                                    <td style="border-top: 1px solid #000; border-right: 1px solid #000; text-align:right; padding: 5px; padding-left:35px;">Total (Excl)</td>
                                    <td style="border-top: 1px solid #000; border-right: 1px solid #000; text-align:right; padding: 5px; padding-right:10px;"><label id="lbltotal"></label></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border-left: 1px solid #000; border-right: 1px solid #000; font-size:11px; padding: 5px;">IP REF</td>
                                    <td style="border-right: 1px solid #000; text-align:right; padding: 5px; padding-left:35px;">Tax</td>
                                    <td style="border-right: 1px solid #000; text-align:right; padding: 5px;padding-right:10px;"><label id="lbldiscount"></label></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;"></td>
                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; text-align:right; font-weight:bold; padding: 5px;padding-left:35px;">Total (Incl)</td>
                                    <th style="border-bottom: 1px solid #000; border-right: 1px solid #000; text-align:right;padding-right:10px; padding: 5px;"><label class="font-weight-bold text-dark" id="lblbalance"></label></th>
                                </tr>
                            </tfoot>';
                        } else {
                            $html .= '<tfoot>
                                <tr>
                                    <td colspan="5" style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; font-size:12px; padding: 5px;">PRF INV DETAILS.</td>
                                    <td style="border-top: 1px solid #000; border-right: 1px solid #000; text-align:right; padding: 5px; padding-left:35px;">Total (Excl)</td>
                                    <td style="border-top: 1px solid #000; border-right: 1px solid #000; text-align:right; padding: 5px;padding-right:10px;"><label id="lbltotal">'.number_format($net,2).'</label></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border-left: 1px solid #000; border-right: 1px solid #000; font-size:11px; padding: 5px;">IP REF</td>
                                    <td style="border-right: 1px solid #000; text-align:right; padding: 5px; padding-left:35px;">Tax</td>
                                    <td style="border-right: 1px solid #000; text-align:right; padding: 5px;padding-right:10px;"><label id="lbldiscount"></label></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;"></td>
                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; text-align:right; font-weight:bold; padding: 5px;padding-left:35px;">Total (Incl)</td>
                                    <th style="border-bottom: 1px solid #000; border-right: 1px solid #000; text-align:right;padding-right:10px; padding: 5px;"><label class="font-weight-bold text-dark" id="lblbalance">'.number_format($net,2).'</label></th>
                                </tr>
                            </tfoot>';
                        }
                $html .= '</table>';
                // Add remark after the table
                $html .= '<p style="margin-top:15px; font-size:12px; font-family: Arial, sans-serif;">
                    Remark : Will return the subject goods failed to contain good quality.
                </p>';
                $html .= '</main>';
                if ($index === count($dataArray) - 1) {
                    $html .= '<div style="page-break-before: always;"></div>';
                }
            }
        $html .= '</body>
        </html>';

        $this->load->library('pdf');
        $this->pdf->loadHtml($html);
        $this->pdf->render();
        $this->pdf->stream( "LANKASPIN - PURCHASE ORDER- ".$recordID.".pdf", array("Attachment"=>0));
    }

    private function getBase64Logo() {
        // Option 1: Load from file and convert to base64
        $image_path = FCPATH . 'images/logo1.png'; // Adjust path as needed
        if (file_exists($image_path)) {
            $image_data = file_get_contents($image_path);
            $image_type = pathinfo($image_path, PATHINFO_EXTENSION);
            return 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);
        }
        
   }

}
