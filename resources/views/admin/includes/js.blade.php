<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('assets/js/plugins/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>

<script src="{{asset('assets/js/plugins/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/alertify.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>


<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0')}} " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        // demo.initDashboardPageCharts();



        //sidebar managing
        var moduleLi = $('.nav-item').find('.active').parents('li');
        moduleLi.addClass('active');
        moduleLi.children('div').addClass('show')


    });
    $('.selectpicker').selectpicker();


    // prevent duplicate click on form submission
    $('form.preventOnSubmit').submit(function() {
        $(this).find('.disableOnClick').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        console.log("clicked on submit button");
    });


    function deleteAction(formName) {
        alertify.confirm("{{ __('Are you sure?')}}", function () {
            $('#' + formName).submit();
        }, function (event) {
            event.preventDefault();
        });
        $('button.cancel').addClass('btn btn-light').text("{{ __('Cancel')}}");
        $('button.ok').addClass('btn btn-danger').text("{{ __('Yes')}}");
    }

    // $('.sidebar-link').on('click', function (e) {
    //     e.preventDefault();
    //     var url = $(this).attr('href');
    //
    //     $.ajax({
    //         type: 'GET', //THIS NEEDS TO BE GET
    //         url: url,
    //         success: function (response) {
    //             window.history.pushState("object or string", "Title", url);
    //             $('.gap').html(response.data.view)
    //
    //               //// For replace with previous one
    //         },
    //         error: function() {
    //             console.log(data);
    //         }
    //     });
    // })
</script>

@yield('js_code')
