

{{--<div class="row">--}}
    <div class="col-md-12">
        <div class="table-responsive">
            <div id="role-content"><style>
                    .border-remove{
                        border: none;
                    }
                    .border-right-only{
                        border-right: 1px solid #e8e8e8;
                    }
                </style>
                <table class="table table-bordered" id="mainTable">
                    <thead>
                    <tr>
                        <th style="width: 350px">{{__('Module')}}</th>
                        <th style="width: 342px">{{__('Sub Module')}}</th>
                        <th>{{__('Page')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($modules as $module)
                        <tr class="section_{{$module->id}} section">
                            <td style="vertical-align:top">

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="selectedModuleIds[]" value="{{$module->id}}" data-type="module" data-module="{{$module->id}}" type="checkbox" onclick="setAllChecked(this)" class="bulk-action  form-check-input" id="module_{{$module->id}}">
                                        <span class="form-check-sign"></span>
                                        {{$module->name}}
                                    </label>
                                </div>
                            </td>
                            <td colspan="3">
                                <table class="table" style="width:100%;">


                                    <tbody>

                                    @foreach($module->subModules as $subModule)


                                        <tr>
                                            <td style="width:40%;" class="border-remove">

                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input name="selectedSubModuleIds[]" value="{{$subModule->id}}"
                                                               data-type="submodule" data-module="{{$module->id}}"
                                                               type="checkbox" onclick="setAllChecked(this)"
                                                               class="bulk-action module_check_{{$module->id}} count_submodule_{{$module->id}} form-check-input"
                                                               id="submodule_{{$subModule->id}}">
                                                        <span class="form-check-sign"></span>
                                                        {{$subModule->name}}
                                                    </label>
                                                </div>

                                            </td>
                                            <td>
                                                <table class="table" style="width:100%;">

                                                    <tbody>
                                                    @foreach($subModule->pages as $page)
                                                        <tr>

                                                            <td style="width:50%;" class="border-remove">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input name="page_ids[]" value="{{$page->id}}"
                                                                               type="checkbox" onclick="pageChecked(this)"
                                                                               data-module="{{$module->id}}" data-submodule="{{$subModule->id}}"
                                                                               class="bulk-action module_check_{{$module->id}} submodule_check_{{$subModule->id}} count_pages_{{$subModule->id}} form-check-input"
                                                                        {{in_array($page->id, $permitted_pages) ? 'checked' : ''}} >
                                                                        <span class="form-check-sign"></span>
                                                                        {{$page->name}}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </td>

                        </tr>

                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-md-12" id="btn-area">

        <button id="updateRolePageBtn" type="submit" class="btn btn-fill btn-default pull-right">{{__('Update')}}</button>
    </div>
{{--</div>--}}

