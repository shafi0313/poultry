<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function subFarm()
    {
        return $this->belongsTo(SubFarm::class);
    }

    public function dailyEntries()
    {
        return $this->hasMany(DailyEntry::class, 'sub_farm_id', 'sub_farm_id');
    }
}
