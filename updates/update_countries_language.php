<?php

namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateCountriesLanguage extends Migration
{
    public function up(): void
    {
        // if (!Schema::hasColumn('rainlab_location_countries', 'country_language')) {
        //     Schema::table('rainlab_location_countries', function (Blueprint $table) {
        //         $table->string('country_language')->nullable();
        //     });
        // }
    }

    public function down(): void
    {
        if (Schema::hasColumn('rainlab_location_countries', 'country_language')) {
            Schema::table('rainlab_location_countries', function (Blueprint $table) {
                $table->dropColumn('country_language');
            });
        }
    }
}