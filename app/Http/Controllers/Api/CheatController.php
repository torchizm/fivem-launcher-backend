<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Detection;
use App\Cheat;
use App\Server;
use App\Player;
use App\Hash;

class CheatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blacklist = collect(Cheat::all()->pluck('name'));

        return response()->json([
            'blacklist' => $blacklist
        ]);
    }

    /**
     * Display hashes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getHashes()
    {
        $hashes = Hash::all();
        return response($hashes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Server $server, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cheat' => 'required|integer',
            'player' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()
            ]);
        }

        $detection = Detection::create([
                'cheat_id' => $request->cheat,
                'player_id' => $request->player,
                'screenshot_path' => $request->screenshot_path,
                'details' => $request->details,
                'server_id' => $server->id
            ]);

        return response($detection, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        $detections = Detection::where('server_id', $server->id)->orderBy('created_at', 'desc')->get();
        return response($detections, 200);
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
}
