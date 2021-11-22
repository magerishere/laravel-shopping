<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId(config('global.isOwnKey'))->constrained()->onDelete('cascade');
            $table->unsignedInteger('views');
            $table->string('catNameKey',config('global.catNameLength'))->comment('for query');
            $table->string('catName',config('global.catNameLength'))->comment('for UI');
            $table->string('title',config('global.titleLength'));
            $table->string('image',config('global.imageLength'))->unique();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
