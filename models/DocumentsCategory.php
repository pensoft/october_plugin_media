<?php namespace Pensoft\Media\Models;

use Model;

/**
 * DocumentsCategory Model
 */
class DocumentsCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var array Behaviors implemented by this model.
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_media_documents_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required',
    ];

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'title',
    ];

    public $hasMany = [
        'documents' => [Documents::class, 'key' => 'category_id'],
    ];
}
