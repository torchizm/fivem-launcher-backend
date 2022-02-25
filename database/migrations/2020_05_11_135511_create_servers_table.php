<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('logo_path')->nullable();
            $table->string('server_ip')->nullable();
            $table->string('server_port')->nullable();
            $table->string('teamspeak_ip')->nullable();
            $table->string('teamspeak_port')->nullable();
            $table->string('teamspeak_password')->nullable();
            $table->boolean('is_launcher_req')->default(true);
            $table->boolean('maintenance')->default(true);
            $table->integer('user_id');
            $table->string('launcher_token')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
