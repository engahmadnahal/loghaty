

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('home.index')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">{{__('dash.app_name')}}</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#"><i class="fa-solid fa-house"></i></i><span class="menu-title" data-i18n="{{__('dash.home')}}">{{__('dash.home')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('home.index')}}"><a href="{{route('home.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">{{__('dash.anlytics')}}</span></a>
                    </li>
                    
                </ul>
            </li>


           
            <!-- BEGIN: Content Manger -->
            
            <li class=" navigation-header"><span>{{__('dash.content_manger')}}</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa-solid fa-chart-simple"></i><span class="menu-title" data-i18n="{{__('dash.levels')}}">{{__('dash.levels')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('levels.index')}}"><a  href="{{route('levels.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('levels.create')}}"><a  href="{{route('levels.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-book"></i><span class="menu-title" data-i18n="{{__('dash.games')}}">{{__('dash.games')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('games.index')}}"><a  href="{{route('games.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('games.create')}}"><a  href="{{route('games.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-pen-to-square"></i><span class="menu-title" data-i18n="{{__('dash.quesstion')}}">{{__('dash.quesstion')}}</span></a>
                <ul class="menu-content">
                    @foreach (QusstionType::$qs as $route => $name)
                        <li class="{{ActiveRoute::isActive($route.'.index')}}"><a  href="{{route($route.'.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__($name)}}">{{__($name)}}</span></a>
                        </li>
                    @endforeach
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-graduation-cap"></i><span class="menu-title" data-i18n="{{__('dash.classes')}}">{{__('dash.classes')}}</span></a>
                <ul class="menu-content">
                    
                    <li class="{{ActiveRoute::isActive('classes.index')}}"><a  href="{{route('classes.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('classes.create')}}"><a  href="{{route('classes.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>
            <!-- END: Content Manger -->


            <!-- BEGIN: HR -->
            <li class=" navigation-header"><span>{{__('dash.hr')}}</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa-solid fa-user"></i><span class="menu-title" data-i18n="{{__('dash.admins')}}">{{__('dash.admins')}}</span></a>
                <ul class="menu-content">
                    <li lass="{{ActiveRoute::isActive('admins.index')}}"><a c href="{{route('admins.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('admins.create')}}"><a  href="{{route('admins.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-person-chalkboard"></i></i><span class="menu-title" data-i18n="{{__('dash.teachers')}}">{{__('dash.teachers')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('teachers.index')}}"><a  href="{{route('teachers.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('teachers.create')}}"><a  href="{{route('teachers.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-people-roof"></i><span class="menu-title" data-i18n="{{__('dash.parents')}}">{{__('dash.parents')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('fathers.index')}}"><a  href="{{route('fathers.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('fathers.create')}}"><a  href="{{route('fathers.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-children"></i></i><span class="menu-title" data-i18n="{{__('dash.childrens')}}">{{__('dash.childrens')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('childrens.index')}}" ><a href="{{route('childrens.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('childrens.create')}}"><a  href="{{route('childrens.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>


            <!-- BEGIN: Plans -->
            
            <li class=" navigation-header"><span>{{__('dash.plan_subscrip')}}</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa-solid fa-dollar-sign"></i><span class="menu-title" data-i18n="{{__('dash.plan')}}">{{__('dash.plan')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('plans.index')}}" ><a href="{{route('plans.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('plans.create')}}"><a  href="{{route('plans.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-user-tie"></i><span class="menu-title" data-i18n="{{__('dash.subscripers')}}">{{__('dash.subscripers')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('subscriptions.index')}}"><a  href="{{route('subscriptions.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('subscriptions.create')}}"><a  href="{{route('subscriptions.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>
            <!-- END: Plans -->

            <!-- BEGIN: Settings -->
            
            <li class=" navigation-header"><span>{{__('dash.settings')}}</span>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-city"></i><span class="menu-title" data-i18n="{{__('dash.countries')}}">{{__('dash.countries')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('countries.index')}}"><a  href="{{route('countries.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('countries.create')}}"><a  href="{{route('countries.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-pencil"></i><span class="menu-title" data-i18n="{{__('dash.articals')}}">{{__('dash.articals')}}</span></a>
                <ul class="menu-content">
                    <li class="{{ActiveRoute::isActive('articals.index')}}"><a  href="{{route('articals.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.list')}}">{{__('dash.list')}}</span></a>
                    </li>
                    <li class="{{ActiveRoute::isActive('articals.create')}}" ><a href="{{route('articals.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.create')}}">{{__('dash.create')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>



            <li class=" nav-item"><a href="#"><i class="fa-solid fa-gears"></i><span class="menu-title" data-i18n="{{__('dash.role_permission')}}">{{__('dash.role_permission')}}</span></a>
                <ul class="menu-content">
                    <li><a href="app-user-list.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.role')}}">{{__('dash.role')}}</span></a>
                    </li>
                    <li><a href="app-user-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="{{__('dash.permission')}}">{{__('dash.permission')}}</span></a>
                    </li>
                    </li>
                </ul>
            </li>

            <!-- END: Settings -->

        </ul>
    </div>
</div>