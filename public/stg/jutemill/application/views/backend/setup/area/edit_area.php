<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Area</h3>
                        </div>
                        <form id="add_area" method="POST" action="<?php echo base_url('update_area') ?>">
                            <div class="card-body">
                                <div class="=col-md-12">
                                    <div class="row">
                                        <label>Area Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="<?php if($area) {echo $area->ar_title;} ?>" name="ar_title" id="" placeholder="Area Name" data-validation="length" data-validation-length="min2">
                                    </div>
                                    <div class="row">
                                        <label>Description</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="<?php if($area) {echo $area->ar_description;} ?>" name="ar_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <input type="hidden" class="form-control" value="<?php if($area) {echo $area->ar_id;} ?>" name="ar_id" id="">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>