<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function expenseCat()
    {
        return $this->belongsTo(ExpenseCat::class, 'expense_cat_id');
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function SubFarm()
    {
        return $this->belongsTo(SubFarm::class);
    }
}
