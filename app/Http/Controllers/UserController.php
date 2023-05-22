<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function employeesList() {
        $users = User::all();
        return view('users.manager.employees.employees', array(
            "users" => $users,
        ));
    }
}
