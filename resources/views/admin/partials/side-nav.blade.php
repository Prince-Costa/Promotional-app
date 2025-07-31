<!-- Sidebar -->
<nav id="sidebarMenu" style="height: 100%; overflow: auto;" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="{{route('admin.dashboard')}}" class="list-group-item list-group-item-action py-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-mdb-ripple-init aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
            </a>

            @can('service.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#serviceCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                    <i class="fa-brands fa-servicestack me-3"></i><span>Service</span></a>
            @endcan
            <div class="collapse {{ request()->is('services*') ? 'show' : '' }}" id="serviceCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('services.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('services.create')}}">Add Serrvice</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('services.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('services.index')}}">Service's</a>
                    </li>
                </ul>
            </div>


            @can('package.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#pricingCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                    <i class="fa-solid fa-money-bill-1 me-3"></i></i><span>Package</span></a>
            @endcan
            <div class="collapse {{ request()->is('packages*') ? 'show' : '' }}" id="pricingCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('packages.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('packages.create')}}">Add Package</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('packages.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('packages.index')}}">Package's</a>
                    </li>
                </ul>
            </div>

{{-- 
            @can('client.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#clientCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                    <i class="fa-solid fa-user-secret me-3"></i><span>Client</span></a>
            @endcan
            <div class="collapse {{ request()->is('clients*') ? 'show' : '' }}" id="clientCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('clients.index')}}">Client's</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('client-review.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('client-review.index')}}">Client Review's</a>
                    </li>
                </ul>
            </div> --}}


            {{-- @can('client.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#portfoCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                    <i class="fa-solid fa-briefcase me-3"></i><span>Portfolio</span></a>
            @endcan
            <div class="collapse {{ request()->is('portfolio_tags*')  || request()->is('portfolio*') ? 'show' : '' }}" id="portfoCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('portfolio_tags.index')}}">Portfolio Tag's</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('portfolio.create') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('portfolio.create')}}">Add Portfolio</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('portfolio.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('portfolio.index')}}">Portfolio's</a>
                    </li>
                </ul>
            </div> --}}


            {{-- @can('staff.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#staffCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                    <i class="fa-solid fa-users-gear me-3"></i><span>Staff</span></a>
            @endcan
            <div class="collapse {{ request()->is('staffs*') ? 'show' : '' }}" id="staffCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('staffs.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('staffs.index')}}">Staff's</a>
                    </li>
                </ul>
            </div> --}}


            {{-- @can('message.view')
               <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#messageCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse">
                <i class="fa-solid fa-envelopes-bulk me-3"></i><span>Message</span></a>
            @endcan
            <div class="collapse {{ request()->is('message*') ? 'show' : '' }}" id="messageCollapse">
                <ul class="card p-3 nav flex-column">
                    <li class="nav-item {{ request()->routeIs('message.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('message.index')}}">Message's</a>
                    </li>
                </ul>
            </div> --}}



            @can('user.view')
            <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#userCollapse" role="button" aria-expanded="false" aria-controls="userCollapse"><i
                    class="fas fa-users fa-fw me-3"></i><span>User</span></a>
            @endcan
            <div class="collapse {{ request()->is('permissions*') || request()->is('roles*') || request()->is('users*') ? 'show' : '' }}" id="userCollapse">
                <ul class="card p-3 nav flex-column">
                    @can('user.view')
                    <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('users.index')}}">User's</a>
                    </li>
                    @endcan
                    @can('role.view')
                    <li class="nav-item {{ request()->is('roles*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('roles.index')}}">Role's</a>
                    </li>
                    @endcan
                    @can('permission.view')
                    <li class="nav-item {{ request()->is('permissions*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('permissions.index')}}">Permission's</a>
                    </li>
                    @endcan
                </ul>
            </div>


            {{-- @can('frontcms.view')
            <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#frontCollapse" role="button" aria-expanded="false" aria-controls="userCollapse">
                <i class="fas fa-eye me-3"></i><span>Front CMS</span></a>
            @endcan
            <div class="collapse {{ request()->is('page*') || request()->is('menu-item*') ? 'show' : '' }}" id="frontCollapse">
                <ul class="card p-3 nav flex-column">
                    @can('frontcms.view')
                    <li class="nav-item {{ request()->routeIs('page.create') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('page.create')}}">Add Page</a>
                    </li>
                    @endcan

                    @can('frontcms.view')
                    <li class="nav-item {{ request()->routeIs('page.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('page.index')}}">Page's</a>
                    </li>
                    @endcan

                    @can('frontcms.view')
                    <li class="nav-item {{ request()->routeIs('menu-item.index') ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{route('menu-item.index')}}">Menu Item's</a>
                    </li>
                    @endcan
                </ul>
            </div> --}}


            @can('setting.view')
                <a class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" href="#settingCollapse" role="button" aria-expanded="false" aria-controls="settingCollapse"><i
                        class="fas fa-gears fa-fw me-3"></i><span>Setting</span></a>
            @endcan
            <div class="collapse {{ request()->is('settings*') || request()->is('ranks*') || request()->is('departments*') ? 'show' : '' }}" id="settingCollapse">
                <ul class="card p-3 nav flex-column">

                        <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('settings.index')}}">App Setting's</a>
                        </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
<!-- Sidebar -->
