<div class="modal fade editBlogContent" id="editBlogContent{{ $blogContent->id }}" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-1">
                <button type="button" class="btn btn-default  ml-auto" data-dismiss="modal3">Close</button>
            </div>
            <div class="modal-title bg-success">
                <h3 class="text-center"> Edit Blog Content</h3>
            </div>
            <div class="modal-body">

                <h2 class="text-lg font-medium mr-auto">

                </h2>
                <form action="{{ route('update-blog-content') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blogContent->id }}">
                    <div class="form-group">
                        <label for="title" class="form-label">Title
                            Name:</label>
                        <button type="button" data-toggle="modal" data-target="#blog_content_title"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter Blog Title"
                            value="{{ $blogContent->title }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group d-none">
                        <label for="templete_name" class="form-label">Templete
                            Name</label>
                        <input id="templete_name" name="templete_name" type="text" class="form-control"
                            placeholder="Enter templete Title" value="{{ $blogContent->templete_name }}">
                        @error('templete_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Content Design</label>
                        <button type="button" data-toggle="modal" data-target="#blog_content_design"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                        <select name="content_design" data-placeholder="Select One Item" data-validation='required'
                            class="form-control content_design_edit">
                            <option label="Choose one" selected disabled>Select One
                            </option>
                            <option value="Only Text"
                                {{ 'Only Text' == $blogContent->content_design ? 'selected' : '' }}>
                                Only Text</option>
                            <option value="Left side"
                                {{ 'Left side' == $blogContent->content_design ? 'selected' : '' }}>
                                Left
                                side
                            </option>
                            <option value="Right side"
                                {{ 'Right side' == $blogContent->content_design ? 'selected' : '' }}>
                                Right side</option>
                            <option value="Middle" {{ 'Middle' == $blogContent->content_design ? 'selected' : '' }}>
                                Middle</option>
                            <option value="Top Three"
                                {{ 'Top Three' == $blogContent->content_design ? 'selected' : '' }}>
                                Top Three</option>
                            <option value="Right Three"
                                {{ 'Right Three' == $blogContent->content_design ? 'selected' : '' }}>
                                Right Three</option>
                        </select>
                    </div>

                    <div class="form-group" id="file_type_edit">
                        <label>File Type</label>
                        <select name="file_type" data-placeholder="Select One Item" class="form-control">
                            <option label="Choose one" selected disabled>Select One
                            </option>
                            <option value="Image" {{ 'Image' == $blogContent->file_type ? 'selected' : '' }}>
                                Image
                            </option>
                            <option value="Video" {{ 'Video' == $blogContent->file_type ? 'selected' : '' }}>
                                Video
                            </option>
                        </select>
                    </div>

                    <div class="form-group" id="image_alt_edit">
                        <label for="image_alt" class="form-label">Image
                            Alt</label>
                        <input name="image_alt" type="text" class="form-control" placeholder="Enter image alt"
                            value="{{ $blogContent->image_alt }}">
                        @error('image_alt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="file_edit">
                        <label for="file" class="form-label">Image</label>
                        <button type="button" data-toggle="modal" id="preview_img_single_edit"
                            data-target="#blog_content_file" style="float: right; border-radius: 3px;"
                            class="btn-success">Preview</button>

                        <button type="button" data-toggle="modal" id="preview_img_multiple_edit"
                            data-target="#blog_content_file_multiple" style="float: right; border-radius: 3px;"
                            class="btn-success">Preview</button>
                        <input type="file" name="file" id="inputImg_edit" onchange="blog_prview_edit()"
                            data-validation='required' class="form-control" placeholder="Course Title"
                            value="{{ $blogContent->file }}">
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="priview_hide">
                        <p id="para">Old Image</p>
                        <img width="250px" name="preview_img" id="preview_img_edit"
                            style=" border: 2px solid gray; padding: 20px;" class="old_img"
                            src="{{ asset($blogContent->file) }}" alt="old image">
                        <span>
                            <img src="" id="imgBlog_edit">
                        </span>
                    </div>

                    <input type="hidden" name="old_img" value="{{ asset($blogContent->file) }}">
                    <input type="hidden" name="old_img_1" value="{{ asset($blogContent->file_1) }}">
                    <input type="hidden" name="old_img_2" value="{{ asset($blogContent->file_2) }}">


                    <div class="form-group" id="file_other_edit">
                        <label for="file_1" class="form-label">Second
                            Image</label>
                        <button type="button" data-toggle="modal" data-target="#file_1"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                        <input type="file" name="file_1" id="inputImg1_edit" onchange="blog_prview_1_edit()"
                            class="form-control" value="{{ $blogContent->file_1 }}">

                    </div>
                    <div class="form-group">
                        <span>
                            <img src="" id="imgBlog1_edit">
                        </span>
                    </div>
                    <div class="form-group" id="file_other_2_edit">
                        <label for="file_2" class="form-label">Third
                            Image</label>
                        <button type="button" data-toggle="modal" data-target="#file_2"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                        <input type="file" name="file_2" id="inputImg2_edit" onchange="blog_prview_2_edit()"
                            class="form-control" value="{{ $blogContent->file_2 }}">
                    </div>
                    <div class="form-group">
                        <span>
                            <img src="" id="imgBlog2_edit">
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="short_description" class="form-label">Description</label>
                        <button type="button" data-toggle="modal" data-target="#blog_content_description"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                        <textarea type="text" name="short_description" data-validation='required'
                            class="textarea form-control" cols="30"
                            rows="4">{{ $blogContent->short_description }}</textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="order" class="form-label">Content
                            Order</label>
                        <input name="order" id="order" type="number" class="form-control" placeholder="Example: 1"
                            data-validation='required' value="{{ $blogContent->order }}">

                        @error('order')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary  mt-5">Update</button>
                    </div>

                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div> <!-- END: Modal Body -->
</div>
