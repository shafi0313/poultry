<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalSales extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function subFarm()
    {
        return $this->belongsTo(SubFarm::class, 'sub_farm_id');
    }
}
