@extends('layouts.backend.containerform')

@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#resourcesEditForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                    // title: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Title field is required.'
                    //         }
                    //     }
                    // },
                    // date: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: "Date Field is required."
                    //         }
                    //     }
                    // },
                    description: {
                            validators: {
                                notEmpty: {
                                    message: 'Description field is required.'
                                },
                            }
                        },
               
                    // attachment: {
                    //     validators: {
                    //         file: {
                    //             extension: 'jpg,jpeg,png',
                    //             maxSize: 5242880,   // 5 MB = 5242880 Bytes (in binary)
                    //             message: 'The selected file is not valid or file size greater than 5 MB.'
                    //         }
                    //     }
                    // },
                //     author: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Author field is required.'
                //         }
                //     }
                // },
                }
        })
        .on('blur', '[name="description"]', function(e){
            // $('#resourcesEditForm').formValidation('revalidateField', 'title');
            $('#resourcesEditForm').formValidation('revalidateField', 'description');
        })
        .find('[name="description"]')
                .each(function () {
                    $(this)
                        .ckeditor({
                            allowedContent: true, // for allowing tags
                            // removePlugins: 'sourcearea' // disable source area
                        })
                        .editor
                        .on('change', function (e) {
                            $('#resourcesEditForm').formValidation('revalidateField', e.sender.name);
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
            <h3 class="box-title">Edit Resource</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="resourcesEditForm" method="POST" action="{{ route('admin.resources.update', $resource->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
        @include('layouts.backend.alert')

            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title." value="{{ $resource->title }}" >
            </div>

            <div class="form-group">
                <div class="form-group has-feedback">
                    <label for="date">Date</label>
                <input type="text" class="form-control" name="date" id="datepicker" placeholder="Select date." value="{{ $resource->date}}">
                    <span class="fa fa-calendar form-control-feedback"></span>
                </div>
            </div>
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{!! $resource->description !!}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Photo Attachment *</label>

                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" >
                        @if(file_exists('uploads/resources/'.$resource->attachment) && $resource->attachment != '')
                            <img src="{{ asset('uploads/resources/'.$resource->attachment) }}" alt="{{ $resource->name }}">
                        @else
                            <img src="{{ asset('uploads/resources/default-img.jpg') }}" alt="default-image">
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
              <label for="file">File Attachment</label>
      
              <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" >
                      @if(file_exists('uploads/resources/'.$resource->file) & $resource->file != '')
                      <a href="{!! asset('uploads/resources/'.$resource->file) !!}" target="_blank">{{ $resource->file }}</a>
                      @endif
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail"
                      style="max-width: 600px; max-height: auto; line-height: 20px;">
                  </div>
                  <div>
                      <span class="btn btn-primary btn-file">
                      <span class="fileupload-new"><i class="fa fa-undo"></i> Select file</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      <input type="file" name="file" class="default"/>
                      </span>
                  </div>
              </div>
              <span class="badge bg-red">NOTE!</span>
          </div>
    
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="is_active">
                <option value="1" {{ ($resource->is_active == 1) ? 'selected=selected' : '' }}>Published</option>
                <option value="0" {{ ($resource->is_active == 0) ? 'selected=selected' : '' }}>Unpublished</option>
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