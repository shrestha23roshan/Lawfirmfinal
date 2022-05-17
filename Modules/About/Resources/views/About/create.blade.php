@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#aboutAddForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                description: {
                        validators: {
                            notEmpty: {
                                message: 'Description field is required.'
                            },
                        }
                    },
            }
        }).on('blur', '[name="description"]', function(e){
            $('#aboutAddForm').formValidation('revalidateField', 'description');
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
                            $('#aboutAddForm').formValidation('revalidateField', e.sender.name);
                        });
                });
    });
</script>

@endsection 

@section('dynamicdata')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create About</h3>
</div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="aboutAddForm" method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="heading">Title</label>
                <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Title." value="{{ old('heading') }}" >
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea class="form-control" id="description" name="description">{!! old('description') !!}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Photo Attachment *</label>
    
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 600px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-file-pencil"></i> Select photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
                <span>Photo file format should be in jpg, jpeg and png.</span>
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