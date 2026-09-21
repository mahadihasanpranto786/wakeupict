<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Withdrawal
        <small>Withdrawal Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Withdrawal</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <!-- /.box -->
    <section class="content">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="<?php echo base_url('vendor/withdrawal_store') ?>" enctype="multipart/form-data">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="inputEmail3" class=" control-label">Amount</label>
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Amount" name="amount" data-validation="required length number" data-validation-length="max8" data-validation-allowing="range[1;999999999],float">
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class=" control-label">Bkash/Rocket No:</label>
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Bkash/Rocket No" name="number"  data-validation="length" data-validation-length="max20">
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class=" control-label">Type</label>
                              <select class="form-control" name="method" data-validation="required ">
                                <option value="">--Select--</option>
                                <option value="1">Bkash</option>
                                <option value="2">Cash</option>
                                <option value="3">Rocket</option>
                              </select>
                          </div>
                          
                          <div class="col-sm-offset-2">
                            <button type="submit" class="btn btn-success">Submit</button> 
                          </div>
                      </div>
                      
                      
                      
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
</div>