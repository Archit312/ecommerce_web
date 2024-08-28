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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('user_id');
            $table->text('review');
            $table->string('image')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('product_code')
                ->references('code') // Assuming 'code' is the primary key in the 'products' table
                ->on('products')
                ->onDelete('cascade'); // Delete reviews when the associated product is deleted

            $table->foreign('user_id')
                ->references('id') // Assuming 'id' is the primary key in the 'users' table
                ->on('users')
                ->onDelete('cascade'); // Delete reviews when the associated user is deleted
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
