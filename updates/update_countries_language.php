<?php

namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateCountriesLanguage extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('rainlab_location_countries', 'country_language')) {
            Schema::table('rainlab_location_countries', function ($table) {
                $table->string('country_language')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_location_countries', 'country_language')) {
            Schema::table('rainlab_location_countries', function ($table) {
                $table->dropColumn('country_language');
            });
        }
    }
}
