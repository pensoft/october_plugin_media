<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Books;
use RainLab\Location\Models\Country;

/**
 * FilterBooks Component
 */
class FilterBooks extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'FilterBooks Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }


    public function onRun()
    {
//        $this->addJs('/plugins/pensoft/media/assets/def.js');
        $this->page['books'] = $this->filterBooks()->get();

        $countries = Country::isEnabled()->get();

        $formattedCountries = [];
        foreach ($countries as $country) {
            $formattedCountries[$country->id] = [
                'name' => $country->name,
                'code' => $country->code,
                'language' => $country->country_language
            ];
        }

        $this->page['countries'] = $formattedCountries;
    }

    /**
     * Handles the 'Filter books' AJAX request, returning updated books partial data.
     *
     * @return array An associative array with a key pointing to the HTML content for the books.
     */
    public function onFilterBooks()
    {
        $books = $this->filterBooks()->get();

        // Update the partial
        return [
            '#partialBooks' => $this->renderPartial('components/filter_books', ['records' => $books])
        ];
    }

    /**
     * Filters books based on the country language provided.
     *
     * @return mixed A query builder instance for the books model filtered by country language.
     */
    private function filterBooks()
    {
        $countryId = post('filter_books') ?: 3;//english by default

        return Books::where('country_id', $countryId);
    }
}
