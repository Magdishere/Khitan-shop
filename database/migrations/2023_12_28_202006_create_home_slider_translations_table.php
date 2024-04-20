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
        Schema::create('home_slider_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('home_sliders_id');
            $table->unique(['home_sliders_id', 'locale']);
            $table->foreign('home_sliders_id')->references('id')->on('home_sliders')->onDelete('cascade');

            $table->string('title');
            $table->string('big-title');
            $table->string('descrption');
            $table->string('link');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_slider_translations');
    }
};
