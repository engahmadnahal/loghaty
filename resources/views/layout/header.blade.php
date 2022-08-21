<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                   
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-{{App::isLocale('ar') == 'ar' ? 'ae' : 'us'}}"></i>
                        <span class="selected-language">{{App::isLocale('ar') == 'ar'  ? 'العربية' : 'English'}}</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            @foreach (Locales::$lang as $keyLang => $lang)
                                <a class="dropdown-item"  data-language="{{$keyLang}}" onclick="performSetLocale('{{$keyLang}}')">
                                    <i class="flag-icon flag-icon-{{$lang['flag']}}"></i> {{$lang['name']}}</a>
                            
                            @endforeach
                          
                               
                        </div>
                    </li>
                    
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                            <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                        <i class="ficon feather icon-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge badge-pill badge-primary badge-up">{{auth()->user()->unreadNotifications->count()}}</span>
                        @endif
                    </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <span class="notification-title">{{__('dash.my_notification')}}</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">{{__('dash.view_all_notification')}}</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{auth()->user()->name}}</span><span class="user-status">{{__('dash.available')}}</span></div><span>
                                <img class="round" src="{{auth()->user()->image_profile}}" alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{route('admins.show',auth()->user()->id)}}"><i class="feather icon-user"></i> {{__('dash.edit_profile')}}</a><a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> {{__('dash.my_notification')}}</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{route('auth.logout')}}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="feather icon-power"></i> {{__('dash.logout')}}</button>
                            </form>
                        
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
