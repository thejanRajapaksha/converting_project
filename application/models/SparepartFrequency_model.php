<?php
class SparepartFrequency_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllSpareParts()
    {
        try {
            $this->db->select('id, name, part_no, model');
            $this->db->from('spare_parts');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->order_by('name', 'ASC');
            return $this->db->get()->result();
        } catch (Exception $e) {
            error_log('Error getting spare parts: ' . $e->getMessage());
            return [];
        }
    }

    public function getSparePartFrequency($sparepart_id, $month, $machinetype = null, $machinemodel = null)
    {
        try {
            if (empty($sparepart_id) || empty($month)) {
                return [];
            }

            $month_arr = explode('-', $month);
            $year = $month_arr[0];
            $month_num = $month_arr[1];

            $this->db->select('
            g.idtbl_print_grn,
            g.grn_no,
            g.batchno,
            g.grndate,
            s.suppliername,
            l.location,
            gd.qty,
            gd.unitprice,
            sp.name as sparepart_name,
            sp.part_no,
            sp.type as machine_type,  
            sp.model as machine_model 
        ');
            $this->db->from('tbl_print_grn g');
            $this->db->join('tbl_print_grndetail gd', 'g.idtbl_print_grn = gd.tbl_print_grn_idtbl_print_grn', 'left');
            $this->db->join('tbl_supplier s', 'g.tbl_supplier_idtbl_supplier = s.idtbl_supplier', 'left');
            $this->db->join('tbl_location l', 'g.tbl_location_idtbl_location = l.idtbl_location', 'left');
            $this->db->join('spare_parts sp', 'gd.tbl_sparepart_id = sp.id', 'left');

            $this->db->where('gd.tbl_sparepart_id', $sparepart_id);
            $this->db->where('YEAR(g.grndate)', $year);
            $this->db->where('MONTH(g.grndate)', $month_num);
            $this->db->where('g.status IN (1,2)');
            $this->db->where('gd.qty >', 0);

            if (!empty($machinetype) && $machinetype !== '0') {
                $this->db->where('sp.type', $machinetype); 
            }

            if (!empty($machinemodel) && $machinemodel !== '0') {
                $this->db->where('sp.model', $machinemodel); 
            }

            $this->db->order_by('g.grndate', 'DESC');
            $this->db->order_by('g.grn_no', 'DESC');

            return $this->db->get()->result_array();

        } catch (Exception $e) {
            error_log('Error getting spare part frequency: ' . $e->getMessage());
            return [];
        }
    }

    public function generateFrequencyPDF($data, $sparepart_name, $month)
    {
        try {
            $this->generateHTMLReport($data, $sparepart_name, $month);

        } catch (Exception $e) {
            $this->generateHTMLReport($data, $sparepart_name, $month);
        }
    }

    private function generateHTMLReport($data, $sparepart_name, $month)
    {
        header('Content-Type: text/html; charset=utf-8');
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Spare Part GRN Frequency Report</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    margin: 20px;
                }

                table {
                    border-collapse: collapse;
                    width: 100%;
                    margin-top: 10px;
                }

                th,
                td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }

                .text-center {
                    text-align: center;
                }

                .text-right {
                    text-align: right;
                }

                .header {
                    text-align: center;
                    margin-bottom: 20px;
                    border-bottom: 2px solid #333;
                    padding-bottom: 10px;
                }

                .summary-info {
                    margin-bottom: 15px;
                    padding: 10px;
                    background-color: #f9f9f9;
                    border-left: 4px solid #007bff;
                }

                .footer {
                    margin-top: 20px;
                    padding-top: 10px;
                    border-top: 1px solid #333;
                    text-align: center;
                    font-size: 10px;
                }
            </style>
        </head>

        <body>
            <div class="header">
                <h2>Spare Part GRN Frequency Report</h2>
            </div>

            <div class="summary-info">
                <strong>Spare Part:</strong> <?php echo htmlspecialchars($sparepart_name); ?><br>
                <strong>Month:</strong> <?php echo htmlspecialchars($month); ?><br>
                <strong>Total GRN Count:</strong> <?php echo count($data); ?>
            </div>

            <?php if (!empty($data)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>GRN Number</th>
                            <th>Batch No</th>
                            <th>GRN Date</th>
                            <th>Supplier</th>
                            <th>Location</th>
                            <th>Quantity</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_qty = 0;
                        $total_amount = 0;
                        $counter = 1;

                        foreach ($data as $r):
                            $total = $r['qty'] * $r['unitprice'];
                            $total_qty += $r['qty'];
                            $total_amount += $total;
                            ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo htmlspecialchars($r['grn_no']); ?></td>
                                <td><?php echo htmlspecialchars($r['batchno']); ?></td>
                                <td><?php echo htmlspecialchars($r['grndate']); ?></td>
                                <td><?php echo htmlspecialchars($r['suppliername']); ?></td>
                                <td><?php echo htmlspecialchars($r['location']); ?></td>
                                <td><?php echo htmlspecialchars($r['qty']); ?></td>
                                <td class="text-right"><?php echo number_format($r['unitprice'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($total, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #e9ecef;">
                            <td colspan="6" class="text-right"><strong>Grand Total:</strong></td>
                            <td><strong><?php echo $total_qty; ?></strong></td>
                            <td></td>
                            <td class="text-right"><strong><?php echo number_format($total_amount, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #666; margin-top: 20px;">No GRN records found for the selected criteria.</p>
            <?php endif; ?>

            <div class="footer">
                Generated on: <?php echo date('Y-m-d H:i:s'); ?>
            </div>

            <script>
                window.onload = function () {
                    window.print();
                }
            </script>
        </body>

        </html>
        <?php
        exit;
    }
}