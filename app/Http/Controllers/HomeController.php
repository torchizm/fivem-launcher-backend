<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Server;
use App\Launcher;
use App\User;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->power > 3) {
            $launchers = Launcher::get();
            $users = User::get();
            $servers = Server::get();

            return view('dashboard.admin.index', compact('launchers', 'users', 'servers'));
        }

        if ($user->is_first == true) {
            return view('dashboard.firstLogin', compact('user'));
        }

        // if ($user->power == 1) {
        //     $products = Product::get();
        //     return view('dashboard.developer.index', compact('products'));
        // }

        $servers = Server::where('user_id', auth()->id())->get();

        return view('dashboard.index', compact('servers'));
    }

    public function discorduid()
    {
        return view('discorduid');
    }

    public function setupDiscordWhitelist()
    {
        return view('setupdiscordwhitelist');
    }

    public function setupDiscordRpc()
    {
        return view('setup-discord-rpc');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function firstLogin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->is_first == false) {
            return redirect('/dashboard');
        }

        if ($user->password == bcrypt($request->oldPassword)) {
            return redirect('/dashboard')->with('message', 'Wrong Password.');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard')->with('message', 'Password is not strong enough.');
        }

        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->is_first = false;

        $user->save();

        return redirect('/dashboard');
    }
}
