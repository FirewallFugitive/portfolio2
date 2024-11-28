<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('question');
            $table->text('answer');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('faq_categories')
                  ->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('faq_categories');
    }

};
