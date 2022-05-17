@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#servicesAddForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                // heading: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Heading field is required.'
                //         },
                //     }
                // },  
                description: {
                        validators: {
                            notEmpty: {
                                message: 'Description field is required.'
                            },
                        }
                    },
            }
        }).on('blur', '[name="description"]', function(e){
            // $('#servicesAddForm').formValidation('revalidateField', 'heading');
            $('#servicesAddForm').formValidation('revalidateField', 'description');
        })
        .find('[name="description"]')
                .each(function () {
                    $(this)
                        .ckeditor({
                            allowedContent: true,
                            // removePlugins: 'sourcearea' // disable source area
                        })
                        .editor
                        .on('change', function (e) {
                            $('#servicesAddForm').formValidation('revalidateField', e.sender.name);
                        });
                });
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Service</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="servicesAddForm" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="heading">Heading </label>
                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter heading." value="{{ old('heading') }}" >
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea class="form-control" id="description" name="description">{!! old('description') !!}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                <option value="1">Published</option>
                <option value="0">Unpublished</option>
                </select>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection