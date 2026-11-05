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
        if (! Schema::hasColumn('categories', 'name')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('name', 100)->nullable()->unique()->after('id');
                $table->text('description')->nullable()->after('name');
            });
        }

        if (! Schema::hasColumn('categories', 'description')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->text('description')->nullable()->after('name');
            });
        }

        if (! Schema::hasColumn('items', 'name')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('name', 100)->after('id');
            });
        }

        if (! Schema::hasColumn('items', 'category')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('category', 100)->default('')->after('name');
            });
        }

        if (! Schema::hasColumn('items', 'stock')) {
            Schema::table('items', function (Blueprint $table) {
                $table->unsignedInteger('stock')->default(0)->after('category');
            });
        }

        if (! Schema::hasColumn('items', 'price')) {
            Schema::table('items', function (Blueprint $table) {
                $table->decimal('price', 12, 2)->default(0)->after('stock');
            });
        }

        if (! Schema::hasColumn('items', 'photo')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('photo')->nullable()->after('price');
            });
        }

        if (DB::table('categories')->count() === 0) {
            $now = now();
            DB::table('categories')->insert([
                ['name' => 'Elektronik', 'description' => 'Perangkat elektronik dan gadget', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'ATK', 'description' => 'Alat tulis kantor', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Kebersihan', 'description' => 'Perlengkapan kebersihan', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Makanan', 'description' => 'Konsumsi dan snack', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
