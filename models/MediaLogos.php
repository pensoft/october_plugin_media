<?php namespace pensoft\Media\Models;

use Model;

/**
 * Model
 */
class MediaLogos extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_logos';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	public $attachOne = [
		'logo_image' => 'System\Models\File',
		'file_jpg' => 'System\Models\File',
		'file_png' => 'System\Models\File',
		'file_eps' => 'System\Models\File',
	];

}
