<?php
use Illuminate\Support\Str;

return [
    'registrants' => [
        'forms' => [
            'personal_information' => [
                'reference_code' => [
                    'category' => 'input',
                    'type' => 'text',
                    'value' => Str::random(40),
                    'label' => 'Reference Code',
                    'id' => 'personal_information[reference_code]',
                    'readonly' => 'readonly'
                ],
                'project_sites' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'Project Site',
                    'id' => 'personal_information[project_sites][]',
                    'options' => []
                ],
                'area_managers' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'Area Manager',
                    'id' => 'personal_information[area_managers][]',
                    'options' => []
                ],
                'first_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'First Name',
                    'id' => 'personal_information[first_name]',
                    'value' => '',
                ],
                'last_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Last Name',
                    'id' => 'personal_information[last_name]',
                    'value' => '',
                ],
                'middle_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Middle Name',
                    'id' => 'personal_information[middle_name]',
                    'value' => '',
                ],
                'landline_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Landline Number',
                    'id' => 'personal_information[landline_number]',
                    'value' => '',
                ],
                'mobile_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Mobile Number',
                    'id' => 'personal_information[mobile_number]',
                    'value' => '',
                ],
                'date_acceptance' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Date Acceptance',
                    'id' => 'personal_information[date_acceptance]',
                    'value' => '',
                ],
                'date_movein' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Date Moved In',
                    'id' => 'personal_information[date_moved_in]',
                    'value' => '',
                ],
                'present_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Present Address',
                    'id' => 'personal_information[present_address]',
                    'value' => '',
                ],
                'other_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Other Address',
                    'id' => 'personal_information[other_address]',
                    'value' => '',
                ],
                'nationality' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Nationality',
                    'id' => 'personal_information[nationality]',
                    'value' => '',
                ],
                'civil_status' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'Civil Status',
                    'id' => 'personal_information[civil_status]',
                    'options' => [
                        'married' => 'Married',
                        'single' => 'Single',
                        'widowed' => 'Widowed'
                    ]
                ],
                'age' => [
                    'category' => 'input',
                    'type' => 'number',
                    'label' => 'Age',
                    'id' => 'personal_information[age]',
                    'value' => '',
                ],
                'birth_place' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Birth Place',
                    'id' => 'personal_information[birth_place]',
                    'value' => '',
                ],
                'date_of_birth' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Date of Birth',
                    'id' => 'personal_information[date_of_birth]',
                    'value' => '',
                ],
                'email' => [
                    'category' => 'input',
                    'type' => 'email',
                    'label' => 'Email Address',
                    'id' => 'personal_information[email]',
                    'value' => '',
                ],
                'company_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Name',
                    'id' => 'personal_information[company_name]',
                    'value' => '',
                ],
                'company_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Address',
                    'id' => 'personal_information[company_address]',
                    'value' => '',
                ],
                'company_contact_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Contact Number',
                    'id' => 'personal_information[company_contact_number]',
                    'value' => '',
                ],
                'occupation' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Occupation',
                    'id' => 'personal_information[occupation]',
                    'value' => '',
                ],
                'position' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Position',
                    'id' => 'personal_information[position]',
                    'value' => '',
                ],
            ],
            'spouse_information' => [
                'first_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'First Name',
                    'id' => 'spouse_information[first_name]',
                    'value' => '',
                ],
                'last_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Last Name',
                    'id' => 'spouse_information[last_name]',
                    'value' => '',
                ],
                'middle_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Middle Name',
                    'id' => 'spouse_information[middle_name]',
                    'value' => '',
                ],
                'landline_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Landline Number',
                    'id' => 'spouse_information[landline_number]',
                    'value' => '',
                ],
                'mobile_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Mobile Number',
                    'id' => 'spouse_information[mobile_number]',
                    'value' => '',
                ],
                'present_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Present Address',
                    'id' => 'spouse_information[present_address]',
                    'value' => '',
                ],
                'other_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Other Address',
                    'id' => 'spouse_information[other_address]',
                    'value' => '',
                ],
                'nationality' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Nationality',
                    'id' => 'spouse_information[nationality]',
                    'value' => '',
                ],
                'civil_status' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'Civil Status',
                    'id' => 'spouse_information[civil_status]',
                    'options' => [
                        'married' => 'Married',
                        'single' => 'Single',
                        'widowed' => 'Widowed'
                    ]
                ],
                'age' => [
                    'category' => 'input',
                    'type' => 'number',
                    'label' => 'Age',
                    'id' => 'spouse_information[age]',
                    'value' => '',
                ],
                'birth_place' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Birth Place',
                    'id' => 'spouse_information[birth_place]',
                    'value' => '',
                ],
                'date_of_birth' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Date of Birth',
                    'id' => 'spouse_information[date_of_birth]',
                    'value' => '',
                ],
                'email' => [
                    'category' => 'input',
                    'type' => 'email',
                    'label' => 'Email Address',
                    'id' => 'spouse_information[email]',
                    'value' => '',
                ],
                'company_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Name',
                    'id' => 'spouse_information[company_name]',
                    'value' => '',
                ],
                'company_address' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Address',
                    'id' => 'spouse_information[company_address]',
                    'value' => '',
                ],
                'company_contact_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Company Contact Number',
                    'id' => 'spouse_information[company_contact_number]',
                    'value' => '',
                ],
                'occupation' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Occupation',
                    'id' => 'spouse_information[occupation]',
                    'value' => '',
                ],
                'position' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Position',
                    'id' => 'spouse_information[position]',
                    'value' => '',
                ],
            ],
            'contact_person_in_case_of_emergency' => [
                'first_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'First Name',
                    'id' => 'contact_person_in_case_of_emergency[first_name]',
                    'value' => '',
                ],
                'last_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Last Name',
                    'id' => 'contact_person_in_case_of_emergency[last_name]',
                    'value' => '',
                ],
                'middle_name' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Middle Name',
                    'id' => 'contact_person_in_case_of_emergency[middle_name]',
                    'value' => '',
                ],
                'landline_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Landline Number',
                    'id' => 'personal_information[landline_number]',
                    'value' => '',
                ],
                'relationship' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Relationship',
                    'id' => 'contact_person_in_case_of_emergency[relationship]',
                    'value' => '',
                ],
                'mobile_number' => [
                    'category' => 'input',
                    'type' => 'text',
                    'label' => 'Mobile Number',
                    'id' => 'contact_person_in_case_of_emergency[mobile_number]',
                    'value' => '',
                ],
                'frequency_of_owners_stay' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'Frequency of owners stay',
                    'id' => 'contact_person_in_case_of_emergency[frequency_of_owners_stay]',
                    'options' => []
                ],
                'in_what_area_or_aspect_would_like_to_be_involved_with_the_association' => [
                    'category' => 'select',
                    'type' => 'select',
                    'label' => 'In what area/aspect would you like to be involved with the association?',
                    'id' => 'contact_person_in_case_of_emergency[area_involved_with_the_association]',
                    'options' => []
                ],
            ]
        ]
    ]
];