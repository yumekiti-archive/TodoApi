<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Group;

class TodoController extends Controller
{
    //
    public function show($groupId)
    {
        $todo = Auth::user()
            ->group()
            ->findOrFail($groupId)
            ->todos()
            ->get();
            
        return $todo;
    }
}
