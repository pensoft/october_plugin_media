<?php namespace Pensoft\Media\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Graphics extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController', 'Backend\Behaviors\ReorderController'    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    /**
     * @var string reorderConfig file
     */
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Pensoft.Media', 'media-center', 'side-menu-item');
    }
}
