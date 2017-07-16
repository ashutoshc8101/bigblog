<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("comments", function(Blueprint $table){

            $table->increments("id");
            $table->string("body");
            $table->integer("user_id");
            $table->timestamps();

        });

        Schema::create("commentables", function(Blueprint $table){

            $table->increments("id");
            $table->integer("comment_id");
            $table->integer("commentable_id");
            $table->string("commentable_type");
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
        //
    }
}
