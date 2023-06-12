@php
    use Modules\Admins\Entities\AdminMenus;
@endphp
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <span class="brand-logo"><img src="{{ asset($setting_admin['admin-seo-logo']) }}"
                            alt="{{ $setting_admin['admin-seo-copyright'] ?? '' }}"></span>
                    <h2 class="brand-text">{{ $setting_admin['admin-seo-copyright'] ?? '' }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @foreach ($menu_admin as $item)
                @if ($item->type == AdminMenus::TYPE_HEADER && $item->roles_count > 0)
                    <li class=" navigation-header">
                        <span>{{ __($item->name) }}</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ $item->roles_count > 0 ? '#' : $item->route }}">
                            {!! $item->icon !!}
                            <span class="menu-title text-truncate">{{ __($item->name) }}</span>
                        </a>
                        @if ($item->roles_count > 0)
                            <ul class="menu-content">
                                @foreach ($item->roles as $role)
                                    @can($role->route)
                                        <li>
                                            <a class="d-flex align-items-center" href="{{ $role->route }}">
                                                <i class="fa-regular fa-circle"></i>
                                                <span class="menu-item text-truncate">{{ __($role->name) }}</span>
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
