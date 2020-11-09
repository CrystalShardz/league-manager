<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('datetime_start');
            $table->timestamps();
        });

        Schema::create('season_team', function (Blueprint $table) {
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('team_id');

            $table->foreign('season_id')->references('id')->on('seasons')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_team');
        Schema::dropIfExists('seasons');
    }
}
