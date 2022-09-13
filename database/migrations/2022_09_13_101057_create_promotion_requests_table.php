<?php

use App\Models\Father;
use App\Models\PlanTeacher;
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
        Schema::create('promotion_requests', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('mobile');
            $table->string('national_id');
            $table->longText('notes');
            $table->enum('status',['accept','wating','cancel'])->default('wating');
            $table->foreignIdFor(Father::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PlanTeacher::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('promotion_requests');
    }
};
