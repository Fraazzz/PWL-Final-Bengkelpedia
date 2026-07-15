<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class DownloadController extends BaseController
{
    public function index()
    {
        $html ="<h1>Sales Report</h1>";
        $html .=date("Y-m-d H:i:s");

        $pdf = new Dompdf();
        
        $pdf ->loadHtml($html);
        $pdf ->setPaper("A4","Potrait");
        $pdf ->render();
         $pdf ->stream ("sales-report-" .date("dmY"). '.pdf',[
            "Attachment" => false
         ]
         
         );
         exit();
    }
}
