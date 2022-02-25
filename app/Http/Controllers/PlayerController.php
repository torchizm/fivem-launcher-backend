<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Ban;
use App\Launcher;
use App\Player;
use App\Server;
use App\Permission;
use App\ReportCat;

class PlayerController extends Controller
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
    public function create(Player $player)
    {
        $days = [1, 14, 30, 90, 365, 4001];

        return view('dashboard.players.ban', compact('player', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Player $player, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required',
            'until' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Missing paramater');
        }

        $server = Server::where('launcher_token', $player->launcher_token)->firstOrFail();

        if (empty($server)) {
            return back()->with('message', 'Invalid server');
        }

        if ($player->is_banned) {
            return back()->with('message', 'This player already banned');
        }

        $ban = Ban::create([
                'uid' => $player->uid,
                'server_slug' => $server->slug,
                'until' => Carbon::now()->addDays($request->until),
                'reason' => $request->reason,
            ]);

        $player->is_banned = true;
        $player->save();

        return redirect('/dashboard/player/'. $player->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Ban $ban
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unban(Ban $ban)
    {
        $server = Server::where('slug', $ban->server_slug)->firstOrFail();

        if (empty($server)) {
            return back()->with('message', 'Invalid server');
        }

        $player = Player::where([
            ['uid', $ban->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();

        if ($player->is_banned == false) {
            return back()->with('message', 'This player already unbanned');
        }
        
        $ban->until = Carbon::now();
        $player->is_banned = false;
        $ban->save();
        $player->save();

        return redirect('/dashboard/server/'. $server->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        $bans = Player::where('uid', $player->uid)->firstOrFail()->bans();

        return view('dashboard.players.show', compact('bans'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $permissions = Permission::all();
        $currentPermission = $player->usertype;
        return view('dashboard.players.edit', compact('player', 'permissions', 'currentPermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Player  $player
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPerm(Player $player, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('message', 'Missing paramater');
        }

        $server = Server::where('launcher_token', $player->launcher_token)->firstOrFail();

        if (empty($server)) {
            return back()->with('message', 'Invalid server');
        }

        $player->usertype = $request->permission;
        $player->save();

        return redirect('/dashboard/server/'. $server->slug)->with('message', 'Kullanıcı kaydedildi');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPlayer($id)
    {
        $user = Auth::user();
        $launchers = Launcher::where('user_id', $user->id)->get();
        $player = Player::where('id', $id)->firstOrFail();
        $bans = Ban::where('uid', $player->uid)->get();
        $server = $this->getServer($player->launcher_token);

        foreach ($launchers as $launcher) {
            if ($user->id == $launcher->user_id && $player->launcher_token == $launcher->token) {
                foreach ($bans as $ban) {
                    if ($ban->server_slug == $server->slug) {
                        $ban->delete();
                    }
                }

                $player->delete();
                return back()->with('message', 'Kullanıcı silindi.');
            }
        }

        return back()->with('message', 'Kullanıcı silinemedi. Kullanıcı daha önceden silinmiş veya sizin oyuncunuz olmayabilir.');
    }

    public function getServer($token)
    {
        return Server::where('launcher_token', $token)->first();
    }
}
