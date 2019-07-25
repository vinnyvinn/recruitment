<nav class="col-md-2 sidebar">
   
    <div class="sidebar-sticky pt-5 pb-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>@lang('app.dashboard')</span>
                </a>
            </li>

            @permission('users.manage')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user*') ? 'active' : ''  }}" href="{{ route('user.list') }}">
                    <i class="fas fa-users"></i>
                    <span>@lang('app.users')</span>
                </a>
            </li>
            @endpermission

            @permission('users.activity')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('activity*') ? 'active' : ''  }}" href="{{ route('activity.index') }}">
                    <i class="fas fa-server"></i>
                    <span>@lang('app.activity_log')</span>
                </a>
            </li>
            @endpermission

            @permission(['candidate.manage', 'jobmanagement.manage'])
            <li class="nav-item">
                <a href="#jobmanagement-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is('candidate*') || Request::is('jobmanagement*') ? 'true' : 'false' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Management</span>
                </a>
                <ul class="{{ Request::is('skill*') || Request::is('applicants*') || Request::is('designation*') || Request::is('jobs*') || Request::is('department*') ? '' : 'collapse' }} list-unstyled sub-menu" id="jobmanagement-dropdown">
                    @permission('skills.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('skill*') ? 'active' : '' }}"
                           href="{{ route('skills.index') }}">Skills</a>
                    </li>
                    @endpermission
                    @permission('department.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('department*') ? 'active' : '' }}"
                           href="{{ route('departments.index') }}">Departments</a>
                    </li>
                    @endpermission
                    @permission('designation.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('designation*') ? 'active' : '' }}"
                           href="{{ route('designations.index') }}">Designations</a>
                    </li>
                    @endpermission
                    
                    @permission('jobs.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('jobs*') ? 'active' : '' }}"
                           href="{{ route('jobs.index') }}">Job Vacancies</a>
                    </li>
                    @endpermission
                    @permission('jobs.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('applicants*') ? 'active' : '' }}" href="{{ route('view.applicants') }}"> View Applicants</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission(['roles.manage', 'permissions.manage'])
            <li class="nav-item">
                <a href="#roles-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is('role*') || Request::is('permission*') ? 'true' : 'false' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>@lang('app.roles_and_permissions')</span>
                </a>
                <ul class="{{ Request::is('role*') || Request::is('permission*') ? '' : 'collapse' }} list-unstyled sub-menu" id="roles-dropdown">
                    @permission('roles.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('role*') ? 'active' : '' }}"
                           href="{{ route('role.index') }}">@lang('app.roles')</a>
                    </li>
                    @endpermission
                    @permission('permissions.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('permission*') ? 'active' : '' }}"
                           href="{{ route('permission.index') }}">@lang('app.permissions')</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
            <li class="nav-item">
                <a href="#settings-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}">
                    <i class="fas fa-cogs"></i>
                    <span>@lang('app.settings')</span>
                </a>
                <ul class="{{ Request::is('settings*') ? '' : 'collapse' }} list-unstyled sub-menu"
                    id="settings-dropdown">

                    @permission('settings.general')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings') ? 'active' : ''  }}"
                           href="{{ route('settings.general') }}">
                            @lang('app.general')
                        </a>
                    </li>
                    @endpermission

                    @permission('settings.auth')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/auth*') ? 'active' : ''  }}"
                           href="{{ route('settings.auth') }}">@lang('app.auth_and_registration')</a>
                    </li>
                    @endpermission

                    @permission('settings.notifications')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/notifications*') ? 'active' : ''  }}"
                           href="{{ route('settings.notifications') }}">@lang('app.notifications')</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul>
    </div>
</nav>

