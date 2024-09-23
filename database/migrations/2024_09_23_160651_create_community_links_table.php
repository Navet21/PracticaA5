<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('community_links', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index();

            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('channel_id')->unsigned()->index();

            $table->foreign('channel_id')->references('id')->on('channels');

            $table->string('title');

            $table->string('link')->unique();

            $table->boolean('approved')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_links');
    }
};
