<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function employeesList() {
        $users = User::all();
        $groups = Group::all();
        $user_types = UserType::all();
        return view('users.manager.employees.employees', array(
            "users" => $users,
            "groups" => $groups,
            "user_types" => $user_types,
        ));
    }

    public function create(Request $request) {
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = strtolower($this->transliterate($request->last_name) . "_" . $this->transliterate($request->first_name));
        $user->password = md5($request->password);
        $user->group_id = $request->group_id;
        $user->type_id = $request->type_id;
        $user->responsible_id = $request->responsible_id;
        $user->comments = $request->comments ?? ' ';

        if ($user->save()) {
            return redirect()->route('employees')->with('message', 'Користувач успішно створений');
        } else {
            return redirect()->route('employees')->with('message', 'Виникла помилка при створенні користувача');
        }
    }

    private function transliterate($textcyr = null, $textlat = null) {
        $cyr = array(
            'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'i', 'ь', 'я',
            'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'I', 'Ь', 'Я');
        $lat = array(
            'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');
        if($textcyr) return str_replace($cyr, $lat, $textcyr);
        else if($textlat) return str_replace($lat, $cyr, $textlat);
        else return null;
    }
}
