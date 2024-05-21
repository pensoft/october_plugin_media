<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Webinars as WebinarsModel;
use Pensoft\Media\Models\WebinarsCategory;
use System\Models\File;
use Redirect;

class Webinars extends ComponentBase
{
    public $records;
    public $categories;
    public $category;
    public $currentCategoryIntro;
    public $showCategoryIntro;
    public $jumbotron;

    public function componentDetails()
    {
        return [
            'name' => 'Webinars Component',
            'description' => 'Displays a list of webinars with category filters and download functionality'
        ];
    }

    public function defineProperties()
    {
        return [
            'showCategoryIntro' => [
                'title'       => 'Show Category Intro',
                'description' => 'Whether to display the category intro.',
                'type'        => 'checkbox',
                'default'     => false,
            ],
            'jumbotron' => [
                'title'       => 'Jumbotron',
                'description' => 'Slug of the jumbotron that we will relate to',
                'type' => 'dropdown'
            ],
        ];
    }
    public function getJumbotronOptions()
    {
        if (!class_exists(\Pensoft\Jumbotron\Models\Jumbotron::class)) {
            return [];
        }

        $options = ['' => 'None'];
        $jumbotrons = \Pensoft\Jumbotron\Models\Jumbotron::all()->pluck('title', 'slug')->toArray();

        return array_merge($options, $jumbotrons);
    }

    public function onRun()
    {
        $this->prepareVars();
        $this->page['categories'] = $this->categories;
        $this->page['records'] = $this->filterRecords();
        $this->page['category'] = $this->category;
        $this->page['currentCategoryIntro'] = $this->currentCategoryIntro;
        $this->page['showCategoryIntro'] = $this->property('showCategoryIntro');
        $this->page['jumbotron'] = $this->jumbotron;

        if (get('download')) {
            $this->downloadFile();
        }
    }

    protected function prepareVars()
    {
        $this->category = input('category', 'all');
        $this->categories = WebinarsCategory::listCategories();

        // Set the current category intro or default jumbotron
        if ($this->category == 'all') {
            $jumbotronSlug = $this->property('jumbotron');
            $this->jumbotron = $this->getJumbotronBySlug($jumbotronSlug);
            $this->currentCategoryIntro = null;
        } else {
            $currentCategory = $this->getCurrentCategory($this->category);
            $this->currentCategoryIntro = $currentCategory ? $currentCategory->category_intro : null;
            $this->jumbotron = null;
        }

        $this->page['categories'] = $this->categories;
        $this->page['category'] = $this->category;
    }

    protected function filterRecords()
    {
        if ($this->category == 'all' || !is_numeric($this->category)) {
            return WebinarsModel::all();
        }
        return WebinarsModel::where('category_id', $this->category)->get();
    }

    protected function getCurrentCategory($categoryId)
    {
        return WebinarsCategory::find($categoryId);
    }

    protected function getJumbotronBySlug($slug)
    {
        if (class_exists('Pensoft\Jumbotron\Models\Jumbotron')) {
            return \Pensoft\Jumbotron\Models\Jumbotron::where('slug', $slug)->first();
        }
        return null;
    }

    protected function downloadFile()
    {
        $file = File::find((int)get('download'));
        if (!$file) {
            return Redirect::to('/webinars');
        }

        $file_name = $file->getLocalPath();
        $recordName = get('file_name') ? get('file_name') : 'ForestPaths_video';
        $ext = $file->getExtension();

        if (file_exists($file_name)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $recordName . '.' . $ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            ob_clean();
            flush();
            readfile($file_name);
            exit();
        }

        return Redirect::to('/webinars');
    }
}
