<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyEntry extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function subFarm()
    {
        return $this->belongsTo(SubFarm::class, 'sub_farm_id');
    }
    // public function purchase()
    // {
    //     return $this->belongsTo(Purchase::class, 'sub_farm_id',  'sub_farm_id');
    // }
}
