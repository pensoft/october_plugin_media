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
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
		'Backend\Behaviors\ReorderController',
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';
	public $reorderConfig = 'config_reorder.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Pensoft.Media', 'media-center', 'side-menu-media-webinars');
    }
}
