<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Server;
use App\Launcher;
use App\Theme;

class ServerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $launcherCheck = 0;
        foreach (Launcher::get() as $launcher) {
            if (request('launcherToken') == $launcher->token && auth()->id() == $launcher->user_id) {
                $launcherCheck = $launcherCheck + 1;
            }
        }

        foreach (Server::get() as $server) {
            if (request('launcherToken') == $server->launcher_token) {
                return back()->with('message', 'Launcher token already in use.');
            }
        }

        if ($launcherCheck == 1) {

            $server = Server::create([
                'name' => request('serverName'),
                'slug' => Str::random(12),
                'user_id' => auth()->id(),
                'launcher_token' => request('launcherToken'),
            ]);

            return redirect('/dashboard/server/' . $server->slug);
        }

        return back()->with('message', 'Invalid launcher token');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $currentServer = Server::where([
            ['slug', $slug],
            ['user_id', auth()->id()]
            ])->firstOrFail();
        $servers = Server::where('user_id', auth()->id())->get();

        $theme = Theme::where('id', $currentServer->theme_index)->firstOrFail();
        return view('dashboard.show', compact(['servers', 'currentServer', 'theme']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $currentServer = Server::where([
            ['slug', $slug],
            ['user_id', auth()->id()]
            ])->firstOrFail();

        $themes = Theme::get();

        return view('dashboard.edit', compact(['currentServer', 'themes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $launcherRequired = FALSE;
        if ($request->has('isLauncherRequired')) {
            $launcherRequired = TRUE;
        }

        $maintenance = FALSE;
        if ($request->has('maintenance')) {
            $maintenance = TRUE;
        }

        $auto_whitelist = FALSE;
        if ($request->has('auto_whitelist')){
            $auto_whitelist = TRUE;
        }

        $discord_whitelist = FALSE;
        if ($request->has('discord_whitelist')){
            $discord_whitelist = TRUE;
        }

        $currentServer = Server::where([
            ['slug', $slug],
            ['user_id', auth()->id()]
            ])->firstOrFail();

        $currentServer->name = request('serverName');
        $currentServer->description = request('serverDescription');
        $currentServer->server_ip = request('serverIP');
        $currentServer->server_port = request('serverPort');
        $currentServer->teamspeak_ip = request('teamspeakIP');
        $currentServer->teamspeak_port = request('teamspeakPort');
        $currentServer->teamspeak_password = request('teamspeakPassword');
        $currentServer->is_launcher_req = $launcherRequired;
        $currentServer->maintenance = $maintenance;
        $currentServer->auto_whitelist = $auto_whitelist;
        $currentServer->discord_whitelist = $discord_whitelist;
        $currentServer->rpc_id = request('rpcId');
        $currentServer->rpc_largeimage_key = request('rpcLargeImageKey');
        $currentServer->rpc_largeimage_text = request('rpc_largeimage_text');
        $currentServer->rpc_smallimage_key = request('rpc_smallimage_key');
        $currentServer->rpc_smallimage_text = request('rpc_smallimage_text');
        $currentServer->max_players = request('maxPlayers');
        $currentServer->theme_index = request('theme_index');
        $currentServer->byte_count = request('byte_count');

        $currentServer->save();

        return redirect('/dashboard/server/' . $currentServer->slug)->with('message', 'Your server has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $currentServer = Server::where([
            ['slug', $slug],
            ['user_id', auth()->id()]
            ])->firstOrFail();

        $currentServer->delete();

        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLogo($slug)
    {
        $this->validate(request(), [
            'logo' => ['required', 'image', 'max:2048']
        ]);

        $currentServer = Server::where([
            ['slug', $slug],
            ['user_id', auth()->id()]
            ])->firstOrFail();

        $currentServer->update([
            'logo_path' => request()->file('logo')->store('logos', 'public')
        ]);

        return redirect('/dashboard/server/' . $currentServer->slug)->with('message', 'Your server has been updated successfully.');
    }
}
