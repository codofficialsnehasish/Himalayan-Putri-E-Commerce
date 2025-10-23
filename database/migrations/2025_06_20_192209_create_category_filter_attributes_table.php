<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_filter_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('filter_attribute_id')->constrained()->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->unique(['category_id', 'filter_attribute_id'], 'cat_filt_attr_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_filter_attributes');
    }
};
