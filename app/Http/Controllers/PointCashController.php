<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyPair;
use App\Models\Operation;
use App\Models\PointCash;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointCashController extends Controller
{
    private function operationLog( $point_id, $rate, $income_currency_id = null, $outcome_currency_id = null, $income_amount = null, $outcome_amount = null, $client_id = null, $comments = null )
    {
        $operation = new Operation();
        $operation->point_id = $point_id;
        $operation->user_id = Auth::user()->id;
        $operation->client_id = $client_id;
        $operation->comments = $comments;
        $operation->rate = $rate;
        $operation->income_currency_id = $income_currency_id;
        $operation->income_amount = $income_amount;
        $operation->outcome_currency_id = $outcome_currency_id;
        $operation->outcome_amount = $outcome_amount;
        $operation->created_at = date("Y-m-d H:i:s");
        $operation->save();
    }

    public function income( Request $request ) {
        $point = PointCash::where([
            ["point_id", "=", $request->point_id],
            ["currency_id", "=", $request->currency_id],
        ])->first();
        $point->amount += $request->amount;

        if ($point->save()) {
            $this->operationLog(
                $request->point_id,
                1,
                $request->currency_id,
                null,
                $request->amount,
                null,
                null,
                ""
            );
            return redirect()->route('exchange',
                array(
                    "message" => "Каса підкріплена успішно",
                    "type" => "success",
                )
            );
        } else {
            return redirect()->route('exchange', array(
                "message" => "Помилка при підкріплені каси",
                "type" => "danger",
            ));
        }
    }

    public function withdraw( Request $request ) {
        $point = PointCash::where([
            ["point_id", "=", $request->point_id],
            ["currency_id", "=", $request->currency_id],
        ])->first();
        if ($point->amount > $request->amount) {
            $point->amount -= $request->amount;

            if ($point->save()) {
                $this->operationLog(
                    $request->point_id,
                    1,
                    null,
                    $request->currency_id,
                    null,
                    $request->amount,
                    null,
                    ""
                );
                return redirect()->route('exchange',
                    array(
                        "message" => "Кошти успішно інкасовано",
                        "type" => "success",
                    )
                );
            } else {
                return redirect()->route('exchange', array(
                    "message" => "Помилка при інкасації коштів",
                    "type" => "danger",
                ));
            }

        } else {
            return redirect()->route('exchange', array(
                "message" => "Недостатньо коштів у касі",
                "type" => "danger",
            ));
        }

    }

    public function exchange( Request $request ) {
        $cash_income = PointCash::where([
            ["point_id", "=", $request->point_id],
            ["currency_id", "=", $request->from_currency],
        ])->first();

        $cash_withdraw = PointCash::where([
            ["point_id", "=", $request->point_id],
            ["currency_id", "=", $request->to_currency],
        ])->first();

        if ($cash_withdraw->amount < $request->to_amount) {
            return redirect()->route('exchange', array(
                "message" => "Недостатньо коштів y касі",
                "type" => "danger",
            ));
        } else {
            $cash_income->amount += $request->from_amount;
            $cash_withdraw->amount -= $request->to_amount;
        }

        if ($cash_income->save() && $cash_withdraw->save()) {
            $this->operationLog(
                $request->point_id,
                $request->rate,
                $request->from_currency,
                $request->to_currency,
                $request->from_amount,
                $request->to_amount,
                null,
                $request->comments
            );
            return redirect()->route('exchange',
                array(
                    "message" => "Обмін виконано успішно",
                    "type" => "success",
                )
            );
        } else {
            return redirect()->route('exchange', array(
                "message" => "Помилка при обміні",
                "type" => "danger",
            ));
        }
    }

    public function confirmPage( Request $request ) {
        $from_currency = $request->from_currency_id;
        $from_amount = $request->amount;
        $to_currency = $request->to_currency_id;

        $pair = CurrencyPair::where([
            ["currency_1_id", "=", $from_currency],
            ["currency_2_id", "=", $to_currency],
        ])->orWhere([
            ["currency_1_id", "=", $to_currency],
            ["currency_2_id", "=", $from_currency],
        ])->first();

        if (!$pair) {
            return redirect()->route('exchange', array(
                "message" => "Валютної пари не існує",
                "type" => "danger",
            ));
        }

        $rate = Rate::where([
            ["pair_id", "=", $pair->id],
            ["point_id", "=", $request->point_id],
        ])->first();

        if ($pair->currency_1_id == $from_currency) {
            $to_amount = round($from_amount / $rate->buy_price, 2);
            $rate = $rate->buy_price;
        } elseif ($pair->currency_2_id == $from_currency) {
            $to_amount = round($from_amount * $rate->sell_price, 2);
            $rate = $rate->sell_price;
        }

        return view('users.cashier.confirm-exchange', array(
            "point_id" => $request->point_id,
            "rate" => $rate,
            "from_currency_id" => $from_currency,
            "from_currency" => Currency::where("id", "=", $from_currency)->first()->code,
            "from_amount" => $from_amount,
            "to_currency_id" => $to_currency,
            "to_currency" => Currency::where("id", "=", $to_currency)->first()->code,
            "to_amount" => $to_amount
        ));
    }

    public function refreshExchange( Request $request ) {
        $from_currency = $request->from_currency;
        $from_amount = $request->from_amount;
        $to_currency = $request->to_currency;

        $to_amount = round($from_amount / $request->rate, 2);

        return view('users.cashier.confirm-exchange', array(
            "point_id" => $request->point_id,
            "rate" => $request->rate,
            "from_currency_id" => $from_currency,
            "from_currency" => Currency::where("id", "=", $from_currency)->first()->code,
            "from_amount" => $from_amount,
            "to_currency_id" => $to_currency,
            "to_currency" => Currency::where("id", "=", $to_currency)->first()->code,
            "to_amount" => $to_amount
        ));
    }
}

