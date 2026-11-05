<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Elektronik', 'description' => 'Perangkat elektronik dan gadget', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ATK', 'description' => 'Alat tulis kantor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kebersihan', 'description' => 'Perlengkapan kebersihan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Makanan', 'description' => 'Konsumsi dan snack', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
