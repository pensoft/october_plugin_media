<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
use Validator;

/**
 * Model
 */
class Newsletters extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name"];

    /**
     * 
     */
    protected $fillable = [
        'name',
        'date',
        'newsletter_image',
        'file',
        'url',
        // Other fields...
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_newsletters';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'name',
        'file_language_versions',
    ];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [
        'file_language_versions'
    ];
    
	public $attachOne = [
		'newsletter_image' => 'System\Models\File',
		'file' => 'System\Models\File',
	];

    public $attachMany = [
        'file_lang_versions' => 'System\Models\File',
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

        /**
     * Add translation support to this model, if available.
     *
     * @return void
     */
    public static function boot()
    {
        Validator::extend(
            'json',
            function ($attribute, $value, $parameters) {
                json_decode($value);

                return json_last_error() == JSON_ERROR_NONE;
            }
        );

        // Call default functionality (required)
        parent::boot();

        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {
            return;
        }

        // Extend the constructor of the model
        self::extend(
            function ($model) {
                // Implement the translatable behavior
                $model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';
            }
        );
    }
}
