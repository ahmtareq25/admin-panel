<div class="sidebar" data-image="{{asset('assets/img/sidebar-5.jpg')}}">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav">
            @php

            $sideBarArr = session()->get('side_bar_array');


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
                            <li class="nav-item ">
                                <a class="nav-link" href="{{Route::has($subModule['route_name']) ? route($subModule['route_name']) : '#'}}">
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
