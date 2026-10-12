<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddSortOrderToNestedModels extends Migration
{
    protected $tables = [
        'pensoft_media_logos',
        'pensoft_media_pressreleases',
        'pensoft_media_videos',
        'pensoft_media_webinars',
    ];

    public function up()
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasColumn($table, 'sort_order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->integer('sort_order')->default(0);
                });
            }
        }
    }

    public function down()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasColumn($table, 'sort_order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('sort_order');
                });
            }
        }
    }
}
