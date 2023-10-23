<?php

namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
use Validator;
/**
 * Model
 */
class Galleries extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = true;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name", "related", "article_id"];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_galleries';

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
        'article',
        'related'
    ];

    // Multiple images can be attached to a gallery.
    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    // Optional relationship with the Article model.
    public $belongsTo = [];

    public $fillable = ['name', 'related', 'article_id'];

    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    // default values for new instances
    public $attributes = [
        'name' => 'Gallery Name',
        'related' => false,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Check if the Article model exists
        if (class_exists('Pensoft\Articles\Models\Article')) {
            $this->belongsTo['article'] = ['Pensoft\Articles\Models\Article', 'key' => 'article_id'];
        }
    }

    /**
     * Actions to perform before saving a gallery.
     * If the gallery isn't related to an article, unset the article_id.
     */
    public function beforeSave()
    {
        if (!$this->related) {
            $this->article_id = null;
        }
    }

    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }

    /**
     * Provides a list of article options.
     * This is used when selecting an article to associate with the gallery.
     */
    public function getArticleOptions()
    {
        // Check if the Article model exists.
        if (class_exists(\Pensoft\Articles\Models\Article::class)) {
            return $articles = \Pensoft\Articles\Models\Article::all()->pluck('title', 'id')->toArray();
        }
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
