<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;
class TestPDF extends Controller
{
    public function generate()
    {
    	$data= CountryModel::get();
    	$fileName = 'Country_List.pdf';
    	$mpdf = new \Mpdf\Mpdf([
    		'margin_left' => 10,
    		'margin_right' => 10,
    		'margin_top' => 10,
    		'margin_bottom' => 10,
    		'margin_header' => 10,
    		'margin_footer' => 10
    	]);

    	$html = \View::make('admin.pdf.demo')->with('data',$data);
    	$html = $html->render();

    	$mpdf->SetHeader('Chapter 1|Country list|{PAGENO}');
    	$mpdf->SetFooter('this is footer');
    	
    	$mpdf->WriteHTML($html);
    	$mpdf->Output($fileName,'I');
    	// return view('admin.pdf.demo',compact('data'));
    }
}
