@if(session()->has('system_flash_messages'))


    <?php
    $i=0;
    $icons = [
        'success' => 'nc-explore-2',
        'info' => 'nc-bell-55',
        'danger' => 'nc-cctv'
    ]
    ?>

    <div style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">

    @foreach(session()->get('system_flash_messages') as $key => $item)

        <?php
            $top = 20;
        if($i != 0){
            $top = 73*$i;
        }
        ?>


        <div data-notify="container" class="mb-2 col-11 col-sm-4 alert alert-{{$key}} alert-with-icon" role="alert"
             data-notify-position="top-center"  style=" margin: auto;">

            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                <i class="nc-icon nc-simple-remove"></i>
            </button>
            <span data-notify="icon" class="nc-icon {{$icons[$key] ?? 'nc-app'}}"></span>
            <span class="h6" data-notify="title">{!! $item['title'] !!}</span>
            <span data-notify="message">{!! $item['message'] !!}</span>
        </div>

       <?php
           $i++;
           ?>
    @endforeach
    </div>
@endif
