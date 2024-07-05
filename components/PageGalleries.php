<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Galleries as GalleriesModel;

/**
 * PageGalleries Component
 */
class PageGalleries extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'PageGalleries Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageType' => [
                'title'       => 'Page Type',
                'description' => 'Type of the page to load specific galleries',
                'type'        => 'string',
                'default'     => '',
            ]
        ];
    }
    
    public function onRun()
    {
        $pageType = $this->property('pageType');
        $this->page['galleries'] = $this->loadGalleries($pageType);
    }

    protected function loadGalleries($pageType)
    {
        if ($pageType == 'homepage') {
            return GalleriesModel::where('show_on_homepage', true)->get();
        } elseif ($pageType == 'ecological') {
            $galleries = GalleriesModel::where('show_on_ecological', true)->get();
            return $galleries;
        }
    
        return [];
    }
}
