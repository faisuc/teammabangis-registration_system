<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{

    protected $fillable = [
        'user_id',
        'reference_code',
        'first_name',
        'last_name',
        'middle_name',
        'landline_number',
        'mobile_number',
        'date_acceptance',
        'date_moved_in',
        'present_address',
        'other_address',
        'nationality',
        'civil_status',
        'age',
        'birth_place',
        'date_of_birth',
        'company_name',
        'company_address',
        'company_contact_number',
        'occupation',
        'position'
    ];

    public function registrant()
    {
        return $this->belongsTo('App\Registrant');
    }

}
