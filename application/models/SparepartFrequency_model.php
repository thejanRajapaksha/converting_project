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

    public function getSparePartFrequency($sparepart_id, $from_date, $to_date, $machinetype = null, $machinemodel = null)
    {
        try {

            if (empty($from_date) || empty($to_date)) {
                return [];
            }

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

            $this->db->where('g.grndate >=', $from_date);
            $this->db->where('g.grndate <=', $to_date);
            $this->db->where('g.status IN (1,2)', NULL, FALSE);
            $this->db->where('gd.qty >', 0);

            if (!empty($sparepart_id) && $sparepart_id != "0") {
                $this->db->where('gd.tbl_sparepart_id', $sparepart_id);
            }

            if (!empty($machinetype) && $machinetype != "0") {
                $this->db->where('sp.type', $machinetype);
            }

            if (!empty($machinemodel) && $machinemodel != "0") {
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

    public function generateFrequencyPDF($data, $sparepart_name, $from_date, $to_date)
    {
        try {
            $this->generateHTMLReport($data, $sparepart_name, $from_date, $to_date);

        } catch (Exception $e) {
            $this->generateHTMLReport($data, $sparepart_name, $from_date, $to_date);
        }
    }

    private function generateHTMLReport($data, $sparepart_name, $from_date, $to_date)
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
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
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
            </style>
        </head>

        <body>

            <div class="header">
                <h2>Spare Part GRN Frequency Report</h2>
            </div>

            <div class="summary-info">
                <strong>Spare Part:</strong> <?php echo htmlspecialchars($sparepart_name); ?><br>
                <strong>Date Range:</strong> <?php echo $from_date . " to " . $to_date; ?><br>
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
                                <td><?php echo $r['grn_no']; ?></td>
                                <td><?php echo $r['batchno']; ?></td>
                                <td><?php echo $r['grndate']; ?></td>
                                <td><?php echo $r['suppliername']; ?></td>
                                <td><?php echo $r['location']; ?></td>
                                <td><?php echo $r['qty']; ?></td>
                                <td class="text-right"><?php echo number_format($r['unitprice'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($total, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center;color:#555;">No GRN records found.</p>
            <?php endif; ?>

        </body>

        </html>
        <?php
        exit;
    }
}
