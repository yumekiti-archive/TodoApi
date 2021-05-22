<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    //
    public function show($groupId)
    {
        $todo = Auth::user()
            ->groups()
            ->findOrFail($groupId)
            ->todos()
            ->get();
        return $todo;
    }
}
