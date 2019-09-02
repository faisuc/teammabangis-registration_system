<?php

use App\ProjectSite;

function getProjectSites()
{

   return ProjectSite::has('areaManagers')->get()->pluck('name', 'id');

}

function getCivilStatuses()
{
    return [
        1 => 'Married',
        2 => 'Single',
        3 => 'Widowed'
    ];
}

function getFrequencyOwnersStay()
{
    return [
        1 => 'Daily',
        2 => 'Weekly',
        3 => 'Monthly',
        4 => 'Occationally'
    ];
}

function getInvolvedWithTheAssociation()
{
    return [
        1 => 'Community Fairs',
        2 => 'Clean and Green/Maintenance Ecology',
        3 => 'Peace and Order/Security',
        4 => 'Financial Management',
        5 => 'Legal Aspects',
        6 => 'Livelihood',
        7 => 'Youth Affairs'
    ];
}

function getTextInsideBrackets($str, $prepend = '')
{
    preg_match_all("/\[([^\]]*)\]/", $str, $matches);

    if ( ! empty($matches)) {
        return implode('', $matches[1]);
    }

    return $matches;
}