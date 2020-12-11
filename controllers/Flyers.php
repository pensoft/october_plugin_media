<?php namespace Pensoft\Media\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Flyers extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('pensoft.Media', 'main-menu-item', 'side-menu-media-flyers');
    }
}
