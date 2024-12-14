<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function comboPlans()
    {
        return $this->belongsToMany(ComboPlan::class, 'combo_plan_plan');
    }
}
