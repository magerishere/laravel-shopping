<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('catNameKey',config('global.catNameLength'))->comment('for query');
            $table->string('catName',config('global.catNameLength'))->comment('for UI');
            $table->string('title',config('global.titleLength'));
            $table->string('image',config('global.imageLength'))->unique();
            $table->integer('amount');
            $table->integer('qty');
            $table->text('content',config('global.contentLength'));
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
        Schema::dropIfExists('products');
    }
}
