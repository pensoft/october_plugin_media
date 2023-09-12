<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
/**
 * Model
 */
class MediaLogos extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\NestedTree;
    
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name"];
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
