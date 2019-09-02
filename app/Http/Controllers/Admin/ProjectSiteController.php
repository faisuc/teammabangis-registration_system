<?php

namespace App\Http\Controllers\Admin;

use App\ProjectSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProjectSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->views['projectSites'] = ProjectSite::latest()->paginate(10);
        return view('admin.project_sites.index', $this->views);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->views['areaManagers'] = User::whereHas('roles', function ($q) {
                                            $q->where('name', 'area-manager');
                                        })->get();

        return view('admin.project_sites.create', $this->views);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable'
        ]);

        $projectSite = new ProjectSite;
        $projectSite->name = $request->input('name');
        $projectSite->description = $request->input('description');
        $projectSite->save();

        if ($request->has('area_managers')) {
            $projectSite->areaManagers()->attach($request->input('area_managers'));
        }

        return redirect()->back()->with('success', 'Project site has been created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectSite  $projectSite
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSite $projectSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectSite  $projectSite
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectSite $projectSite)
    {
        $this->views['projectSite'] = $projectSite;
        $this->views['areaManagers'] = User::whereHas('roles', function ($q) {
                                            $q->where('name', 'area-manager');
                                        })->get();

        return view('admin.project_sites.edit', $this->views);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectSite  $projectSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectSite $projectSite)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable'
        ]);

        $projectSite->name = $request->input('name');
        $projectSite->description = $request->input('description');
        $projectSite->save();

        if ($request->has('area_managers')) {
            $projectSite->areaManagers()->sync($request->input('area_managers'));
        } else {
            $projectSite->areaManagers()->detach();
        }

        return redirect()->back()->with('success', 'Project site has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectSite  $projectSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectSite $projectSite)
    {
        $projectSite->delete();

        return redirect()->back()->with('success', 'Project site has been deleted.');
    }
}
