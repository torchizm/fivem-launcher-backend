<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        return view('dashboard.admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $randomString = Str::random(16);

        $createdUser = User::create([
            'email' => request('email'),
            'password' => Hash::make($randomString),
            'power' => request('role'),
            'is_first' => true
        ]);

        $url = route('login');

        Mail::to($createdUser->email)->send(new UserCreated($randomString, $url));

        return redirect('/dashboard/admin/user/' . $createdUser->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $currentUser = User::findOrFail($id);
        $users = User::get();

        return view('dashboard.admin.users.show', compact('users', 'currentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $currentUser = User::findOrFail($id);

        if ($currentUser->id == $user->id || $currentUser->power > 3) {
            return redirect('/dashboard/admin/user/' . $currentUser->id)->with(['message' => 'You can\'t ban this user.',]);
        }

        if ($currentUser->servers()) {
            foreach ($currentUser->servers() as $server) {
                $server->players()->delete();
                $server->delete();
            }
        }

        foreach ($currentUser->launchers() as $launcher) {
            $launcher->delete();
        }

        $currentUser->delete();

        return redirect('/dashboard');
    }
}
