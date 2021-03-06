<div class="sidebar" data-image="{{asset('assets/img/sidebar-511.jpg')}}" data-color="black">

    <div class="sidebar-wrapper scroll">

        <div class="logo d-block justify-content-center">
{{--            <a href="https://www.creative-tim.com/?_ga=2.147099319.1848398775.1641599794-520301098.1641322474" class="simple-text logo-mini">--}}
{{--                Ct--}}
{{--            </a>--}}

            @php
                $logo = '';
                if (!empty(Cookie::get('logo')) && fileExist(Cookie::get('logo'))){
                    $logo = getFullUrlFromDbValue(Cookie::get('logo'));
                }
                $siteTitle = 'WebHook Admin Panel';
                if (!empty(Cookie::get('logo'))){
                    $siteTitle = Cookie::get('logo');
                }
            @endphp

                @if(empty($logo))
                <a href="{{route('home')}}" class="simple-text logo-text">
                    {{$siteTitle}}
                </a>
                @else
                    <a href="{{route('home')}}" >
                        <img src="{{$logo}}" width="100%">
                    </a>

                @endif

        </div>
        <ul class="nav">
            @php

            $sideBarArr = session()->get('side_bar_array');
            if (empty($sideBarArr)){
                $sideBarArr = [];
            }


            @endphp

            @foreach($sideBarArr as $manu)
                <li class="nav-item">
                    @php

                    $collapseId = 'id-'.str_replace(' ','-', $manu['module_name']);

                    @endphp
                    <a class="nav-link collapsed" data-toggle="collapse" href="#{{$collapseId}}" aria-expanded="false">
                        <i class="nc-icon nc-notes"></i>
                        <p>
                            {{ $manu['module_name'] }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="{{$collapseId}}" style="">
                        <ul class="nav">
                            @foreach($manu['sub_modules'] as $subModule)
                                @php
                                $active = '';
                                if (Route::currentRouteName() == $subModule['route_name']
                                || $subModule['sub_module_id'] == getCurrentRouteSubModuleId(Route::currentRouteName())){
                                $active = 'active';
                                }
                                @endphp
                            <li class="nav-item ml-3  {{$active}}">
                                <a class="nav-link sidebar-link" href="{{Route::has($subModule['route_name']) ? route($subModule['route_name']) : '#'}}">
{{--                                    <span class="sidebar-mini">Rf</span>--}}
                                    <span class="sidebar-normal">{{ $subModule['sub_module_name'] }}</span>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </li>

            @endforeach
        </ul>
    </div>
</div>
