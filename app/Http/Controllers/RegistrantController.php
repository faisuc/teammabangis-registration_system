<?php

namespace App\Http\Controllers;

use App\ContactPersonInCaseOfEmergency;
use App\Mail\SendInformationDetailsToRegistrant;
use App\Mail\SendNewRegistrantToAdmin;
use App\PersonalInformation;
use App\Registrant;
use App\Role;
use App\SpouseInformation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrantController extends Controller
{

    public function show($reference_code = null, $email = null)
    {

        $this->views['personalInformation'] = config('registration-system.registrants.forms.personal_information');
        $this->views['spouseInformation'] = config('registration-system.registrants.forms.spouse_information');
        $this->views['contactPersonInformation'] = config('registration-system.registrants.forms.contact_person_in_case_of_emergency');

        $reference_code = is_null($reference_code) ? request()->input('reference_code') : $reference_code;
        $email = is_null($email) ? request()->input('email') : $email;
        $registrant = Registrant::where('email', $email)->firstOrFail();
        $user_id = optional($registrant)->id;

        // $registrant = PersonalInformation::where('reference_code', $reference_code)->where('user_id', $user_id)->firstOrFail();

        $this->views['registrant'] = $registrant;

        return view('registrants.show', $this->views);
    }

    public function update(Request $request, Registrant $registrant)
    {
        // $request->validate([
        //     'personal_information.email' => 'required|email|unique:users,email',
        //     'personal_information.project_sites.*' => 'required',
        //     'personal_information.area_managers.*' => 'required',
        //     'personal_information.first_name' => 'required',
        //     'personal_information.last_name' => 'required',
        //     'personal_information.civil_status' => 'required',
        //     'personal_information.nationality' => 'required',
        //     'personal_information.age' => 'required',
        //     'personal_information.date_of_birth' => 'required',
        //     'spouse_information.first_name' => 'required',
        //     'spouse_information.last_name' => 'required',
        //     'spouse_information.nationality' => 'required',
        //     'spouse_information.civil_status' => 'required',
        //     'spouse_information.age' => 'required',
        //     'spouse_information.date_of_birth' => 'required',
        //     'contact_person_in_case_of_emergency.first_name' => 'required',
        //     'contact_person_in_case_of_emergency.last_name' => 'required',
        // ]);

        $registrantRole = Role::where('name', 'registrant')->first();

        $personalInformationDetails = Arr::except($request->input('personal_information'), ['project_sites', 'area_managers', 'email']);
        $spouseInformationDetails = $request->input('spouse_information');
        $contactPersonInCaseOfEmergencyDetails = $request->input('contact_person_in_case_of_emergency');

        $projectSites = $request->input('personal_information.project_sites');
        $areaManagers = $request->input('personal_information.area_managers');
        $personalInformationEmail = $request->input('personal_information.email');
        $personalInformationFirstName = $request->input('personal_information.first_name');
        $personalInformationLastName = $request->input('personal_information.last_name');

        // Create new user

        $registrant = Registrant::findOrFail($registrant->id);
        $registrant->name = $personalInformationFirstName . ' ' . $personalInformationLastName;
        $registrant->email = $personalInformationEmail;
        $registrant->password = bcrypt(Str::random(rand(40, 80)));
        $registrant->save();

        $registrant->projectSites()->sync($projectSites);
        $registrant->areaManagers()->sync($areaManagers);

        // $registrant->assignRole($registrantRole);

        $personalInformation = PersonalInformation::where('user_id', $registrant->id)->update($personalInformationDetails);
        $spouseInformation = SpouseInformation::where('user_id', $registrant->id)->update($spouseInformationDetails);
        $contactPersonInCaseOfEmergency = ContactPersonInCaseOfEmergency::where('user_id', $registrant->id)->update($contactPersonInCaseOfEmergencyDetails);

        // Mail::to($registrant->email)->send(
        //     new SendInformationDetailsToRegistrant($personalInformation)
        // );

        // Mail::to([User::find($areaManagers[0])->email])->send(
        //     new SendNewRegistrantToAdmin($personalInformation)
        // );

        return redirect()->back()->with('success', 'Information has been successfully updated.');
    }

}
