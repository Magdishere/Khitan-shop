<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('product_attribute_options', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->foreignId('attribute_option_id')->constrained('attribute_options');
            $table->boolean('is_default')->default(false);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->timestamps();

            $table->primary(['product_id', 'attribute_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_options');
    }
};
