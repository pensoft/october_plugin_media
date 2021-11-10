<?php namespace Pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Graphic extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_graphics';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	public $attachOne = [
		'image' => 'System\Models\File',
		'file' => 'System\Models\File',
	];

}
