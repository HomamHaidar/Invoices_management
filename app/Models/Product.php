<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'Product_name',
        'section_name',
        'description',
        'section_id'
    ];



        public function sections()
        {
            return $this->belongsTo(sections::class, 'section_id');
        }

 }

