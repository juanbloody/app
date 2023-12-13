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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->char('codigo',255)->unique()->nullable();
            $table->string('nombre');
            $table->float('valor', 9, 2);
            $table->integer('cantidad');
            $table->float('total', 9, 2);
            $table->integer('quedaron');
            $table->float('valor_quedaron', 9, 2);
            $table->float('valor_provedor', 9, 2);
            $table->float('valor_unitario', 9, 2);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
