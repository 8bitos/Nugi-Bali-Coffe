<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('lokasi_url');
            $table->string('hero_image')->nullable()->after('logo');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            $table->dropColumn(['logo', 'hero_image']);
        });
    }
};

