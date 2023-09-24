<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @foreach ($menu as $section)
                @if (count($section['roles'])>1)
                    <li class="nav-item start ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="{{ $section['image'] }}"></i>
                            <span class="title">{{ $section['name'] }}</span>
                            <span class="selected"></span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @foreach ($section['roles'] as $role)
                                <li class="nav-item start {{$role['class']}}">
                                    <a href="{{ route($role['route']) }}" class="nav-link ">
                                        <i class="{{ $role['image'] }}"></i>
                                        <span class="title">{{ $role['title'] }}</span>
                                        {{-- <span class="selected"></span> --}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item {{$section['roles'][0]['class'] }}">
                        <a href="{{ route($section['roles'][0]['route']) }}" class="nav-link nav-toggle">
                            <i class="{{ $section['roles'][0]['image'] }}"></i>
                            <span class="title">{{ $section['roles'][0]['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>