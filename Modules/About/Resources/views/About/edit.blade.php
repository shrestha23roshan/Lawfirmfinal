@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#aboutEditForm').formValidation({
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
            $('#aboutEditForm').formValidation('revalidateField', 'description');
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
                            $('#aboutEditForm').formValidation('revalidateField', e.sender.name);
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
            <h3 class="box-title">Edit About</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="aboutEditForm" method="POST" action="{{ route('admin.about.update', $about->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')
            <div class="form-group">
                <label for="heading">Title </label>
                <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading." value="{{ $about->heading }}" >
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea class="form-control" id="description" name="description">{!! $about->description !!}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Photo Attachment *</label>

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" >
                        @if(file_exists('uploads/about/'.$about->attachment) && $about->attachment != '')
                            <img src="{{ asset('uploads/about/'.$about->attachment) }}" alt="{{ $about->name }}">
                        @else
                            <img src="{{ asset('uploads/about/default-img.jpg') }}" alt="default-image">
                        @endif
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail"
                        style="max-width: 600px; max-height: auto; line-height: 20px;">
                    </div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileupload-new"><i class="fa fa-file-pencil"></i> Change photo</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change photo</span>
                        <input type="file" name="attachment" class="default"/>
                        </span>
                    </div>
                </div>
                <span class="badge bg-red">NOTE!</span>
            </div>

            <div class="clearfix"></div>
    
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                <option value="1" {{ ($about->status == 1) ? 'selected=selected' : '' }}>Published</option>
                <option value="0" {{ ($about->status == 0) ? 'selected=selected' : '' }}>Unpublished</option>
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