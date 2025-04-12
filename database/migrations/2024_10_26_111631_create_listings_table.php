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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->onstrained()->onDelete("cascade");
            $table->longText("main_image");
            $table->longText("image")->nullable();
            $table->string("item_name");
            $table->decimal('price', 10, 2)->default(0.00);
            $table->foreignId('category_id')->nullable()->constrained("categories")->onDelete('cascade');
            $table->string('condition')->nullable();
            $table->integer('quantity')->nullable();            
            $table->longText("description")->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
