<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashtagPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('hashtag_id')->nullable();
            $table->timestamps();

            $table->primary('post_id', 'hashtag_id');

            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade');

                $table->foreign('hashtag_id')
                ->references('id')->on('hashtags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashtag_post');
    }
}
