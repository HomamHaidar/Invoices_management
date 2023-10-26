<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Clients_reportController;
use App\Http\Controllers\Invoices_ReportController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
//Auth::routes(['register'=>false]);
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('invoices', InvoicesController::class);

    Route::resource('sections', SectionsController::class);

    Route::resource('products', ProductController::class);

    Route::get('section/{id}', [InvoicesController::class,'getproducts']);

    Route::get('InvoicesDetails/{id}', [InvoicesDetailsController::class,'show'])->name('invd');
    Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
    Route::get('view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file'])->name('view.file');
    Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');

    Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);

    Route::get('edit_invoice/{id}', [InvoicesController::class,'edit'])->name('edit.invoice');
    Route::get('delete_invoice/{id}', [InvoicesController::class,'destroy'])->name('delete.invoice');

    Route::get('payment_show/{id}',[InvoicesController::class,'show'])->name('payment.show');
    Route::post('payment_change/{id}',[InvoicesController::class,'payment_change'])->name('payment.change');

    Route::get('paid_inv',[InvoicesController::class,'paid_inv'])->name('paid.inv');
    Route::get('unpaid_inv',[InvoicesController::class,'unpaid_inv'])->name('unpaid.inv');
        Route::get('partly_paid_inv',[InvoicesController::class,'partly_paid_inv'])->name('partly.paid.inv');

    // Route::get('archive',[InvoiceArchiveController::class,'index'])->name('archive');
    // Route::post('update_archive/{id}',[InvoiceArchiveController::class,'update'])->name('update.archive');
    // Route::delete('archive_destroy/{id}',[InvoiceArchiveController::class,'delete'])->name('archive.destroy');

    Route::patch('archives_restore/{id}',[InvoiceArchiveController::class,'restore'])->name('archives.restore');
    Route::resource('archive', InvoiceArchiveController::class);

    Route::get('print_invoice/{id}',[InvoicesController::class,'print'])->name('print_invoice');
    Route::get('export_invoices/', [InvoicesController::class, 'export']);



    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);


    Route::get('invoices_report',[Invoices_ReportController::class,'index']);
    Route::post('Search_invoices',[Invoices_ReportController::class,'search_invoices']);

    Route::get('clients_report',[Clients_reportController::class,'index']);
    Route::post('Search_clients',[Clients_reportController::class,'search_clients']);

    Route::get('mark_all_as_read', [InvoicesController::class, 'MarkALLAsRead'])->name('mark_all_as_read');
    Route::get('mark_read', [InvoicesController::class, 'MarkAsRead'])->name('mark_read');

    Route::get('/{page}', [AdminController::class,'index']);

});
