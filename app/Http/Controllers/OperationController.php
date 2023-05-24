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

        $filter = array(
            "income_amount_min" => $request->income_amount_min,
            "income_amount_max" => $request->income_amount_max,
            "income_currency_id" => $request->income_currency_id,
            "outcome_amount_min" => $request->outcome_amount_min,
            "outcome_amount_max" => $request->outcome_amount_max,
            "outcome_currency_id" => $request->outcome_currency_id,
            "rate" => $request->rate,
            "date_time_from" => $request->date_time_from,
            "date_time_till" => $request->date_time_till,
        );

        $point = Point::where("employee_id", Auth::user()->id)->first();

        $condition = $this->getCondition($request);
        $condition[] = ["point_id", "=", $point->id];

        $operations = Operation::where($condition)->orderBy("created_at", "desc")->take(10)->get();

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

    private function getCondition(Request $request) {
        $condition = array();

        if ($request->income_amount_min) {
            $condition[] = ["income_amount", ">=", $request->income_amount_min];
        }
        if ($request->income_amount_max) {
            $condition[] = ["income_amount", "<=", $request->income_amount_max];
        }
        if (is_int($request->income_currency_id)) {
            $condition[] = ["income_currency_id", "=", $request->income_currency_id];
        }
        if ($request->outcome_amount_min) {
            $condition[] = ["outcome_amount", ">=", $request->outcome_amount_min];
        }
        if ($request->outcome_amount_max) {
            $condition[] = ["outcome_amount", "<=", $request->outcome_amount_max];
        }
        if (is_int($request->outcome_currency_id)) {
            $condition[] = ["outcome_currency_id", "=", $request->outcome_currency_id];
        }
        if ($request->rate) {
            $condition[] = ["rate", "=", $request->rate];
        }
        if ($request->date_time_from) {

            $startDate = Carbon::createFromFormat("Y-m-d", $request->date_time_from)->startOfDay();

            if ($request->date_time_till) {
                $endDate = Carbon::createFromFormat("Y-m-d", $request->date_time_till)->endOfDay();
            } else {
                $endDate = Carbon::createFromFormat("Y-m-d", $request->date_time_from)->addDay();
            }

            $condition[] = ["created_at", ">=", $startDate];
            $condition[] = ["created_at", "<=", $endDate];
        }

        if (!$request->date_time_from && $request->date_time_till) {
            $startDate = Carbon::createFromFormat('Y-m-d', "01/01/1970");

            $endDate = Carbon::createFromFormat('Y-m-d', strtotime($request->date_time_till))->endOfDay();

            $condition[] = ["created_at", ">=", $startDate];
            $condition[] = ["created_at", "<=", $endDate];
        }

        return $condition;
    }

    public function cancelOperation(Request $request)
    {
        $operation = Operation::where("id", $request->operation_id)->first();

        if ($operation) {
            $operation->status = 2;
            $operation->save();

            return redirect()->route('operations');
        }
    }
}
