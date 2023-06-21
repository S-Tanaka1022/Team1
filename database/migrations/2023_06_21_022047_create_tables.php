<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('region_name', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_code')->primary();
            $table->string('region_name');
            $table->timestamps();
        });

        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->timestamps();
        });

        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('DELETE');
            $table->string('list_name');
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('DELETE');
            $table->bigInteger('region_code');
            $table->foreign('region_code')
                ->references('region_code')
                ->on('region_name');
            $table->timestamps();
        });

        Schema::create('playlist_song', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('list_id');
            $table->bigInteger('song_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
        Schema::dropIfExists('region_name');
        Schema::dropIfExists('playlists');
        Schema::dropIfExists('playlist_song');
        Schema::dropIfExists('songs');
    }
};
