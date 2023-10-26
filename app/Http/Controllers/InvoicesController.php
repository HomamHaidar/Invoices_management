<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\invoices;
use App\Models\User;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\AddInvoice;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use App\Notifications\Add_invoice_new;


class InvoicesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=sections::all();
        return view("invoices.add_invoice",compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required',
            'invoice_Date'=> 'required',
            'Due_date'=> 'required',
            'product'=> 'required',
           'Amount_collection'=> 'required',
            'Amount_Commission'=> 'required',
            'Discount'=> 'required',
            'Value_VAT'=> 'required',
            'Rate_VAT'=> 'required',
            'Total'=> 'required',
            'note'=> 'required',


        ]);
        invoices::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'Due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'Discount'=>$request->Discount,
            'Value_VAT'=>$request->Value_VAT,
            'Rate_VAT'=>$request->Rate_VAT,
            'Total'=>$request->Total,
            'Status'=>'غير مدفوعة',
            'Value_Status'=>2,
            'note'=>$request->note,
        ]);
        $invoices_id=invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice'=>$invoices_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Status'=>'غير مدفوعة',
            'Value_Status'=>2,
            'note'=>$request->note,
            'user'=>(Auth::user()->name),
        ]);
        if ($request->hasfile('pic')){
            $invoices_id=invoices::latest()->first()->id;
            $image=$request->file('pic');
            $file_name=$image->getClientOriginalName();
            $invoice_number=$request->invoice_number;

            $attachments= new invoices_attachments();
            $attachments->file_name=$file_name;
            $attachments->invoice_number= $invoice_number;
            $attachments->Created_by=Auth::user()->name;
            $attachments->invoice_id=$invoices_id;
            $attachments->save();
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        $users = User::where('id', '!=', Auth::user()->id)->get();
        $invoice_id_notify=invoices::latest()->first();
        Notification::send($users,new Add_invoice_new($invoice_id_notify));

        session()->flash('add_invoice');

        return redirect('invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $invoices=invoices::where('id',$id)->first();
            return view('invoices.payment_show',compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices=invoices::where('id',$id)->first();
        $sections=sections::all();
        return view('invoices.edit_invoices',compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $invoices=invoices::findOrFail($id);
        $invoices->update([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'Due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'Discount'=>$request->Discount,
            'Value_VAT'=>$request->Value_VAT,
            'Rate_VAT'=>$request->Rate_VAT,
            'Total'=>$request->Total,
            'note'=>$request->note,
        ]);

        session()->flash('edit_invoice');
        return redirect()->route('invd', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoices=invoices::where('id',$id)->first();
        $attachments=invoices_attachments::where('invoice_id',$id)->first();

        if(! empty($attachments->invoice_number))
        {
            Storage::disk('public_uploads')->deleteDirectory($attachments->invoice_number);
        }

        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('invoices');

    }

    public function getproducts($id)
    {
        $products=DB::table('products')->where('section_id',$id)->pluck('Product_name','id');
    return json_encode($products);
    }

    public function payment_change($id ,Request $request){
        $invoices= invoices::findOrFail($id);

            if($request->Status==='مدفوعة')
        {
            $invoices->update([
                'Status'=>$request->Status,
                'Value_Status'=>1,
                'Payment_Date'=>$request->Payment_Date
            ]);
        invoices_details::create([
            'id_Invoice'=>$id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section_id'=>$request->section_id,
            'Status'=>$request->Status,
            'Value_Status'=>1,
            'Payment_Date'=>$request->Payment_Date,
            'note'=>$request->note,
            'created_at'=>$request->created_at,
            'user'=>(Auth::user()->name)
        ]);
        }
         else
        {
            $invoices->update([
                'Status'=>$request->Status,
                'Value_Status'=>3,
                'Payment_Date'=>$request->Payment_Date
            ]);
        invoices_details::create([
            'id_Invoice'=>$id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section_id'=>$request->section_id,
            'Status'=>$request->Status,
            'Value_Status'=>3,
            'Payment_Date'=>$request->Payment_Date,
            'note'=>$request->note,
            'created_at'=>$request->created_at,
            'user'=>(Auth::user()->name)
        ]);
        }
         session()->flash('Status_Update');
        return redirect()->route('invd', [$id]);

    }

  public function paid_inv (){
      $invoices=invoices::where('Value_Status',1)->get();
      return view('invoices.paid_inv',compact('invoices'));
  }
  public function unpaid_inv (){
      $invoices=invoices::where('Value_Status',2)->get();
      return view('invoices.unpaid_inv',compact('invoices'));
  }
  public function partly_paid_inv  (){
      $invoices=invoices::where('Value_Status',3)->get();
      return view('invoices.partly_paid_inv',compact('invoices'));
  }


public function print($id)
{
    $invoice=invoices::where('id',$id)->first();
    return view('invoices.print_invoice',compact('invoice'));
}

    public function export()
    {
        return Excel::download(new InvoicesExport, 'users.xlsx');
    }


public function MarkALLAsRead(Request $request){

    $unread=auth()->user()->unreadNotifications;
    if($unread) {
        $unread->markAsRead();
        return back();
    }
}
public function MarkAsRead()
{
    
        return back();

}
}
