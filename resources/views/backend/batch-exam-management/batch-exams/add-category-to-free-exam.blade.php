<div class="row">
    <div class="col-md-6">
        <div class="card card-body">
            <h4>Title: <span id="sectionContentTitle">{{ $exam->title }}</span></h4>
        </div>
    </div>
</div>
<form action="{{ route('category-for-assign-video') }}" method="post" id="" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="exam">
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    <div class="position-relative" id="">
        <div class="row mt-3 mb-3">
            <div class="col-md-5 select2-div">
                <label for="">Assign Catgeory</label>
                <input type="text" class="form-control" id="categoryInputField">
                <input type="hidden" class="form-control" name="category_id" id="category_id">
            </div>
            <div class="col-md-5 select2-div">
                <label for="">Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail" id="thumbnail">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-5 check-topics">Apply</button>
            </div>

        </div>
    </div>
</form>


<div class="modal fade" id="categoryModal" data-bs-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Select Category</h1>
                <button type="button" class="btn-close close-category-modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="" id="">
                    @foreach($categories as $key => $category)
                        <div class="parent-div">
                            <div class="card card-body bg-transparent shadow-0 mb-2 p-1">
                                <ul class="nav mb-0">
                                    <li><label class="mb-0 f-s-15 ms-2"><input type="checkbox" class="check" value="{{ $category->id }}">{{ $category->name }}</label></li>
                                </ul>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-category-modal" >Close</button>
                <button type="button" class="btn btn-primary" id="done">Save</button>
            </div>
        </div>
    </div>
</div>
