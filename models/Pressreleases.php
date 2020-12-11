<?php namespace pensoft\Media\Models;

use Model;

/**
 * Model
 */
class Pressreleases extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_pressreleases';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
