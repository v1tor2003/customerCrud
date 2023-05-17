<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $fillable = [
       'cep', 'state', 'city', 'district', 'street', 'number',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
