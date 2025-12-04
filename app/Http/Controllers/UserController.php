<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('users.index');
    }

    public function edit(int $id)
    {
        return view('users.edit',['user' => User::find($id)]);
    }
}
