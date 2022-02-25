<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Server;
use App\Player;
use App\Report;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Server $server)
    {
        //  $players = Player::where([['launcher_token', $server->launcher_token],
        //                           ['is_banned', false]
        //                           ])->orderBy('usertype', 'desc')->get();

        $players = Player::where('launcher_token', $server->launcher_token)->orderBy('usertype', 'desc')->get();

        $collection = collect();

        foreach ($players as $player) {
            $collection->push([
                'uid' => $player->uid,
                'username' => $player->username,
                'profile_photo' => $player->profile_photo,
                'whitelist' => $player->whitelist,
                'usertype' => $player->usertype,
                'status' => $player->status,
                'created_at' => $player->created_at,
            ]);
        }
        return response($collection, 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server, Request $request)
    {
        $player = Player::where([
            ['launcher_token', $server->launcher_token],
            ['uid', $request->player]
            ])->first();

        return response($player, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'player' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->message()
            ]);
        }

        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();

        $player = Player::where([
            ['uid', $request->player],
            ['launcher_token', $server->launcher_token]
        ])->first();

        if (empty($player)) {
            return response()->json([
                    'message' => 'User Not Found!'
                ], 404);
        }

        if ($staff->usertype < 5 || $staff->usertype <= $player->usertype || $request->usertype >= $staff->usertype) {
            return response()->json([
                    'message' => 'Not enough permissions!'
                ], 401);
        }

        $player->usertype = $request->usertype;
        $player->whitelist = $request->whitelist;

        $player->save();

        return response($player, 200);
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|numeric',
            'launcher_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Fields is missing.'
            ]);
        }

        $player = Player::where([
            ['launcher_token', $request->launcher_token],
            ['uid', $request->uid]
            ])->first();

        if (empty($player)) {
            return response()->json(
                ['message' => 'Ok'
            ], 200);
        } else {
            if ($player->usertype < 5) {
                return response()->json(
                    ['message' => 'Ok'
                ], 200);
            }
            return response()->json(
                ['message' => 'This player already exists.'
            ]);
        }
    }

    public function reports(Server $server, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();

        if ($staff->usertype < 5) {
            return response()->json([
                    'message' => 'Not enough permissions!'
                ], 401);
        }

        $reports = Report::where('server_id', $server->id)->orderBy('created_at', 'desc')->get();

        return response($reports, 200);
    }

    public function report(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'author' => 'required|numeric',
            'player' => 'required|numeric',
            'cat' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $report = Report::create([
                'content' => $request->content,
                'author' => $request->author,
                'target' => $request->player,
                'cat_id' => $request->cat,
                'server_id' => $server->id
            ]);

        return response($report, 200);
    }
}
