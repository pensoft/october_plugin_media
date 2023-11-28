<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Galleries as GalleriesModel;

/**
 * GalleryItem Component
 */
class GalleryItem extends ComponentBase
{

    /** @var GalleriesModel The loaded gallery record */
    public $record;

    public function componentDetails()
    {
        return [
            'name' => 'GalleryItem Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                'title' => 'id',
                'description' => 'The id of the record',
                'default' => '{{ :id }}',
                'type' => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->record = $this->loadRecord();
        $this->page['gallery'] = GalleriesModel::where('id', $this->property('id'))->first();
    }

    protected function loadRecord()
    {
        $galleryId = $this->property('id');
        return GalleriesModel::where('id', $galleryId)->first();
    }
}
