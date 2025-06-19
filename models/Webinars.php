<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
use Validator;
/**
 * Webinars Model
 */
class Webinars extends Model
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
    public $table = 'pensoft_media_webinars';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'name'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
		'parent' => 'Pensoft\Media\Models\Videos',
        'category' => ['Pensoft\Media\Models\WebinarsCategory', 'key' => 'category_id']

	];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $attachOne = [
		'file' => 'System\Models\File',
	];
    
    public $attachMany = [];

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

    public function getCategoryOptions()
    {
        return \Pensoft\Media\Models\WebinarsCategory::pluck('name', 'id')->toArray();
    }

    private function convertEmbed($url)
    {
        // Check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // Check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // Modify the URL to include the embed code
                if (strpos($url, 'list=') !== false) {
                    // This is a playlist URL
                    $query_string = parse_url($url, PHP_URL_QUERY);
                    parse_str($query_string, $query_params);
                    $playlist_id = $query_params['list'] ?? '';
                    if ($playlist_id) {
                        return 'https://www.youtube.com/embed/videoseries?list=' . $playlist_id;
                    }
                } else {
                    // This is a regular YouTube video URL
                    $id = '';
                    if (strpos($url, 'youtu.be/') !== false) {
                        // Extract video id from youtu.be short link
                        $id = substr(strstr($url, 'youtu.be/'), 9);
                    } else {
                        // Extract video id from youtube.com link
                        $query_string = parse_url($url, PHP_URL_QUERY);
                        parse_str($query_string, $query_params);
                        $id = $query_params['v'] ?? '';
                    }
                    if ($id) {
                        return 'https://www.youtube.com/embed/' . $id;
                    }
                }
            }
        }
        return $url;
    }

    public function beforeSave()
    {
        $url = $this->youtube_url;

        // Check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // Check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // Modify the URL to include the embed code
                $embed_url = $this->convertEmbed($url);
                $this->youtube_url = $embed_url;
            }
        }
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