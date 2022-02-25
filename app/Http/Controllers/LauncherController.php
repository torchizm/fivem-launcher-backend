<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Server;
use App\User;
use App\Launcher;

class LauncherController extends Controller
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

        $users = User::get();

        return view('dashboard.admin.launchers.add', compact('users'));
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

        $launcher = Launcher::create([
                'version' => request('version'),
                'token' => Str::random(32),
                'user_id' => request('user'),
                'is_suspended' => false,
                'maintenance' => false,
            ]);

        return redirect('/dashboard/admin/launcher/' . $launcher->id);
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

        $currentLauncher = Launcher::findOrFail($id);
        $launchers = Launcher::get();

        return view('dashboard.admin.launchers.show', compact('launchers', 'currentLauncher'));
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

        $currentLauncher = Launcher::findOrFail($id);

        return view('dashboard.admin.launchers.edit', compact('currentLauncher'));
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

        $isSuspended = FALSE;
        if ($request->has('isSuspended')) {
            $isSuspended = TRUE;
        }

        $maintenance = FALSE;
        if ($request->has('maintenance')) {
            $maintenance = TRUE;
        }

        $currentLauncher = Launcher::findOrFail($id);

        $currentLauncher->version = $request->launcherVersion;
        $currentLauncher->is_suspended = $isSuspended;
        $currentLauncher->maintenance = $maintenance;
        $currentLauncher->save();

        return redirect('/dashboard/admin/launcher/' . $currentLauncher->id)->with('message', 'Launcher has been updated successfully.');
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

        $currentLauncher = Launcher::findOrFail($id);

        if ($currentLauncher->server()) {
            $currentLauncher->server()->delete();
            if ($currentLauncher->server()->players()) {
                $currentLauncher->server()->players()->delete();
            }
        }
        $currentLauncher->delete();

        return redirect('/dashboard');
    }
}
