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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('poster')->nullable();
            $table->string('logo')->nullable();
            $table->string('background')->nullable();  // baru
            $table->text('description')->nullable();
            $table->string('director')->nullable();
            $table->text('cast')->nullable(); // ganti string ke text, bisa simpan JSON atau comma separated list
            $table->year('release_year')->nullable(); // tahun saja
            $table->integer('duration')->nullable(); // durasi dalam menit
            $table->string('language')->nullable();
            $table->string('overlay_color', 7)->nullable(); // hex code #FFFFFF (7 karakter)
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
