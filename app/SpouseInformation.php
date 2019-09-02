<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpouseInformation extends Model
{

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'landline_number',
        'mobile_number',
        'present_address',
        'other_address',
        'nationality',
        'civil_status',
        'age',
        'birth_place',
        'date_of_birth',
        'email',
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
