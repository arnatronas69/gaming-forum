<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function showUploadForm()
    {
        return view('profile.picture');
    }

    public function storePicture(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|max:2048',
        ]);

        $user = auth()->user();
        $imageName = $user->id.'_'.time().'.'.$request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        return redirect()->route('user.profile.picture')->with('success','Profile picture uploaded successfully.');
    }
}
