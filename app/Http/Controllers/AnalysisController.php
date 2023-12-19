<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalysisController
{
    public function analysisTotal(Request $request)
    {
        $ch = curl_init();
        $fields_string = [
          'auth' => 'fiNik_8_4l**_77nd'
        ];

        $date_from = date("Y-m-d", strtotime('-1 day', strtotime($request->date_from)));
        $date_to = $request->date_to;
        $point_id = $request->point_id;

        curl_setopt($ch,CURLOPT_URL, "https://finik-obmin.com.ua/operations.php?date_from=$date_from&date_to=$date_to&point_id=$point_id");
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        $currency_map = [
            'uah' => ['code' => 'UAH'],
            'usd' => ['code' => 'USD', 'sell' => 'uA', 'buy' => 'uB'],
            'eur' => ['code' => 'EUR', 'sell' => 'eA', 'buy' => 'eB'],
            'rub' => ['code' => 'CHF', 'sell' => 'rA', 'buy' => 'rB'],
            'pol' => ['code' => 'PLN', 'sell' => 'pA', 'buy' => 'pB'],
            'gbr' => ['code' => 'GBP', 'sell' => 'fA', 'buy' => 'fB'],
        ];

        $leftovers_start = [];
        $leftovers_end = [];

        foreach ($currency_map as $shitty => $currency) {
            $leftovers_start[$currency['code']] = end($result['leftovers'])[$shitty];
        }

        foreach ($currency_map as $shitty => $currency) {
            $leftovers_end[$currency['code']] = $result['leftovers'][0][$shitty];
        }

        array_pop($result['leftovers']);

        $average_rates = [
            'UAH' => ['sell' => 0, 'buy' => 0, 'count' => 0],
            'USD' => ['sell' => 0, 'buy' => 0, 'count' => 0],
            'EUR' => ['sell' => 0, 'buy' => 0, 'count' => 0],
            'CHF' => ['sell' => 0, 'buy' => 0, 'count' => 0],
            'PLN' => ['sell' => 0, 'buy' => 0, 'count' => 0],
            'GBP' => ['sell' => 0, 'buy' => 0, 'count' => 0],
        ];

        foreach ($result['leftovers'] as $leftover) {
            foreach ($currency_map as $shitty => $currency) {
                if ($shitty == 'uah') {
                    continue;
                }
                if ($leftover[$currency['sell']]) {
                    $average_rates[$currency['code']]['sell'] += $leftover[$currency['sell']];
                    $average_rates[$currency['code']]['buy'] += $leftover[$currency['buy']];
                    $average_rates[$currency['code']]['count']++;
                }
            }
        }

        foreach ($average_rates as $currency => $rate) {
            if ($currency == 'UAH') {
                continue;
            }
            $average_rates[$currency]['sell'] = round($rate['sell'] / $rate['count'], 2);
            $average_rates[$currency]['buy'] = round($rate['buy'] / $rate['count'], 2);
        }

        $money_moves = [
            'UAH' => 0,
            'USD' => 0,
            'EUR' => 0,
            'CHF' => 0,
            'PLN' => 0,
            'GBP' => 0,
        ];

        foreach ($result['operations'] as $operation) {

            if (!is_null($operation['income'])) {
                foreach ($operation['income'] as $income) {
                    $money_moves[$income['currency']] += $income['amount'];
                }
            }

            if (!is_null($operation['outcome'])) {
                foreach ($operation['outcome'] as $outcome) {
                    $money_moves[$outcome['currency']] -= $outcome['amount'];
                }
            }

        }

        $result_by_currency = [
            'UAH' => 0,
            'USD' => 0,
            'EUR' => 0,
            'CHF' => 0,
            'PLN' => 0,
            'GBP' => 0,
        ];

        foreach ($currency_map as $shitty => $currency) {
            if ($shitty == 'uah') {
                $result_by_currency[$currency['code']] = $leftovers_start[$currency['code']] + $money_moves[$currency['code']];
            } else {
                $middle = $leftovers_start[$currency['code']] + $money_moves[$currency['code']] - $leftovers_end[$currency['code']];

                if ($middle >= 0) {
                    $result_by_currency[$currency['code']] = $middle * $average_rates[$currency['code']]['sell'];
                } else {
                    $result_by_currency[$currency['code']] = $middle * $average_rates[$currency['code']]['buy'];
                }
            }
        }

        $summ = 0;

        foreach ($result_by_currency as $currency => $value) {
            $summ += $value;
        }

//        echo "Сума: ". ($leftovers_end['UAH'] - $summ); // ?
        echo "Сума: ". ($summ - $leftovers_end['UAH']);

        echo "<pre>";
//        print_r($result['leftovers']);
//        print_r($result['operations']);
//        print_r($leftovers_start);
        print_r($leftovers_end);
//        print_r($average_rates);
//        print_r($money_moves);
        print_r($result_by_currency);
        exit();

        return view('users.manager.analytics.dashboard');
    }
}
