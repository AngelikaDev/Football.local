<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('country');
            $table->integer('height')->nullable()->after('birth_date');
            $table->integer('weight')->nullable()->after('height');
            $table->json('career')->nullable()->after('weight');
            $table->json('achievements')->nullable()->after('career');
            
            $table->renameColumn('Photo', 'photo');
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn(['birth_date', 'height', 'weight', 'career', 'achievements']);
            $table->renameColumn('photo', 'Photo');
        });
    }
};