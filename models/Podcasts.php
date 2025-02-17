<?php namespace Pensoft\Media\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class Podcasts extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    use Sortable;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_podcasts';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $attachOne = [
        'file' => 'System\Models\File',
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
        $url = $this->url;

        // check if the URL is a youtube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // modify the URL to include the embed code
                $embed_url = $this->convertEmbed($url);
                $this->url = $embed_url;
            }
        }
    }
}
