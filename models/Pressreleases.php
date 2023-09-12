<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
/**
 * Model
 */
class Pressreleases extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;

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
    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }
    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }
}
