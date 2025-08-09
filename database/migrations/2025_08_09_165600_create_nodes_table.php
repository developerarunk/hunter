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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique(); // JSON "id"
            $table->string('name');
            $table->string('company_website')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_badged')->default(false);
            $table->text('profile_picture_uri')->nullable();

            // Store arrays as JSON
            $table->json('countries')->nullable();
            $table->json('industries')->nullable();
            $table->json('focus_areas')->nullable();
            $table->json('facebook_platforms')->nullable();
            $table->json('language_tags')->nullable();
            $table->json('service_models')->nullable();
            $table->json('solution_types')->nullable();
            $table->json('solution_subtypes')->nullable();
            $table->json('diverse_owned_identities')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
