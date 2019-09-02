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

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->views['personalInformation'] = config('registration-system.registrants.forms.personal_information');
        $this->views['spouseInformation'] = config('registration-system.registrants.forms.spouse_information');
        $this->views['contactPersonInformation'] = config('registration-system.registrants.forms.contact_person_in_case_of_emergency');

        return view('home', $this->views);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $personalInformationDetails = Arr::except($request->input('personal_information'), ['project_sites', 'area_managers']);
        $spouseInformationDetails = $request->input('spouse_information');
        $contactPersonInCaseOfEmergencyDetails = $request->input('contact_person_in_case_of_emergency');

        $projectSites = $request->input('personal_information.project_sites');
        $areaManagers = $request->input('personal_information.area_managers');
        $personalInformationEmail = $request->input('personal_information.email');
        $personalInformationFirstName = $request->input('personal_information.first_name');
        $personalInformationLastName = $request->input('personal_information.last_name');

        // Create new user

        $registrant = new Registrant;
        $registrant->name = $personalInformationFirstName . ' ' . $personalInformationLastName;
        $registrant->email = $personalInformationEmail;
        $registrant->password = bcrypt(Str::random(rand(40, 80)));
        $registrant->save();

        $registrant->projectSites()->attach($projectSites);
        $registrant->areaManagers()->attach($areaManagers);

        $registrant->assignRole($registrantRole);

        $personalInformation = PersonalInformation::create($personalInformationDetails + ['user_id' => $registrant->id]);
        $spouseInformation = SpouseInformation::create($spouseInformationDetails + ['user_id' => $registrant->id]);
        $contactPersonInCaseOfEmergency = ContactPersonInCaseOfEmergency::create($contactPersonInCaseOfEmergencyDetails + ['user_id' => $registrant->id]);

        Mail::to($registrant->email)->send(
            new SendInformationDetailsToRegistrant($personalInformation)
        );

        Mail::to([User::find($areaManagers[0])->email])->send(
            new SendNewRegistrantToAdmin($personalInformation)
        );

        return redirect()->back()->with('success', 'Information has been successfully sent.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
