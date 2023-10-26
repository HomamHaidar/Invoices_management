<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;

class Clients_reportController extends Controller
{
    public function index (){
        $sections=sections::all();
        return view('reports.clients_report',compact('sections'));

    }
    public function search_clients(Request $request){

          $sections=sections::all();

        if ($request->Section && $request->product && $request->start_at=='' && $request->end_at=='')
        {
            $invoices=invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();

            return view('reports.clients_report',compact('sections'))->withDetails($invoices);

        }
        else
        {
            $start_at=date($request->start_at);
            $end_at=date($request->end_at);

            $invoices=invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->whereBetween('invoice_Date',[ $start_at,$end_at])->get();
            return view('reports.clients_report',compact('sections','start_at','end_at'))->withDetails($invoices);

        }
    }
}
