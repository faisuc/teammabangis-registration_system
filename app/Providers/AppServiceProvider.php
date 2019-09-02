<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('components.alert', 'alert');
        Blade::include('shared.alerts', 'sharedAlerts');

        if ( ! app()->runningInConsole()) {

            config(['registration-system.registrants.forms.personal_information.project_sites.options' => getProjectSites()]);
            config(['registration-system.registrants.forms.personal_information.civil_status.options' => getCivilStatuses()]);
            config(['registration-system.registrants.forms.spouse_information.civil_status.options' => getCivilStatuses()]);
            config(['registration-system.registrants.forms.contact_person_in_case_of_emergency.frequency_of_owners_stay.options' => getFrequencyOwnersStay()]);
            config(['registration-system.registrants.forms.contact_person_in_case_of_emergency.in_what_area_or_aspect_would_like_to_be_involved_with_the_association.options' => getInvolvedWithTheAssociation()]);
        }
    }
}
