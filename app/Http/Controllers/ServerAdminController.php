<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Server;
use App\User;
use App\Launcher;
use App\Theme;

class ServerAdminController extends Controller
{
    /**
     * Display the specified resource.
     * 
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $currentServer = Server::where([
            ['slug', $slug]
            ])->firstOrFail();
        $servers = Server::get();

        $theme = Theme::where('id', $currentServer->theme_index)->firstOrFail();
        return view('dashboard.admin.servers.show', compact(['servers', 'currentServer', 'theme']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $currentServer = Server::where('slug', $slug)->firstOrFail();
        $themes = Theme::get();
        return view('dashboard.admin.servers.edit', compact(['currentServer', 'themes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Request $request)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

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

        $currentServer = Server::where('slug', $slug)->firstOrFail();

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

        return redirect('/dashboard/admin/server/' . $slug)->with('message', 'Server has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = Auth::user();

        if ($user->power < 4) {
            return redirect('/dashboard');
        }

        $currentServer = Server::where('slug', $slug)->firstOrFail();

        $currentServer->delete();

        return redirect('/dashboard');
    }

    public function storeLogo($slug)
    {
        $this->validate(request(), [
            'logo' => ['required', 'image', 'max:2048']
        ]);

        $currentServer = Server::where('slug', $slug)->firstOrFail();

        $currentServer->update([
            'logo_path' => request()->file('logo')->store('logos', 'public')
        ]);

        return redirect('/dashboard/server/' . $currentServer->slug)->with('message', 'Your server has been updated successfully.');
    }
}
