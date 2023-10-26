<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_Invoice',
        'invoice_number',
        'product',
        'section_id',
        'Status',
        'Value_Status',
        'Payment_Date',
        'note',
        'user',
    ];
}
