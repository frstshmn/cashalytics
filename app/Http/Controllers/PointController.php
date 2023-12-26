<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Point;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function getExchangePage( Request $request ) {
        $point = Point::where("employee_id", Auth::user()->id)->first();

        if (!$point) {
            return redirect()->route('points');
        }
        $operations = Operation::where("point_id", $point->id)->orderBy("created_at", "desc")->take(10)->get();

        if (Auth::user()->type_id == 1) {
            return redirect()->route('analysisTotal');
        } else {
            if ($point) {
                if ($request->message) {
                    return view('users.cashier.dashboard', array(
                        "point" => $point,
                        "operations" => $operations,
                        "message" => $request->message,
                        "type" => $request->type,
                    ));
                } else {
                    return view('users.cashier.dashboard', array(
                        "point" => $point,
                        "operations" => $operations
                    ));
                }
            } else {
                return redirect()->route('points');
            }
        }
    }

    public function pointsLoginList() {
        $points = Point::all();
        return view('users.cashier.points', array(
            "points" => $points
        ));
    }

    public function login( Request $request ) {

        $point = Point::where("id", $request->point_id)->first();

        if ($request->pincode == $point->pincode) {
            $point->is_open = 1;
            $point->employee_id = Auth::user()->id;
            $point->save();
        }

        return redirect()->route('points');
    }

    public function logout( Request $request ) {
        $point = Point::where("id", $request->point_id)->first();
        $point->is_open = 0;
        $point->employee_id = null;
        $point->save();

        return redirect()->route('points');
    }

    public function create( Request $request ) {

        $point = new Point();

        $point->title = $request->point_name;
        $point->pincode = $request->pincode;
        $point->is_open = 0;
        $point->group_id = $request->group_id;
        $point->employee_id = Auth::user()->id;
        $point->comments = $request->comment;

        $point->save();

        return redirect()->route('points');
    }

    public function update( $id, Request $request ) {

        $point = Point::where("id" , $id)->first();

        $point->title = $request->point_name;
        $point->pincode = $request->pincode;
        $point->is_open = $request->status == "status" ? 1 : 0;
        $point->group_id = $request->group_id;
        $point->employee_id = $request->employee_id;
        $point->comments = $request->comment ?? "";

        $point->save();

        return redirect()->route('point', $id);
    }

    // Views
    public function pointsList () {
        $point_groups = Group::all();
        $points = Point::all();
        return view('users.manager.points.points', array(
            "point_groups" => $point_groups,
            "points" => $points
        ));
    }

    public function singlePoint( $id ) {
        $point = Point::where("id", $id)->first();
        $point_groups = Group::all();
        $users = User::all();
        return view('users.manager.points.point', array(
            "point_groups" => $point_groups,
            "point" => $point,
            "users" => $users,
        ));
    }
}
