<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->json('gallery')->nullable()->after('image');
            $table->string('category')->default('other')->after('gallery');
            $table->string('author')->default('Администратор')->after('category');
            $table->json('tags')->nullable()->after('author');
            $table->text('meta_description')->nullable()->after('tags');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['gallery', 'category', 'author', 'tags', 'meta_description']);
        });
    }
};