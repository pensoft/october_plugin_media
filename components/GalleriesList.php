<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Galleries as GalleriesModel;

/**
 * GalleriesList Component
 */
class GalleriesList extends ComponentBase
{
    public $records;

    public function componentDetails()
    {
        return [
            'name' => 'GalleriesList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->records = $this->loadRecords();
        $this->page['records'] = $this->records;
    }

    private function loadRecords()
    {
        return GalleriesModel::all();
    }
}
