<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
           $table->foreignId('post_id')->constrained('posts');   //参照先のテーブル名を
           $table->foreignId('tag_id')->constrained('tags');    //constrainedに記載
           $table->primary(['post_id', 'tag_id']);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
};
