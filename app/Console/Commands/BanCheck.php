<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Player;
use App\Server;

class BanCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ban:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks player bans';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $servers = Server::get();
        $bar = $this->output->createProgressBar(count($servers));

        $bar->start();
        foreach ($servers as $server) {
            $players = Player::where('launcher_token', $server->launcher_token)->get();

            foreach ($players as $player) {
                if (count($player->bans()) > 0) {
                    $count = 0;
                    foreach ($player->bans() as $ban) {
                        if (Carbon::now()->lessThan($ban->until)) {
                            $count++;
                        }
                    }
                    if ($count == 0 && $player->is_banned == true) {
                        $player->is_banned = false;
                        $player->save();
                    } elseif ($count > 0 && $player->is_banned == false) {
                        $player->is_banned = true;
                        $player->save();
                    }
                } else {
                    $player->is_banned = false;
                    $player->save();
                }
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
