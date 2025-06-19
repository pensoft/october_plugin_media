<?php namespace Pensoft\Media\Models;

use Model;
use October\Rain\Database\Traits\Sortable;
use RainLab\Location\Models\Country as CountryModel;

/**
 * Model
 */
class Books extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;
    use Sortable;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_books';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'country' => [
            'RainLab\Location\Models\Country',
            'scope' => 'isEnabled',
            'order' => 'id'
        ],
    ];

    public $attachOne = [
        'file' => 'System\Models\File',
        'cover' => 'System\Models\File',
    ];

}
