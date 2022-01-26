{{--<head>--}}

    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">

    @php
    if (Cookie::get('fav_icon') && fileExist(Cookie::get('fav_icon'))){
        $favIconUrl = getFullUrlFromDbValue(Cookie::get('fav_icon'));
    }else{
        $favIconUrl = url('assets/img/favicon.ico');

    }

        $siteTitle = 'WebHook Admin Panel';
        if (!empty(Cookie::get('site_title'))){
            $siteTitle = Cookie::get('site_title');
        }
    @endphp
    <link rel="icon" type="image/png" href="{{$favIconUrl}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{$siteTitle}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <!-- CSS Files -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/alertify.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0')}} " rel="stylesheet"/>

    <link href="https://unpkg.com/filepond@4.30.3/dist/filepond.css" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet"/>

    @yield('css_code')
{{--</head>--}}
