<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<body>

<div class="wrapper">

    @include('admin.includes.sidebar')

    <div class="main-panel">

        @include('admin.includes.nav')


        <div class="content">
            <div class="container-fluid">

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
