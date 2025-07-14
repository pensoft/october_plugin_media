<<<<<<< HEAD
<?php namespace Pensoft\Media\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
=======
<?php namespace Pensoft\Media\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMediaPodcasts2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_media_podcasts', function($table)
>>>>>>> 9ec6671 (added short description field to videos, webinars, podcasts)
        {
            $table->text('description')->nullable();
        });
    }
<<<<<<< HEAD

    public function down(): void
    {
        Schema::table('pensoft_media_podcasts', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });
    }
}
=======
    
    public function down()
    {
        Schema::table('pensoft_media_podcasts', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
>>>>>>> 9ec6671 (added short description field to videos, webinars, podcasts)
