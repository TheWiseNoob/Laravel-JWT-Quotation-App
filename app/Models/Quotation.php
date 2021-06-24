<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;





class Quotation extends Model
{
    public $table = 'quotations';
    protected $fillable = [
        "id", "start_date", "end_date", "total", "currency_id"
    ];

}
