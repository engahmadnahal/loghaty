<?php

use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('subscribtion_teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_subscrip_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_subscrip_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignIdFor(Teacher::class)->constrained()->cascadeOnDelete();
            $table->timestamp('expire')->nullable();
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
        Schema::dropIfExists('subscribtion_teachers');
    }
};
