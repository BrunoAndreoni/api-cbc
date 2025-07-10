<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recurso', function (Blueprint $table) {
            $table->id('id');
            $table->string('recurso', 255);
            $table->decimal('saldo_disponivel', 10, 2);
            $table->timestamps();
        });

        // Inserindo recursos iniciais
        DB::transaction(function () {
                DB::table('recurso')->insert([
                [
                    'recurso' => 'Recurso para passagens',
                    'saldo_disponivel' => 10000.00,
                    'created_at' => now(),
                ],
                [
                    'recurso' => 'Recurso para hospedagens',
                    'saldo_disponivel' => 10000.00,
                    'created_at' => now()
                ]
            ]);
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurso');
    }
};
