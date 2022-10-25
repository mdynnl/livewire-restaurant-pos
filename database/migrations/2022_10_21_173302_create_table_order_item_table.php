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
        Schema::create('table_order_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_order_id')->references('id')->on('table_order')->cascadeOnDelete();
            $table->foreignId('item_id')->nullable()->references('id')->on('items')->nullOnDelete();
            $table->integer('qty')->default(0);
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
        Schema::dropIfExists('table_order_item');
    }
};
