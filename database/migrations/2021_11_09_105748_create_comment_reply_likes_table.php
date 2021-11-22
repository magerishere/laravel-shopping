<?php

use App\Models\CommentReply;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReplyLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_reply_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CommentReply::class)->constrained()->onDelete('cascade');
            $table->foreignId(config('global.isOwnKey'))->constrained()->onDelete('cascade');
            $table->boolean('type');
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
        Schema::dropIfExists('comment_reply_likes');
    }
}
