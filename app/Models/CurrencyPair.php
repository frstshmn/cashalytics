<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPair extends Model
{
    use HasFactory;

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function getCurrencies(){
        $currency_1 = Currency::where("id", $this->currency_1)->first();
        $currency_2 = Currency::where("id", $this->currency_2)->first();

        return [$currency_1, $currency_2];
    }
}
