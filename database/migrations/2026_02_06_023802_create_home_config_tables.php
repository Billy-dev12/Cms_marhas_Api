<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Home Settings (Key-Value Store)
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 2. Welcome Features (List under Hero Slider)
        Schema::create('welcome_features', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->enum('type', ['desktop', 'mobile'])->default('desktop');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Hero Cards (Info Cards visible on Desktop)
        Schema::create('hero_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // image moved to media table
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 4. Social Widgets (Floating / Footer)
        Schema::create('social_widgets', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // Facebook, Instagram, etc
            $table->text('embed_code')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 5. Benefit Items (For "Penerimaan Siswa Baru" section)
        Schema::create('benefit_items', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Vision Points (For "BMW" section)
        Schema::create('vision_points', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_points');
        Schema::dropIfExists('benefit_items');
        Schema::dropIfExists('social_widgets');
        Schema::dropIfExists('hero_cards');
        Schema::dropIfExists('welcome_features');
        Schema::dropIfExists('home_settings');
    }
};
