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
        Schema::create('qs_order_latters', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('body_en');
            $table->string('body_ar');
            $table->string('quess_en');
            $table->string('quess_ar');
            $table->string('answer_en');
            $table->string('answer_ar');
            $table->string('image');
            // This Table Options is loginc , cut latter on word
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
        Schema::dropIfExists('qs_order_latters');
    }
};
