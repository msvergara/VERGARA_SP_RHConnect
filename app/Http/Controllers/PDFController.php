<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    //
    public function generate_pdfmedcert(Request $request, $session_id = null)
    {
        $metadata = [
            [
                'title' => 'Patients List',
            ]
        ];

        // $indivdata = Patients::find($session_id);
        $sessiondata = Session::find($session_id);
        // return view('pages.patient.indivviewpatient',['indivdata'=>$indivdata],['sessiondata'=>$sessiondata]);    

        $pdf = Pdf::loadView('pages.exports.pdfmedcert', ['metadata' => $metadata, 'data' => $sessiondata]);
        return $pdf->download('document.pdf');
    }
    
    public function generate_pdfreferral(Request $request, $session_id = null)
    {
        $metadata = [
            [
                'title' => 'Patients List',
            ]
        ];

        // $indivdata = Patients::find($session_id);
        $sessiondata = Session::find($session_id);
        // return view('pages.patient.indivviewpatient',['indivdata'=>$indivdata],['sessiondata'=>$sessiondata]);    

        $pdf = Pdf::loadView('pages.exports.pdfreferral', ['metadata' => $metadata, 'data' => $sessiondata]);
        return $pdf->download('document.pdf');
    }
}
