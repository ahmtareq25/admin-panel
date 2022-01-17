@extends('admin.layouts.main')
@section('content')
    <form action="{{route(config('routename.ROLE_AND_PAGE_ASSOCIATION_UPDATE'))}}" method="post">
        @csrf
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label>{{__('Role Name')}}</label>
                        <select class="form-control" name="role_id" id="company-role" required>
                            <option value="">Please select</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <img id="ajax-loader" style="z-index: 10000; display: none;" class="pull-right mt-2" src="https://localhost/app.sipay.com.tr/admin/ajax-loader.gif" alt="loader">
                    </div>
                </div>
                <div class="col-md-6" id="module-dropdown"><div class="form-group mb-4">
                        <label>{{__('Module Name')}}</label>
                        <select class="form-control" name="module_id" onchange="filterModule(this)" id="module-dropdown">
                            <option value="0">Please select</option>
                            @foreach($modules as $module)
                                <option value="{{$module->id}}">{{$module->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>
            <div class="row permissionArea">
{{--                @include('admin.pages.rolePage.form')--}}
            </div>


        </div>
    </form>


@endsection

@section('js_code')

    <script>
        $(document).on('change', '#company-role', function () {

            var selectedValue = $(this).val();

            if (selectedValue > 0) {
                $('#ajax-loader').show();
                var url = "{{route(config('routename.ROLE_AND_PAGE_ASSOCIATION_UPDATE'))}}/"+selectedValue

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        $('#ajax-loader').hide();
                        $('.permissionArea').html('').html(response.data.content);
                        //$('input[name="selectedpageIds[]"]')
                        $("input[name='page_ids[]']").each(function() {
                            pageChecked(this)
                        });

                    },
                    error: function (xhr, status, error) {
                        $('#ajax-loader').hide();

                    }
                });
            }else{
                $('.permissionArea').html('')
            }

        });

        $(document).ready(function(){
            if($('#company-role').val()!=""){
                $('#company-role').change();
            }
        });

    </script>
    <script>
        function filterModule(elem){
            var module_id  = $(elem).val();
            var rows = $('#mainTable tr.section');
            rows.show();
            if(module_id > 0){
                var section = rows.filter('.section_'+module_id).show();
                rows.not(section).hide();
            }
        }

        function setAllChecked(elem){
            var id = $(elem).val();
            var type = $(elem).data('type');

            if(type == 'module'){
                $('.module_check_'+id).prop('checked',false);
            }else if(type == 'submodule'){
                var module_id = $(elem).data('module');
                $('#module_'+module_id).prop('checked',false);
                $('.submodule_check_'+id).prop('checked',false);
            }

            if($(elem).prop('checked')){
                if(type == 'module'){
                    $('.module_check_'+id).prop('checked',true);
                }else if(type == 'submodule'){
                    var module_id = $(elem).data('module');
                    var allSubmodule = 0
                    var selectedSubmodule = 0;
                    $('.count_submodule_'+module_id).each(function(){
                        allSubmodule++;
                        if($(this).prop('checked')){
                            selectedSubmodule++;
                        }
                    })

                    if(selectedSubmodule== allSubmodule){
                        $('#module_'+module_id).prop('checked',true);
                    }
                    $('.submodule_check_'+id).prop('checked',true);
                }
            }

        }

        function pageChecked(elem){
            var submodule_id = $(elem).data('submodule');
            var module_id = $(elem).data('module');
            var allPages = 0;
            var selectedPages = 0;

            $('.count_pages_'+submodule_id).each(function(){
                allPages++;
                if($(this).prop('checked')){
                    selectedPages++;
                }
            })
            $('#submodule_'+submodule_id).prop('checked',false);
            $('#module_'+module_id).prop('checked',false)
            if($(elem).prop('checked')){
                if(allPages == selectedPages){
                    $('#submodule_'+submodule_id).prop('checked',true);
                }
                var allSubmodule = 0
                var selectedSubmodule = 0;
                $('.count_submodule_'+module_id).each(function(){
                    allSubmodule++;
                    if($(this).prop('checked')){
                        selectedSubmodule++;
                    }
                });
                if(selectedSubmodule == allSubmodule){
                    $('#module_'+module_id).prop('checked',true);
                }
            }
        }
    </script>
@endsection

