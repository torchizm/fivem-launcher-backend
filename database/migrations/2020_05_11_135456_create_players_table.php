<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('launcher_token');
            $table->bigInteger('uid');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->boolean('whitelist')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->integer('usertype')->default(0);
            $table->string('ip');
            $table->string('profile_photo');
            $table->integer('status')->default(0);
            $table->string('username');
            $table->timestamps();

            $table->unique(['launcher_token', 'uid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
