<?php

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
        Schema::create('tissus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('material');
            $table->integer('weight');
            $table->integer('laize');
            $table->integer('price');
            $table->integer('stock');
            $table->string('by_on');
            $table->boolean('scrap');
            $table->boolean('pre_wash');
            $table->boolean('oekotex');
            $table->boolean('bio');
            $table->double('rating', 2,1);
            $table->text('comment')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tissu_type_id')->constrained('tissu_types');
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
        Schema::dropIfExists('tissus');
    }
};
