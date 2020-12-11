<?php namespace pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Videos extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_videos';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	public $attachOne = [
		'file' => 'System\Models\File',
	];
}
