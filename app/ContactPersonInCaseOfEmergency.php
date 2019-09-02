<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPersonInCaseOfEmergency extends Model
{

    protected $table = 'contact_person_in_case_of_emergency';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'relationship',
        'landline_number',
        'mobile_number',
        'frequency_of_owners_stay',
        'area_involved_with_the_association',
    ];

    public function registrant()
    {
        return $this->belongsTo('App\Registrant');
    }

}
