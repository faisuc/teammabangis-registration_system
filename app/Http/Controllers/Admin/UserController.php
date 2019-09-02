<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Rules\UserCanAddProjectManagerRule;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->views['users'] = User::where('id', '!=', auth()->id())
                                        ->whereHas('roles', function ($q) {
                                            $q->where('name', '!=', 'super-admin');
                                        })->paginate(10);

        return view('admin.users.index', $this->views);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->views['roles'] = Role::where('name', '!=', 'super-admin')->get();
        $this->views['projectManagers'] = User::whereHas('roles', function ($q) {
                                                $q->where('name', 'project-manager');
                                            })->get();

        return view('admin.users.create', $this->views);
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3',
            'roles.*' => 'required',
            'project_managers' => ['nullable', 'array', new UserCanAddProjectManagerRule],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], [
            'roles.*.required' => 'A role is required.'
        ]);

        $attributes = $request->only(['email', 'name', 'password']);

        $user = new User;
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->password = bcrypt($attributes['password']);

        if (Gate::allows('verify-user', auth()) && $request->has('verify_user')) {
            $user->email_verified_at = now();
        }

        $user->save();

        $role = Role::whereIn('id', $request->input('roles'))->first();

        $user->assignRole($role);

        if ($request->has('project_managers')) {
            $user->projectManagers()->sync($request->input('project_managers'));
        }

        return redirect()->back()->with('success', 'User has been added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->views['user'] = $user;
        return view('admin.users.show', $this->views);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $this->authorize('update', $user);

        $this->views['user'] = $user;
        $this->views['roles'] = Role::where('name', '!=', 'super-admin')->get();
        $this->views['projectManagers'] = User::whereHas('roles', function ($q) {
                                                $q->where('name', 'project-manager');
                                            })->get();

        return view('admin.users.edit', $this->views);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required|min:3',
            'roles.*' => 'required',
            'project_managers' => ['nullable', 'array', new UserCanAddProjectManagerRule],
            'password' => 'nullable|confirmed'
        ], [
            'roles.*.required' => 'A role is required.'
        ]);

        $attributes = $request->only(['email', 'name', 'password']);

        $user->name = $attributes['name'];
        $user->email = $attributes['email'];

        if ($request->has('password')) {
            $user->password = bcrypt($attributes['password']);
        }

        if (Gate::allows('verify-user', auth()) && $request->has('verify_user')) {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }

        if ($request->has('project_managers')) {
            $user->projectManagers()->sync($request->input('project_managers'));
        } else {
            $user->projectManagers()->detach();
        }

        $user->save();

        $role = Role::whereIn('id', $request->input('roles'))->first();

        $user->syncRoles($role);

        return redirect()->back()->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted.');
    }
}
