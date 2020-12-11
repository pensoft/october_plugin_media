<?php namespace pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Flyers extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_flyers';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	public $attachOne = [
		'flyer_image' => 'System\Models\File',
		'file' => 'System\Models\File',
	];
}
