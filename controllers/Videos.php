<?php namespace pensoft\Media\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Videos extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('pensoft.Media', 'main-menu-item', 'side-menu-media-videos');
    }
}
