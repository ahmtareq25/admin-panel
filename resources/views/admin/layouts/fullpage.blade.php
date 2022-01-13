<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body>

<div class="wrapper wrapper-full-page">

    <div class="full-page  section-image" data-color="black" data-image="{{asset('assets/img/loginBG2.jpg')}}" ;="">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <div class="full-page-background" style="background-image: url('{{asset('assets/img/loginBG2.jpg')}}') "></div></div>
    @include('admin.includes.foot')
</div>

@include('admin.includes.js')


<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();

        // setTimeout(function() {
        //     // after 1000 ms we add the class animated to the login/register card
        //     $('.card').removeClass('card-hidden');
        // }, 700)
    });
</script>
</html>
