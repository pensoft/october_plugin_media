<?php namespace Pensoft\Media\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Webinars Categories Backend Controller
 */
class WebinarsCategories extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ReorderController::class,
    ];

    public string $formConfig = 'config_form.yaml';
    public string $listConfig = 'config_list.yaml';
    public string $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Pensoft.Media', 'media', 'webinarscategories');
    }
}