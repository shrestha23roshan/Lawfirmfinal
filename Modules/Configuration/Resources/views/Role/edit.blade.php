@extends('layouts.backend.containerform') 

@section('footer_js')

<script type="text/javascript">
    $(document).ready(function () {

        $(document).ready(function () {
            $('#roleEditForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    role: {
                        validators: {
                            notEmpty: {
                                message: 'Role Name field is required.'
                            }
                        }
                    }
                },
            });
        });

        $('.check-module').on('change', function (e) {
            if ($(this).is(':checked')) {
                $(this).closest('tr').find('.check').prop('checked', true);
            } else {
                $(this).closest('tr').find('.check').prop('checked', false);
            }
        });

        $('.check').on('change', function (e) {
            var checked = $(this).closest('table').parent().parent().find('.check:checked').length;
            var total = $(this).closest('table').parent().parent().find('.check').length;

            if (checked == 0) {
                $(this).closest('table').parent().parent().find('.check-module').prop('checked', false);
            } else {
                $(this).closest('table').parent().parent().find('.check-module').prop('checked', true);
            }
        });

    });
</script>
@endsection @section('dynamicdata')

<!-- iCheck -->
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">EDIT ROLES</h3>
    </div>
    <div class="box-body">

        <form id="roleEditForm" action="{{ route('admin.privilege.role.update', $role->id) }}" method="post">
            {{-- <input type="hidden" name="_method" value="PUT"> --}}
            <div class="form-group">
                <p class="card-inside-title">Role Name</p>
                <div class="form-line">
                    <input class="form-control form-control-inline input-medium" name="role" size="16" type="text" value="{!! $role->role !!}"
                        placeholder="Enter Role Name" />
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th width="25%">
                            MODULES
                        </th>
                        <th>
                            SUB MODULES
                        </th>
                    </tr>
                </thead>

                <tbody id="tablebody">
                    @foreach($modules as $index=>$module)
                    <tr>
                        <td>
                            <?php $checked = in_array($module->id, $role_modules) ? 'checked="checked"': ''; ?>
                            <input type="checkbox" name="modules[]" class="check-module chk-col-red" value="{{ $module->id }}" {{ $checked }} id="module-{!! $module->id !!}"
                            />
                            <label for="module-{!! $module->id !!}">{{ $module->module_name }}</label>
                        </td>
                        <td>
                            <table class="table">
                                <tbody>
                                    <?php $count = 1; ?> @foreach($module->childrens as $children) @if($count%3 == 1)
                                    <tr>
                                        @endif
                                        <td>
                                            <?php $checked = in_array($children->id, $role_modules) ? 'checked="checked"': ''; ?>
                                            <input type="checkbox" name="modules[]" class="check" value="{{ $children->id }}" id="{{ $children->id }}" {{ $checked }}
                                            />
                                            <label for="{{ $children->id }}">{{ $children->module_name }}</label>
                                        </td>
                                        @if($count%3 == 0 || count($module->childrens) == $count)
                                    </tr>
                                    @endif
                                    <?php $count++; ?> @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="box-footer">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-info waves-effect">
                    <span>Submit
                        <i class="fa fa-check"></i>
                    </span>
                </button>
                <input type="hidden" name="_method" value="PUT" />
            </div>

    </div>
</div>
<!-- #END# Basic Table -->
</form>

{{--
<!-- checkbox -->
<div class="form-group">
    <label>
        <input type="checkbox" class="flat-red" checked>
    </label>
    <label>
        <input type="checkbox" class="flat-red">
    </label>
    <label>
        <input type="checkbox" class="flat-red" disabled> Flat green skin checkbox
    </label>
</div> --}}

<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col (right) -->
</div>
<!-- /.row -->
@stop
