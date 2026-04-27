<?php namespace Pensoft\Media\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Webinars Back-end Controller
 */
class Webinars extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ReorderController::class,
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public string $formConfig = 'config_form.yaml';
    public string $reorderConfig = 'config_reorder.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public string $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Pensoft.Media', 'media', 'side-menu-media-webinars');
    }
}