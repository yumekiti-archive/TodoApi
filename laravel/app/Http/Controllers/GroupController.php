<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    //

    public function show($groupId){
        return Auth::user()
            ->groups()
            ->findOrFail($groupId)
            ->todos()
            ->get();
    }

}
