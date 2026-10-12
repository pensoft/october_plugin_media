<?php namespace Pensoft\Media\Models;

use Model;
use October\Rain\Database\Traits\Sortable;
use RainLab\Location\Models\Country as CountryModel;
use System\Models\File;

/**
 * Model
 */
class Books extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;
    use Sortable;

    protected $casts = [
        'deleted_at' => 'datetime',
    ];


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
            \RainLab\Location\Models\Country::class,
            'scope' => 'isEnabled',
            'order' => 'id'
        ],
    ];

    public $attachOne = [
        'file' => File::class,
        'cover' => File::class,
    ];

}