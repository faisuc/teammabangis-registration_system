<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\ProjectSite;
use App\Registrant;
use App\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'role:super-admin|admin|area-manager|project-manager'])->group(function () {

    Route::prefix('admin')->namespace('Admin')->group(function () {

        Route::get('/', 'ShowDashboardController')->name('admin.dashboard.index');

        Route::resource('users', 'UserController', [
            'as' => 'admin'
        ])->middleware('can:view,user');

        Route::resource('project-sites', 'ProjectSiteController', [
            'as' => 'admin'
        ])->middleware('can:view,user');

        Route::resource('registrants', 'RegistrantController', [
            'as' => 'admin'
        ])->except([
            'show',
            'update',
            'edit'
        ]);

    });

});

Route::get('/home', 'FormController@index')->name('home');

Route::get('registrants/{reference_code?}/{email?}', 'RegistrantController@show')->name('registrant_information.show');
Route::match(['put', 'patch'], 'registrants/{registrant}', 'RegistrantController@update')->name('registrant_information.update');

Route::get('project-sites/{project_site}/area-managers', function ($project_site) {
    return ProjectSite::findOrFail($project_site)->load('areaManagers');
});

Route::resource('forms', 'FormController');

Route::get('testonly', function () {

    $text = 'ignore everything except this (text) (text2)';
    if( preg_match( '!\(([^\)]+)\)!', $text, $match ) )
    $text = $match[1];
    dd($text);
    exit;

    dd(Request::all('search', 'type', 'name'));

    $collection = collect([
        ['name' => 'Sally'],
        ['school' => 'Arkansas'],
        ['age' => 28]
    ]);

    $flattened = $collection->flatMap(function ($values) {
        return array_map('strtoupper', $values);
    });

    dd($flattened);

    exit;

    dd(getTextInsideBrackets('personal_information[reference_code]'));

    exit;
    $text = '[This] is a [test] string, [eat] my [shorts].';
    preg_match_all("/\[([^\]]*)\]/", $text, $matches);
    dd($matches);

    Registrant::where('email', '123@gmail.com')->delete();

    exit;

    $array = Arr::add(['name' => 'Desk'], 'price', 100);

    dd($array);

    exit;
    dd(collect(['super-admin', 'admin', 'area-manager'])->contains(Role::find(4)->name));
    dd(Role::find(4)->name);

    dd(auth()->user()->roles->pluck('name')->has(['super-admin', 'admin', 'area-manager']));
});