<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = 'color_product';
    protected $guarded = false;

    protected $fillable = [
        'color_id',
        'product_id',
    ];
}
