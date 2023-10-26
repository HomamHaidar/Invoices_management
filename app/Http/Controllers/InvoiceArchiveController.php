<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Storage;

class InvoiceArchiveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ارشيف الفواتير', ['only' => ['index']]);

    }

    public function index(){
        $invoices=invoices::onlyTrashed()->get();
        return view('invoices.archive',compact('invoices'));
    }

    public function store($id){
        return $id;
    }
    public function update($id)
    {
        $invoices=invoices::where('id',$id)->first()->delete();
        session()->flash('archive_invoice');
        return redirect('archive');


    }
    public function destroy($id)
    {


        $attachments=invoices_attachments::where('invoice_id',$id)->first();

        if(! empty($attachments->invoice_number))
        {
            Storage::disk('public_uploads')->deleteDirectory($attachments->invoice_number);
        }


        $invoices=invoices::withTrashed()->where('id',$id)->first()->forceDelete();
        session()->flash('delete_invoice');
        return redirect('archive');

    }
    public function restore($id)
    {
        $invoices=invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('restore_invoice');
        return redirect('invoices');


    }
}
