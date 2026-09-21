   {{-- //insert blog content --}}
   <div class="modal fade" id="add_blog_content" data-backdrop="static">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header p-1">
                   <button type="button" class="btn btn-default  ml-auto" data-dismiss="modal3">Close</button>
               </div>
               <div class="modal-title bg-success">
                   <h3 class="text-center"> Insert Blog Content</h3>
               </div>
               <div class="modal-body">
                   <h2 class="text-lg font-medium mr-auto">

                   </h2>
                   <form action="{{ route('store-blog-content') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                       <div class="form-group">
                           <input type="hidden" name="id" value="{{ $blogs->id }}">
                           <label for="title" class="form-label">Title:</label>
                           <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                               data-toggle="modal" data-target="#blog_content_title">Preview
                           </button>
                           <input id="title" name="title" type="text" class="form-control"
                               placeholder="Enter Blog Title" value="{{ old('title') }}">
                           @error('title')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group d-none">
                           <label for="templete_name" class="form-label">Templete Name</label>
                           <input id="templete_name" name="templete_name" type="text" class="form-control"
                               placeholder="Enter templete Title" value="{{ old('templete_name') }}"
                               data-validation='required'>
                           @error('templete_name')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="form-group">
                           <label>Content Design</label>
                           <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                               data-toggle="modal" data-target="#blog_content_design">Preview
                           </button>
                           <select id="content_design" name="content_design" data-placeholder="Select One Item"
                               data-validation='required' class="form-control">
                               <option label="Choose one" selected disabled>Select One</option>
                               <option value="Only Text">Only Text</option>
                               <option value="Left side">Left side</option>
                               <option value="Right side">Right side</option>
                               <option value="Middle">Middle</option>
                               <option value="Top Three">Top Three</option>
                               <option value="Right Three">Right Three</option>
                           </select>
                       </div>

                       <div class="form-group" id="file_type">
                           <label>File Type</label>
                           <select name="file_type" data-placeholder="Select One Item" class="form-control">
                               <option label="Choose one" selected disabled>Select One</option>
                               <option value="Image">Image</option>
                               <option value="Video">Video</option>
                           </select>
                       </div>

                       <div class="form-group" id="image_alt">
                           <label for="image_alt" class="form-label">Image Alt</label>
                           <input name="image_alt" type="text" class="form-control" placeholder="Enter image alt"
                               value="{{ old('image_alt') }}">
                           @error('image_alt')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group" id="file">
                           <label for="file" class="form-label">Image</label>
                           <button type="button" data-toggle="modal" id="preview_img_single"
                               data-target="#blog_content_file" style="float: right; border-radius: 3px;"
                               class="btn-success">Preview</button>

                           <button type="button" data-toggle="modal" id="preview_img_multiple"
                               data-target="#blog_content_file_multiple" style="float: right; border-radius: 3px;"
                               class="btn-success">Preview</button>

                           <button type="button" data-toggle="modal" data-target=".previewRightFirst"
                               style="float: right; border-radius: 3px;"
                               class="btn-success previewRight">Preview</button>
                           <input type="file" name="file" id="inputImg" onchange="blog_prview()"
                               data-validation='required' class="form-control" placeholder="Course Title"
                               value="{{ old('file') }}">
                           @error('file')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group">
                           <span>
                               <img src="" id="imgBlog">
                           </span>
                       </div>

                       <div class="form-group" id="file_other">
                           <label for="file_1" class="form-label">Second Image</label>
                           <button type="button" data-toggle="modal" data-target="#file_1"
                               style="float: right; border-radius: 3px;"
                               class="btn-success previewMulti">Preview</button>

                           <button type="button" data-toggle="modal" data-target=".previewRightSecond"
                               style="float: right; border-radius: 3px;"
                               class="btn-success previewRight">Preview</button>
                           <input type="file" name="file_1" id="inputImg1" onchange="blog_prview_1()"
                               class="form-control" placeholder="Course Title" value="{{ old('file_1') }}">

                       </div>
                       <div class="form-group">
                           <span>
                               <img src="" id="imgBlog1">
                           </span>
                       </div>
                       <div class="form-group" id="file_other_2">
                           <label for="file_2" class="form-label">Third Image</label>
                           <button type="button" data-toggle="modal" data-target="#file_2"
                               style="float: right; border-radius: 3px;"
                               class="btn-success previewMulti">Preview</button>

                           <button type="button" data-toggle="modal" data-target=".previewRightThird"
                               style="float: right; border-radius: 3px;"
                               class="btn-success previewRight">Preview</button>
                           <input type="file" name="file_2" id="inputImg2" onchange="blog_prview_2()"
                               class="form-control" placeholder="Course Title" value="{{ old('file_2') }}">
                       </div>
                       <div class="form-group">
                           <span>
                               <img src="" id="imgBlog2">
                           </span>
                       </div>
                       <div class="form-group">
                           <label for="short_description" class="form-label">Description</label>
                           <button type="button" data-toggle="modal" data-target="#blog_content_description"
                               style="float: right; border-radius: 3px;" class="btn-success">Preview</button>
                           <textarea type="text" name="short_description" data-validation='required'
                               class="textarea form-control" cols="30"
                               rows="4">{{ old('short_description') }}</textarea>
                           @error('short_description')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="form-group">
                           <label for="order" class="form-label">Content Order</label>
                           <input name="order" id="order" type="number" class="form-control"
                               value="{{ old('order') }}" placeholder="Example: 1" data-validation='required'>
                           @error('order')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="form-group">
                           <button class="btn btn-block btn-primary  mt-5">Submit</button>
                       </div>
                   </form>
                   <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
           </div>
       </div> <!-- END: Modal Body -->
   </div>
