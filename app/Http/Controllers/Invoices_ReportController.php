<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class Invoices_ReportController extends Controller
{
    public  function index(){
        return view('reports.invoices_report');
    }

    public function search_invoices(Request $request){

        $rdio=$request->rdio;
        $start_at=date($request->start_at);
        $end_at=date($request->end_at);
        $type=$request->type;
        if ($rdio==='1'){

            if ($request->type==='كل الفواتير' && $request->start_at=='' && $request->end_at=='') {
                $invoices =invoices::all();
                return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }

            if ($request->type==='كل الفواتير') {
                $invoices =invoices::all()->whereBetween('invoice_Date',[$start_at,$end_at]);
                return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
            }

            if ($request->type && $request->start_at=='' && $request->end_at==''){
                $invoices =invoices::select('*')->where('Status','=',$request->type)->get();

                return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }
            else {
                $invoices=invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
            }

        }
        if($rido='2'){
                 $invoices =invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
                  return view('reports.invoices_report')->withDetails($invoices);

        }



  }

}
