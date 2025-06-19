<?php namespace Pensoft\Media;

use Pensoft\Media\Components\FilterBooks;
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
            FilterBooks::class => 'filter_books',
            'Pensoft\Media\Components\Galleries' => 'galleries',
            'Pensoft\Media\Components\PageGalleries' => 'page_galleries',
            'Pensoft\Media\Components\GalleriesList' => 'galleries_list',
            'Pensoft\Media\Components\Webinars' => 'webinars'
        ];
    }

    public function registerPermissions()
    {
        return [
            'pensoft.media.access' => [
                'tab' => 'Media',
                'label' => 'Manage media center'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'media' => [
                'label'       => 'Media center',
                'url'         => \Backend::url('pensoft/media/logos'),
                'icon'        => 'oc-icon-play-circle-o',
                'permissions' => ['pensoft.media.*'],
                'sideMenu' => [
                    'side-menu-media-logos' => [
                        'label'       => 'Logos',
                        'url'         => \Backend::url('pensoft/media/logos'),
                        'icon'        => 'oc-icon-file-image-o',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-flyers' => [
                        'label'       => 'Flyers',
                        'url'         => \Backend::url('pensoft/media/flyers'),
                        'icon'        => 'oc-icon-image',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-categories' => [
                        'label'       => 'Flyers Categories',
                        'url'         => \Backend::url('pensoft/media/categories'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-newsletter' => [
                        'label'       => 'Newsletter',
                        'url'         => \Backend::url('pensoft/media/newsletter'),
                        'icon'        => 'oc-icon-newspaper-o',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-presentations' => [
                        'label'       => 'Presentations',
                        'url'         => \Backend::url('pensoft/media/presentations'),
                        'icon'        => 'oc-icon-file-powerpoint-o',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-pressreleases' => [
                        'label'       => 'Press Releases',
                        'url'         => \Backend::url('pensoft/media/pressreleases'),
                        'icon'        => 'oc-icon-twitch',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-item3' => [
                        'label'       => 'Press Releases Categories',
                        'url'         => \Backend::url('pensoft/media/presscategories'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-videos' => [
                        'label'       => 'Videos',
                        'url'         => \Backend::url('pensoft/media/videos'),
                        'icon'        => 'oc-icon-video-camera',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-item2' => [
                        'label'       => 'Videos Categoriesdeos',
                        'url'         => \Backend::url('pensoft/media/videoscategories'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-webinars' => [
                        'label'       => 'Webinars',
                        'url'         => \Backend::url('pensoft/media/webinars'),
                        'icon'        => 'oc-icon-headphones',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-categories-webinars' => [
                        'label'       => 'Webinars Categories',
                        'url'         => \Backend::url('pensoft/media/webinarscategories'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-item' => [
                        'label'       => 'Graphics',
                        'url'         => \Backend::url('pensoft/media/graphics'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-galleries' => [
                        'label'       => 'Galleries',
                        'url'         => \Backend::url('pensoft/media/galleries'),
                        'icon'        => 'oc-icon-camera',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-media-documents' => [
                        'label'       => 'Documents',
                        'url'         => \Backend::url('pensoft/media/documents'),
                        'icon'        => 'icon-file',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-item4' => [
                        'label'       => 'Podcasts',
                        'url'         => \Backend::url('pensoft/media/podcasts'),
                        'icon'        => 'icon-microphone',
                        'permissions' => ['pensoft.media.*'],
                    ],
                    'side-menu-item5' => [
                        'label'       => 'Books',
                        'url'         => \Backend::url('pensoft/media/books'),
                        'icon'        => 'icon-book',
                        'permissions' => ['pensoft.media.*'],
                    ],
                ]
            ],
        ];
    }

}
