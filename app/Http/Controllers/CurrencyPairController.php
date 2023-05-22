<?php

namespace App\Http\Controllers;

use App\Models\CurrencyPair;
use Illuminate\Http\Request;

class CurrencyPairController extends Controller
{
    public function create(Request $request) {
        $currency_pair = new CurrencyPair();
        $currency_pair->currency_1 = $request['currency_1'];
        $currency_pair->currency_2 = $request['currency_2'];
        $currency_pair->title = $request['title'];
        $currency_pair->save();

        return redirect()->route('rates');
    }

    public function update( $id, Request $request) {
        $currency_pair = CurrencyPair::where("id", $id)->first();
        $currency_pair->title = $request['title'];
        $currency_pair->save();

        return redirect()->route('rates');
    }

    public function delete( $id ) {
        $currency_pair = CurrencyPair::where("id", $id)->first();
        $currency_pair->delete();

        return redirect()->route('rates');
    }
}
