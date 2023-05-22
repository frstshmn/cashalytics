<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyPair;
use App\Models\Point;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function setRates(Request $request) {

        $upsert = array();

        foreach($request['points'] as $point) {
            foreach($request['pairs'] as $pair) {
                $upsert[] = [
                    'pair_id' => $pair,
                    'point_id' => $point,
                    'sell_price' => $request['sell-'.$pair],
                    'buy_price' => $request['buy-'.$pair]
                ];
            }
        }

        DB::table('rates')->upsert(
            $upsert,
            ['pair_id', 'point_id'],
            ['sell_price', 'buy_price']
        );

        return $this->ratesList();
    }

    // Views
    public function ratesList() {
        $rates = Rate::all();
        $points = Point::all();
        $currencies = Currency::all();
        $currency_pairs = CurrencyPair::all();
        return view('users.manager.rates', array(
            "rates" => $rates,
            "points" => $points,
            "currencies" => $currencies,
            "currency_pairs" => $currency_pairs
        ));
    }
}
