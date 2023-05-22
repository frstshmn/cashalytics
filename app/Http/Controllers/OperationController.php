<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function getCashierPage(Request $request) {
        $point = Point::where("employee_id", Auth::user()->id)->first();
        $operations = Operation::where("point_id", $point->id)->orderBy("created_at", "desc")->take(10)->get();
        $filter = array(
            "income_amount_min" => $request->income_amount_min,
            "income_amount_max" => $request->income_amount_max,
            "income_currency_id" => $request->income_currency_id,
            "outcome_amount_min" => $request->outcome_amount_min,
            "outcome_amount_max" => $request->outcome_amount_max,
            "outcome_currency_id" => $request->outcome_currency_id,
            "rate" => $request->rate,
            "date_time" => $request->date_time,
        );

        if ($request->income_amount_min) {
            $operations = $operations->where("income_amount", ">=", $request->income_amount_min);
        }
        elseif ($request->income_amount_max) {
            $operations = $operations->where("income_amount", "<=", $request->income_amount_max);
        }
        elseif ($request->income_currency_id) {
            $operations = $operations->where("income_currency_id", $request->income_currency_id);
        }
        elseif ($request->outcome_amount_min) {
            $operations = $operations->where("outcome_amount", ">=", $request->outcome_amount_min);
        }
        elseif ($request->outcome_amount_max) {
            $operations = $operations->where("outcome_amount", "<=", $request->outcome_amount_max);
        }
        elseif ($request->outcome_currency_id) {
            $operations = $operations->where("outcome_currency_id", $request->outcome_currency_id);
        }
        elseif ($request->rate) {
            $operations = $operations->where("rate", $request->rate);
        }
        elseif ($request->date_time) {
            $startDate = Carbon::createFromFormat('d/m/Y', date("Y-m-d H:i:s", strtotime($request->date_time)));
            $endDate = Carbon::createFromFormat('d/m/Y', date("Y-m-d H:i:s", strtotime("+1", strtotime($request->date_time))));

            $operations = $operations->whereBetween(
                "created_at", [$startDate, $endDate]
            );
        }

        if ($point) {
            if ($request->message) {
                return view('users.cashier.operations', array(
                    "point" => $point,
                    "operations" => $operations,
                    "message" => $request->message,
                    "type" => $request->type,
                    "filter" => $filter,
                ));
            } else {
                return view('users.cashier.operations', array(
                    "point" => $point,
                    "operations" => $operations,
                    "filter" => $filter,
                ));
            }
        } else {
            return redirect()->route('points');
        }
    }
}
