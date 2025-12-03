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

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'], // 2MB
        ]);

        $user = $request->user();

        // apaga a antiga se existir
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // salva a nova
        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->profile_photo_path = $path;
        $user->save();
    }
}
