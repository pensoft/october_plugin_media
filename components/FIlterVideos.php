<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Videos;
use RainLab\Location\Models\Country;

/**
 * Filter Videos Component
 */
class FIlterVideos extends ComponentBase
{
    /**
     * Provides details for the component, such as its name and description.
     *
     * @return array An associative array with the name and description of the component.
     */
    public function componentDetails()
    {
        return [
            'name' => 'FIlterVideos Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * Defines properties for the component.
     *
     * @return array An empty array, as this component does not have properties defined.
     */
    public function defineProperties()
    {
        return [];
    }

    /**
     * Executes when the component is run. Adds JS, retrieves video data and country information, 
     * and sets them to the page context.
     */
    public function onRun()
    {
        $this->addJs('/plugins/pensoft/media/assets/def.js');
        $this->page['videos'] = $this->filterVideos()->get();

        $subQuery = Country::isEnabled()
            ->where('is_pinned', true)
            ->groupBy('country_language')
            ->selectRaw('MIN(id) as id');

        $countries = Country::isEnabled()
            ->joinSub($subQuery, 'sub', 'rainlab_location_countries.id', '=', 'sub.id')
            ->select('rainlab_location_countries.id', 'rainlab_location_countries.country_language', 'rainlab_location_countries.code')
            ->orderBy('rainlab_location_countries.id', 'asc')
            ->get();

        $formattedCountries = [];
        foreach ($countries as $country) {
            $formattedCountries[$country->id] = [
                'name' => $country->country_language,
                'code' => $country->code
            ];
        }

        $this->page['countries'] = $formattedCountries;
    }

    /**
     * Handles the 'Filter Videos' AJAX request, returning updated video partial data.
     *
     * @return array An associative array with a key pointing to the HTML content for the videos.
     */
    public function onFilterVideos()
    {
        $videos = $this->filterVideos()->get();

        // Update the partial
        return [
            '#partialVideos' => $this->renderPartial('@videos', ['videos' => $videos])
        ];
    }
    
    /**
     * Filters videos based on the country language provided.
     *
     * @return mixed A query builder instance for the Videos model filtered by country language.
     */
    protected function filterVideos()
    {
        $countryId = post('filter_videos');

        // Validate that the country exists in db
        $validCountry = Country::find($countryId);

        if ($validCountry) {
            $language = $validCountry->country_language;

            // Fetch all country IDs that speak this language
            $countryIdsWithSameLanguage = Country::where('country_language', $language)
                                                ->pluck('id')
                                                ->toArray();

            // Get videos where the country_id matches any of the countries speaking that language
            return Videos::whereIn('country_id', $countryIdsWithSameLanguage);
        }

        // Default to English, if doesn't exist - Default to all
        $englishSpeakingCountries = Country::where('country_language', 'English')->pluck('id')->toArray();
        if(empty($englishSpeakingCountries)) {
            return Videos::all();
        } else {
            return Videos::whereIn('country_id', $englishSpeakingCountries);
        }
        
    }
}
