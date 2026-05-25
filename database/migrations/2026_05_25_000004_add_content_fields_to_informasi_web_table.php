<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            if (!Schema::hasColumn('informasi_web', 'instagram_url')) {
                $table->string('instagram_url')->nullable()->after('lokasi_url');
            }
            if (!Schema::hasColumn('informasi_web', 'tentang_image')) {
                $table->string('tentang_image')->nullable()->after('hero_image');
            }
            if (!Schema::hasColumn('informasi_web', 'lokasi_image')) {
                $table->string('lokasi_image')->nullable()->after('tentang_image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            $drops = [];
            foreach (['instagram_url', 'tentang_image', 'lokasi_image'] as $col) {
                if (Schema::hasColumn('informasi_web', $col)) {
                    $drops[] = $col;
                }
            }
            if (!empty($drops)) {
                $table->dropColumn($drops);
            }
        });
    }
};

