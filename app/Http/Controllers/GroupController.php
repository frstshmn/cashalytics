<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create( Request $request ) {

        $pointgroup = new Group();

        $pointgroup->title = $request->group_name;
        $pointgroup->comment = $request->comment;

        $pointgroup->save();

        return redirect()->route('points');

    }
}
