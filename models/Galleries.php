<?php

namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
use Validator;
use Cms\Classes\Theme;

/**
 * Model
 */
class Galleries extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;
    use \October\Rain\Database\Traits\Sortable;

    public $timestamps = true;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id", "name", "related", "article_id", "event_related", "event_id"];

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
        'related',
        'event_related',
        'event_id'
    ];

    protected $casts = [
        'show_on_homepage' => 'boolean',
        'show_on_ecological' => 'boolean',
    ];

    // Multiple images can be attached to a gallery.
    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    // Optional relationship with the Article model.
    public $belongsTo = [];

    public $fillable = ['name', 'related', 'article_id', 'event_related', 'event_id', 'show_on_homepage', 'show_on_ecological'];

    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    public $belongsToMany = [
        'articles' => [
            'Pensoft\Articles\Models\Article',
            'table' => 'pensoft_gallery_article_pivot',
            'key' => 'gallery_id',
            'otherKey' => 'article_id',
            'order' => 'created_at desc'
        ],
        'events' => [
            'Pensoft\Calendar\Models\Entry',
            'table' => 'pensoft_gallery_entry_pivot',
            'key' => 'gallery_id',
            'otherKey' => 'entry_id',
            'order' => 'created_at desc'
        ],
    ];

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

    /**
     * Provides a list of event options.
     * This is used when selecting an event to associate with the gallery.
     */
    public function getEventOptions()
    {
        // Check if the Event model exists.
        if (class_exists(\Pensoft\Calendar\Models\Entry::class)) {
            return $events = \Pensoft\Calendar\Models\Entry::all()->pluck('title', 'id')->toArray();
        }
    }

    public function filterFields($fields, $context = null)
    {
        $theme = Theme::getActiveTheme();
        // if active theme is either teamup production or dev
        if ($theme->getDirName() !== 'pensoft-teamup2' && $theme->getDirName() !== 'pensoft-teamup') {
            if (isset($fields->show_on_homepage)) {
                $fields->show_on_homepage->hidden = true;
            }
            if (isset($fields->show_on_ecological)) {
                $fields->show_on_ecological->hidden = true;
            }
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
