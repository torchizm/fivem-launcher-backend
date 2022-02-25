<?php

namespace App\Http\Controllers\Api;

use App\Server;
use App\Post;
use App\Player;
use App\Rule;
use App\Update;
use App\Like;
use App\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server, Request $request)
    {
        $auth = $request->header('Authorization');
        if ($auth) {
            $token = str_replace('Bearer ', '', $auth);

            if (!$token) {
                return response()->json([
                    'message' => 'No Bearer Token!'
                ], 401);
            }

            $player = Player::where('api_token', $token)->first();
            if (!$player) {
                return response()->json([
                    'message' => 'Invalid Bearer Token!'
                ], 401);
            }

            return response($server->only(['name', 'description', 'logo_path', 'server_ip', 'server_port', 'teamspeak_ip', 'teamspeak_port', 'teamspeak_password', 'discord_whitelist', 'maintenance', 'rpc_id', 'rpc_largeimage_key', 'rpc_largeimage_text', 'rpc_smallimage_key', 'rpc_smallimage_text', 'max_players', 'theme_index', 'byte_count']), 200);
        }
        return response($server->only(['is_launcher_req']), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'launcher_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'launcher_token field is required.'
            ]);
        }

        $server = Server::where('launcher_token', $request->launcher_token)->first();

        if (!empty($server)) {
            return response($server->only(['name', 'logo_path']));
        }

        return response()->json([
            'message' => 'Server not found.'
        ]);
    }

    public function showPosts(Server $server, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $player = Player::where('api_token', $token)->first();
        $posts = Post::where([
                    'server_id' => $server->id,
                    'is_active'=> TRUE
                    ])->orderBy('created_at', 'desc')->get();

        if ($player->usertype >= 5) {
            $posts = Post::where('server_id', $server->id)->orderBy('created_at', 'desc')->get();
        }

        $collection = collect();

        foreach ($posts as $post) {
            $collection->push([
                'id' => $post->id,
                'content' => $post->content,
                'image_path' => $post->image_path,
                'author' => $post->author,
                'server_id' => $post->server_id,
                'is_active' => $post->is_active,
                'likes' => Like::where('post_id', $post->id)->get(),
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at
            ]);
        }

        if(!empty($posts)) {
            return response()->json(
                $collection->all(),
                200
            );
        }

        return response(204);
    }

    public function showRules(Server $server, Request $request)
    {
        $rules = Rule::where('server_id', $server->id)->orderBy('created_at', 'desc')->get();

        if (!empty($rules)) {
            return response($rules, 200);
        }

        return response(204);
    }

    public function showUpdates(Server $server, Request $request)
    {
        $updates = Update::where('server_id', $server->id)->orderBy('created_at', 'desc')->get();

        if (!empty($updates)) {
            return response($updates, 200);
        }

        return response(204);
    }

    public function addPost(Server $server, Request $request)
    {
        $post = Post::create([
                'content' => $request->content,
                'author' => $request->uid,
                'image_path' => $request->image_path,
                'server_id' => $server->id
            ]);

        return response($post, 200);
    }

    public function activePost(Server $server, Post $post, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();
    
        if ($staff->usertype < 5) {
            return response()->json([
                'message' => 'Not enough permissions!'
            ], 401);
        }

        $post = Post::where([
            ['id', $post->id]
            ])->firstOrFail();
        
        $post->is_active = TRUE;
        $post->save();
        
        return response($post, 200);
    }

    public function likePost(Server $server, Post $post, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $player = Player::where('api_token', $token)->first();

        $like = Like::where([
                    ['post_id', $post->id],
                    ['server_id', $server->id],
                    ['player_id', $player->uid]        
                ])->first();
        
        if (!empty($like->post_id)) {
            $like->delete();

            return response()->json([
                'message' => 'Disliked succesfully.'
            ], 200);
        }

        $liked = Like::create([
            'post_id' => $post->id,
            'player_id' => $player->uid,
            'server_id' => $server->id
            ]);
        
        return response($liked, 200);
    }

    public function deletePost(Server $server, Post $post, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();
    
        if ($staff->usertype < 5) {
            return response()->json([
                'message' => 'Not enough permissions!'
            ], 401);
        }

        $post = Post::where([
                'id' => $post->id,
                'server_id' => $server->id
            ])->delete();

        return response(200);
    }

    public function addRules(Server $server, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();

        if ($staff->usertype < 5) {
            return response()->json([
                    'message' => 'Not enough permissions!'
                ], 401);
        }

        $rule = Rule::create([
                'title' => $request->title,
                'content' => $request->content,
                'server_id' => $server->id
            ]);

        return response($rule, 200);
    }

    public function addUpdates(Server $server, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();

        if ($staff->usertype < 5) {
            return response()->json([
                    'message' => 'Not enough permissions!'
                ], 401);
        }

        $update = Update::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $staff->uid,
                'image_path' => $request->image_path,
                'server_id' => $server->id
            ]);

        return response($update, 200);
    }

    public function deleteUpdate(Server $server, Update $update, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();
    
        if ($staff->usertype < 5) {
            return response()->json([
                'message' => 'Not enough permissions!'
            ], 401);
        }

        $update = Update::where([
                'id' => $update->id,
                'server_id' => $server->id
            ])->delete();

        return response(200);
    }

    public function storeImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['required', 'image', 'max:4096']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request must be image and max 4mb.'
            ]);
        }

        return response()->json(['path' => request()->file('image')->store('images', 'public')]);
    }

    public function storeFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'max:8196']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request must be max 8mb.'
            ]);
        }

        return response()->json(['path' => request()->file('file')->store('files', 'public')]);
    }

    public function getLog(Server $server, Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $staff = Player::where('api_token', $token)->first();
    
        if ($staff->usertype < 5) {
            return response()->json([
                'message' => 'Not enough permissions!'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Log type required.'
            ]);
        }

        $logs = Log::where([
            'server_id' => $server->id,
            'type' => $request->type
            ])->orderBy('created_at', 'desc')->get();

        return response($logs);
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'launcher_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Fields missing.'
            ]);
        }

        $launcher = Server::where([
            'launcher_token' => $request->launcher_token
        ])->first();

        if (empty($launcher)) {
            return response()->json(
                ['respone' => FALSE
            ], 200);
        } else {
            return response()->json(
                ['response' => TRUE
            ], 200);
        }
    }
}
