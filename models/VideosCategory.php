<?php namespace Pensoft\Media\Models;

use Model;

/**
 * Model
 */
class VideosCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_videos_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'videos' => ['Pensoft\Media\Models\Videos']
    ];

    public function scopeListCategories($query)
    {
        return $query->pluck('name', 'id')->toArray();
    }
}
