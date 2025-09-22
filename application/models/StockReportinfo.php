<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class StockReportinfo extends CI_Model {

    public function Suppliearget() {
        $this->db->select('suppliername, idtbl_supplier');
        $this->db->from('tbl_supplier');
        $this->db->where('status', 1);
        $respond = $this->db->get();
        return $respond;
    }

    public function Machinemodelget() {
        $this->db->select('name, id');
        $this->db->from('machine_models');
        $this->db->where('active', 1);
        $respond = $this->db->get();
        return $respond;
    }

    public function generateStockReportPDF($rows, $filters)
    {
        $this->load->library('pdf');

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        $logo_base64 = $this->getBase64Logo();

        $html = '
        <html>
        <head>
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
                table { border-collapse: collapse; width: 100%; }
                th { border: 1px solid #000; padding: 5px; text-align: center; }
                td { border: 1px solid #000; padding: 5px; text-align: center; }
                th { background-color: #f2f2f2; }
                .text-right { text-align: right; }
                .header-row {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 10px;
                    padding: 5px 0;
                }
                .logo-container {
                    flex-shrink: 0;
                }
                .logo-container img {
                    max-height: 40px;
                    max-width: 250px;
                }
                .title-container {
                    flex-grow: 1;
                    text-align: center;
                }
                .title-container h2 {
                    margin: 0;
                    padding: 0;
                }
                
                /* Alternative: Logo on right side */
                .header-row.logo-right {
                    flex-direction: row-reverse;
                }
            </style>
        </head>
        <body>
            <div class="header-row">
                <div class="logo-container">
                    <img src="' . $logo_base64 . '" alt="Company Logo" />
                </div>
                <div class="title-container">
                    <h2>Stock Report</h2>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Sparepart / Material / Machine</th>
                        <th>Batch No</th>
                        <th>Qty</th>
                        <th class="text-right">Unit Price</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($rows as $r) {
            $colValue = '';
            if ($filters['search_type'] == 1) {
                $colValue = htmlspecialchars($r['name']);
            } elseif ($filters['search_type'] == 2 && isset($r['materialname'])) {
                $colValue = htmlspecialchars($r['materialname']);
            } elseif (isset($r['machine'])) {
                $colValue = htmlspecialchars($r['machine']);
            }

            $html .= '
                <tr>
                    <td>' . $colValue . '</td>
                    <td>' . htmlspecialchars($r['batchno']) . '</td>
                    <td>' . htmlspecialchars($r['qty']) . '</td>
                    <td class="text-right">' . number_format($r['unitprice'], 2) . '</td>
                </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Fixed typo: 'potrait' -> 'portrait'
        $dompdf->render();

        $dompdf->stream("GRN_Stock_Report.pdf", ["Attachment" => 0]);
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