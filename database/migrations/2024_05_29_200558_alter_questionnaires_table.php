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
        Schema::table('questionnaires', function (Blueprint $table) {
            $table->boolean('random')->default(false)->after('description');
            $table->boolean('roulette')->default(true)->after('random');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questionnaires', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('random');
            $table->dropColumn('roulette');
        });
    }
};
