<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
/**
 * Model
 */
class Flyers extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name"];
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
        'file_print' => 'System\Models\File',
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
