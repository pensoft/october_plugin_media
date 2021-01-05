<?php namespace Pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Videos extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\NestedTree;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_videos';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	protected $nullable = ['parent_id'];

	public $belongsTo = [
		'parent' => 'Pensoft\Media\Models\Videos',
	];

	public $attachOne = [
		'file' => 'System\Models\File',
	];
}
