@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#servicesEditForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                // heading: {
                //         validators: {
                //             notEmpty: {
                //                 message: 'Heading field is required.'
                //             }
                //         }
                //     },
                    description: {
                            validators: {
                                notEmpty: {
                                    message: 'Description field is required.'
                                },
                            }
                        },
                }
        }).on('blur', '[name="description"]', function(e){
            // $('#servicesEditForm').formValidation('revalidateField', 'name');
            $('#servicesEditForm').formValidation('revalidateField', 'description');
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
                            $('#servicesEditForm').formValidation('revalidateField', e.sender.name);
                        });
                });
    });
</script>

<script>
    $("#file-upload").change(function(){
        $("#file-name").text(this.files[0].name);
    });
</script>
@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
            <h3 class="box-title">Edit Service</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="servicesEditForm" method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')
            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading." value="{{ $service->heading }}" >
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea class="form-control" id="description" name="description">{!! $service->description !!}</textarea>
            </div>
    
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                <option value="1" {{ ($service->status == 1) ? 'selected=selected' : '' }}>Published</option>
                <option value="0" {{ ($service->status == 0) ? 'selected=selected' : '' }}>Unpublished</option>
                </select>
            </div>
    
            </div>
            
    
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="_method" value="PUT">

    </form>
</div>

@endsection