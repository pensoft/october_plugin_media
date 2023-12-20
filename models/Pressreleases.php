<?php namespace Pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Pressreleases extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;
    use \October\Rain\Database\Traits\NestedTree;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name","youtube_url","vimeo_url"];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_pressreleases';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	protected $jsonable = [
		'link'
	];
}
