<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function employee() {
        return $this->belongsTo(User::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function cash() {
        return $this->hasMany(PointCash::class);
    }

    public function availableCurrencies() {
        return PointCash::where("point_id", $this->id)->get();
    }
}
