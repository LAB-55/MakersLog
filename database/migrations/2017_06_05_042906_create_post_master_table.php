<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('post_master', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('p_id');
            $table->string('rand_id')->nullable();
            $table->string('u_id');
            $table->text('p_content');
            $table->text('p_short_dec');
            $table->text('p_title');
            $table->string('is_latest');
            $table->text('uri')->nullable();
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
