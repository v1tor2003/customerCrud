<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
       'customer_id', 'cep', 'state', 'city', 'district', 'street', 'number',
    ];
    

}
