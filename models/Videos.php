<?php namespace Pensoft\Media\Models;

use Model;
use BackendAuth;

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

	protected $nullable = ['parent_id'];

	public $belongsTo = [
		'parent' => 'Pensoft\Media\Models\Videos',
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
}
