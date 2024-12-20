<form action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}" method="post" enctype="multipart/form-data" id="coursesForm">
    @if(isset($blog))
        @method('put')
    @endif

    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
    </div>
        <div class="modal-body">
            <div class="card card-body">
                <div class="row mt-2">
                    <div class="col-md-6 mt-2 select2-div">
                        <label for="">Category</label>
                        <select name="blog_category_id" required class="form-control select2" data-placeholder="Select a Category" id="discountType">
                            <option value=""></option>
                            @foreach($blogCategories as $blogCategory)
                                <option value="{{ $blogCategory->id }}" {{ $blogCategory->id == $blog->blog_category_id ? 'selected' : '' }} >{{ $blogCategory->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="">{{ $errors->has('blog_category_id') ? $errors->first('blog_category_id') : '' }}</span>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="">Title</label>
                        <input type="text" class="form-control" required name="title" value="{{ $blog->title }}" placeholder="Title" />
                        <span class="text-danger" id="">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="">Sub Title</label>
                        <input type="text" class="form-control" name="sub_title" value="{{ $blog->sub_title }}" placeholder="Sub Title" />
                        <span class="text-danger" id="">{{ $errors->has('sub_title') ? $errors->first('sub_title') : '' }}</span>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="">Video Url</label>
                        <input type="text" class="form-control" name="video_url" value="{{ isset($blog->video_url) ? 'https://youtu.be/'.$blog->video_url : '' }}" placeholder="Video Url" />
                        <span class="text-danger" id="">{{ $errors->has('video_url') ? $errors->first('video_url') : '' }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <textarea name="body" id="ck" placeholder="Blog Content" cols="30" rows="10">{!! $blog->body !!}</textarea>
                        <span class="text-danger" id="">{{ $errors->has('body') ? $errors->first('body') : '' }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4 mt-2">
                         <label for="">Image <span class="text-red">(300 X 200 + WEBP)</span> </label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Image" />
                        <span class="text-danger" id="image">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div>
                            <img src="{{ asset($blog->image) }}" id="imagePreview" alt="" style="height: 150px">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mt-2">
                        <label for="">Banner Image ALT text</label>
                    <input type="text" class="form-control" name="alt_text" value="{{ $blog->alt_text }}" placeholder="Banner Image ALT Text">
                    <span class="text-danger" id="alt_text"></span>

                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="">Banner Image Title</label>
                    <input type="text" class="form-control" name="banner_title" value="{{ $blog->banner_title }}"  placeholder="Banner Image Title">
                    <span class="text-danger" id="banner_title"></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-3 mt-2">
                        <label for="">Featured</label>
                        <div class="material-switch">
                            <input id="someSwitchOptionInfo" name="is_featured" type="checkbox" {{ $blog->is_featured == 0 ? '' : 'checked' }} />
                            <label for="someSwitchOptionInfo" class="label-info"></label>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-2">
                        <label for="">Status</label>
                        <div class="material-switch">
                            <input id="someSwitchOptionWarning" name="status" type="checkbox" {{ $blog->status == 0 ? '' : 'checked' }} />
                            <label for="someSwitchOptionWarning" class="label-info"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary " value="save">Save</button>
    </div>
</form>

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ck',
    {
        fullPage : true,
        uiColor : '#efe8ce'
    });

</script>


