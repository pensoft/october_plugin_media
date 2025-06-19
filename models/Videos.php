<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;
use Validator;
/**
 * Model
 */
class Videos extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","name","youtube_url","vimeo_url"];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_videos';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'title',
        'cover',
        'slug',
        'content',
        'caption',
        'keywords',
        'external',
        'type',
        'published'
    ];

	protected $nullable = ['parent_id'];

	public $belongsTo = [
		'parent' => 'Pensoft\Media\Models\Videos',
        'country' => [
            'RainLab\Location\Models\Country',
            'order' => 'id'
        ],
	];

	public $attachOne = [
		'file' => 'System\Models\File',
	];

    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    private function convertEmbed($url) {
        // check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // modify the URL to include the embed code
                $id = '';
                if (strpos($url, 'youtu.be/') !== false) {
                    // extract video id from youtu.be short link
                    $id = substr(strstr($url, 'youtu.be/'), 9);
                } else {
                    // extract video id from youtube.com link
                    $query_string = parse_url($url, PHP_URL_QUERY);
                    parse_str($query_string, $query_params);
                    $id = $query_params['v'] ?? '';
                }
                $embed_url = 'https://www.youtube.com/embed/' . $id;
                return $embed_url;
            }
        }
        return $url;
    }

    public function beforeSave()
    {
        $url = $this->youtube_url;

        // check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // modify the URL to include the embed code
                $embed_url = $this->convertEmbed($url);
                $this->youtube_url = $embed_url;
            }
        }
    }

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
