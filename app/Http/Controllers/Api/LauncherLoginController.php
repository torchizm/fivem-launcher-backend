<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Player;
use App\Launcher;
use App\Server;
use App\Ban;
use App\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LauncherLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'launcherToken' => 'required',
            'uid' => 'required',
            'pp' => 'required',
            'uname' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }
        if($_SERVER['SERVER_PORT'] == 8000) {
            $ip = "127.0.0.1";
        } else {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        $launcherToken = $request->launcherToken;
        $launcher = $this->getLauncher($launcherToken);

        if (empty($launcher) || $launcher->is_suspended) {
            return response()->json([
                'message' => 'Invalid Token'
            ], 403);
        }

        if ($launcher->maintenance) {
            return response()->json([
                'maintenance' => true,
                'message' => 'Launcher in maintenance'
            ], 403);
        }

        $server = $this->getServer($launcherToken);

        if (empty($server)) {
            return response()->json([
                'message' => 'Server Not Found'
            ], 404);
        }

        // if ($server->maintenance) {
        //     return response()->json([
        //         'maintenance' => true,
        //         'message' => 'Server in maintenance'
        //     ], 403);
        // }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $launcherToken]
        ])->first();

        if (empty($player)) {
            return $this->register($request, $server, $launcher, $ip);
        }

        if ($player->is_banned) {
            $ban = Ban::where([
                ['uid', $request->uid],
                ['server_slug', $server->slug]
            ])->orderBy('created_at')->first();

            return response([
                'message' => 'banned',
                'time' => $ban->until->diffForHumans(['parts' => 4, 'short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]),
                'reason' => $ban->reason
            ], 403);
        }

        // if (!$player->whitelist) {
        //     return response(['whitelist' => false, 'message' => 'You are not whitelisted'], 403);
        // }

        return $this->login($request, $player, $server, $launcher, $ip);
    }

    public function getLauncher($token)
    {
        return Launcher::where('token', $token)->first();
    }

    public function getServer($token)
    {
        return Server::where('launcher_token', $token)->first();
    }

    public function login($request, $player, $server, $launcher, $ip)
    {
        $player->api_token = Str::random(64);
        $player->ip = $ip;
        $player->profile_photo = $request->pp;
        $player->username = $request->uname;

        $player->save();

        return response([
            'api_token' => $player->api_token,
            'slug' => $server->slug,
            'version' => $launcher->version], 200);
    }

    public function register($request, $server, $launcher, $ip)
    {
        $player = Player::create([
                'launcher_token' => $request->launcherToken,
                'uid' => $request->uid,
                'api_token' => Str::random(64),
                'ip' => $ip,
                'profile_photo' => $request->pp,
                'whitelist' => $server->auto_whitelist,
                'username' => $request->uname
            ]);

            return response([
            'first' => true,
            'api_token' => $player->api_token,
            'slug' => $server->slug,
            'version' => $launcher->version], 200);
    }

    public function playButton(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();

        $player->using_launcher = true;
        $player->save();
        
        Log::create([
            'server_id' => $server->id,
            'type' => 'Game Login',
            'value' => 1
        ]);

        return response(204);
    }

    public function isUsingLauncher(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();
        
        if($player->profile_photo == "http://127.0.0.1:8000/img/vlast.png"){
            $player->using_launcher = true;
        }

        return response($player->only(['using_launcher']), 200);
    }

    public function exitLauncher(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();

        $player->ready_to_play = false;
        $player->save();

        return response(204);
    }

    public function isPlayerReady(Server $server, Request $request)
    {
        if (empty($server)) {
            return response()->json("Server not found", 404);
        }

        $validator = Validator::make($request->all(), [
            'uid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();

        $ready = false;

        if ($player->ready_to_play == true) {
            $player->ready_to_play = false;
            $player->save();
            $ready = true;
        }

        return response()->json($ready, 200);
    }

    public function connect(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $server = Server::where("rpc_id", $request->id)->first();

        if (empty($server)) {
            return response()->json("Server not found", 404);
        }

        $player = Player::where([
            ['uid', $request->uid],
            ['launcher_token', $server->launcher_token]
        ])->first();

        if (empty($player)) {
            return response()->json("User not found", 404);
        }

        if ($player->using_launcher == false) {
            return view('uselauncher');
        }

        $player->using_launcher = false;
        $player->ready_to_play = true;
        $player->save();

        $connectionString = "fivem://connect/" . $server->server_ip . ":" . $server->server_port;
        return redirect($connectionString);
    }
}
