<?php namespace Pensoft\Media\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Documents extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public string $listConfig = 'config_list.yaml';
    public string $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Pensoft.Media', 'media', 'side-menu-media-documents');
    }
}