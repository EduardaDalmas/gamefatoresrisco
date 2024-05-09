<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            // Altera a definição do campo 'text_answer' para permitir valores nulos
            $table->text('text_answer')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            // Reverte a alteração, tornando o campo 'text_answer' obrigatório novamente
            $table->text('text_answer')->nullable(false)->change();
        });
    }
};
