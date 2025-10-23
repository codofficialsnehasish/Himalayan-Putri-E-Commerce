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
        Schema::create('product_filter_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            
            // Use shorter constraint name for filter_attribute_value_id
            $table->foreignId('filter_attribute_value_id')
                ->constrained('filter_attribute_values', 'id', 'prod_filt_attr_val_fk')
                ->cascadeOnDelete();
            
            $table->timestamps();
            
            // Also shorten the unique constraint name
            $table->unique(['product_id', 'filter_attribute_value_id'], 'prod_filt_attr_val_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_filter_attribute_values');
    }
};
