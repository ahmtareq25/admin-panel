<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
    @yield('css_code')
    <style type="text/css">
        .scroll {
            width: 200px;
            height: 400px;
            overflow: scroll;
        }
        .scroll::-webkit-scrollbar {
            width: 10px;
        }

        .scroll::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
        }

        .scroll::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
        }

        /* width */
        ::-webkit-scrollbar {
            width: 15px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
            border-radius: 10px;
        }
    </style>
</head>


<body>

<div class="wrapper">

    @include('admin.includes.sidebar')

    <div class="main-panel">

        @include('admin.includes.nav')


        <div class="content">
            <div class="container-fluid">
                @include('admin.partials.flash')

                @yield('content')


            </div>
        </div>


        @include('admin.includes.foot')
        @include('admin.includes.theme-settings')

    </div>
</div>


</body>
@include('admin.includes.js')
</html>
