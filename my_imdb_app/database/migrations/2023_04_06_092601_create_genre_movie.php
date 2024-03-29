<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign key definition
            $table->unsignedBigInteger("movie_id");
            $table->foreign("movie_id")->references('id')->on('movies');

            // Foreign key definition
            $table->unsignedBigInteger("genre_id");
            $table->foreign("genre_id")->references('genre_tmdb_id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};
