<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Group;

class GroupController extends Controller
{
    //

    public function show($groupId){
        return Auth::user()
            ->group()
            ->findOrFail($groupId)
            ->todos()
            ->get();
    }

}
