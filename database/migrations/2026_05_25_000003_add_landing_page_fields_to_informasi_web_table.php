<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            $table->string('landing_title')->nullable()->after('hero_image');
            $table->text('landing_subtitle')->nullable()->after('landing_title');
            $table->string('landing_cta_text')->nullable()->after('landing_subtitle');
            $table->string('landing_cta_url')->nullable()->after('landing_cta_text');
            $table->json('landing_slides')->nullable()->after('landing_cta_url');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_web', function (Blueprint $table) {
            $table->dropColumn([
                'landing_title',
                'landing_subtitle',
                'landing_cta_text',
                'landing_cta_url',
                'landing_slides',
            ]);
        });
    }
};

