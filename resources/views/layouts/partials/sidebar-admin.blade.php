<div class="list-group">
    <a href="{{ route('admin.dashboard.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/dashboard') || request()->is('admin')) ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('admin.registrants.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/registrants/*') || request()->is('admin/registrants')) ? 'active' : '' }}">Registrants</a>
    @can('view', ProjectSite::class)
        <a href="{{ route('admin.project-sites.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/project-sites/*') || request()->is('admin/project-sites')) ? 'active' : '' }}">Project Sites</a>
    @endcan
    @can('viewAny', auth())
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/users') || request()->is('admin/users/*/edit')) ? 'active' : '' }}">
            Users
        </a>
    @endcan
    <a href="{{ route('admin.users.show', ['user' => Auth::user()]) }}" class="list-group-item list-group-item-action {{ \Route::current()->getName() == 'admin.users.show' ? 'active' : '' }}">My Profile</a>
</div>