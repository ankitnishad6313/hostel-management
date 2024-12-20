<?php

namespace App\Http\Controllers;

use App\Mail\RentInvoiceMail;
use Exception;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;

class InvoiceController extends Controller
{
    public function invoice(){

        // return view('emails.invoice');
        // Load HTML content from your view
        $html = view('emails.invoice')->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (with external CSS and images)
        $dompdf->render();

        // Output PDF to a variable
        $pdf_content = $dompdf->output();

        $data['name'] = "Ankit Kumar";
        $data['email'] = "ankitnishad6313@gmail.com";
        $data['title'] = "Rent Invoice Mail";
        $data['subject'] = "Rent Invoice";
        $data['body'] = "This is Testing Invoice mail.";

        try {
            $data['pdf'] = $pdf_content;
            Mail::to($data['email'])->send(new RentInvoiceMail($data));
            dd("Email has been sent successfully");
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
        
    }
}
