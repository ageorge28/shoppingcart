<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'phone' => 'required|min:10',
            'password' => 'confirmed',
        ]);
       
        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password != NULL && $request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('picture'))
        {
            if ($user->image_id == 0)
            {
                $image = new Image();
                $image->filename = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('uploads'), $image->filename);
                $image->save();
                $user->image_id = $image->id;
            }
            else
            {
                $image = Image::find($user->image_id);
                if(File::exists(public_path('uploads/' . $image->filename)))
                {
                    File::delete(public_path('uploads/' . $image->filename));
                }
                $image->filename = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('uploads'), $image->filename);
                $image->save();
            }
        }
      
        if ($user->isDirty())
        {
            $user->save();
            return redirect()->back()->with('success', 'Account updated successfully');
        }
        else
        {        
            $user->save();
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}
