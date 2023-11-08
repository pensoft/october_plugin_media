<?php namespace Pensoft\Media;

use Pensoft\Media\Components\FIlterVideos;
use SaurabhDhariwal\Revisionhistory\Classes\Diff as Diff;
use System\Classes\PluginBase;
use System\Models\Revision as Revision;

class Plugin extends PluginBase
{

    public function boot(){
        /* Extetions for revision */
        Revision::extend(function($model){
            /* Revison can access to the login user */
            $model->belongsTo['user'] = ['Backend\Models\User'];

            /* Revision can use diff function */
            $model->addDynamicMethod('getDiff', function() use ($model){
                return Diff::toHTML(Diff::compare($model->old_value, $model->new_value));
            });
        });

        if(class_exists('\RainLab\Location\Controllers\Locations')){
            \RainLab\Location\Controllers\Locations::extendFormFields(function($form, $model){
                if (!$model instanceof \Rainlab\Location\Models\Country) {
                    return;
                }
                $form->addFields([
                    'country_language' => [
                        'label' => 'Country language',
                        'type' => 'text',
                    ]
                ]);
            });
        }
    }

    public function registerComponents()
    {
        return [
            FIlterVideos::class => 'filter_videos',
            'Pensoft\Media\Components\Galleries' => 'galleries',
            'Pensoft\Media\Components\GalleriesList' => 'galleries_list',
        ];
    }

}
