<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE questions CHANGE text_answer text TEXT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE questions CHANGE text TEXT text_answer TEXT');
    }
};
