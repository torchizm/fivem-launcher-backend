<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRpcToServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->bigInteger('rpc_id')->nullable();
            $table->text('rpc_largeimage_key')->nullable();
            $table->text('rpc_largeimage_text')->nullable();
            $table->text('rpc_smallimage_key')->nullable();
            $table->text('rpc_smallimage_text')->nullable();
            $table->integer('max_players')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function (Blueprint $table) {
            //
        });
    }
}
