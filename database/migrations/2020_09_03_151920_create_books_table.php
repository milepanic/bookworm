<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->unique();
            $table->string('title', 400);
            $table->longText('description')->nullable();
            $table->date('published_at')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('preview_link', 200);
            $table->unsignedBigInteger('author_id')->nullable();
            $table->integer('page_count')->nullable();
            $table->string('thumbnail', 400);
            $table->string('language', 20);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
