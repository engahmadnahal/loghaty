<?php

use App\Models\Classe;
use App\Models\Country;
use App\Models\Father;
use App\Models\Semester;
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
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('avater')->nullable();
            $table->enum('status',['active','block'])->default('active');
            $table->timestamp('last_vist')->nullable();
            $table->integer('sum_day')->default(0);
            $table->foreignIdFor(Father::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Semester::class)->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('childrens');
    }
};
