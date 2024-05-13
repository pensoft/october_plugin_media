<?php namespace Pensoft\Media\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Categories Backend Controller
 */
class Categories extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ReorderController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';
    
    /**
     * @var string reorderConfig file
     */
    public $reorderConfig = 'config_reorder.yaml';
    
    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Pensoft.Media', 'media', 'categories');
    }
}
