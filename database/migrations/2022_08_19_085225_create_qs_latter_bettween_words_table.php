<?php

use App\Models\Game;
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
        Schema::create('qs_latter_bettween_words', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('quess_en');
            $table->string('quess_ar');
            $table->string('answer_en');
            $table->string('answer_ar');
            $table->string('image_one');
            $table->string('image_two');
            $table->string('image_three');
            $table->string('option_one_ar');
            $table->string('option_one_en');
            $table->string('option_two_ar');
            $table->string('option_two_en');
            $table->string('option_three_ar');
            $table->string('option_three_en');
            $table->integer('points');
            $table->foreignIdFor(Game::class)->constrained()->cascadeOnDelete();
            $table->softDeletes();
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
        Schema::dropIfExists('qs_latter_bettween_words');
    }
};
