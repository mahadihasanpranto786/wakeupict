<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
            <div class="box-header with-border ">
              <h3 class="box-title">Sales Report</h3>

              
            </div>
                <table  class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Today Total Sales:</th>
                            <th><?=$yesterday_sales?> Tk</th>
                           
                        </tr>
                        <tr>
                            <th>Last 7 days Sales:</th>
                            <th><?=$last_seven_days?> Tk</th>
                        </tr>
                        <tr>
                            <th>Last 30 days Sales:</th>
                            <th><?=$last_thiry_days?> Tk</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
            <div class="box-header with-border ">
              <h3 class="box-title">Withdrawal Report</h3>

              
            </div>
                <table  class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Total Income:</th>
                            <th><?=$last_seven_days?> Tk</th>
                        </tr>
                        <tr>
                            <th>Total Withdrawal:</th>
                            <th><?=$withdrawal?> Tk</th>
                           
                        </tr>
                        <tr>
                            <th>Current Ballance:</th>
                            <th><?=$current_balance?> Tk</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
            
        </div>
    </section>

    <section class="content">
    <div class="box box-info">
    <div class="box-header with-border ">
              <h3 class="box-title">Order Summary</h3>

              
            </div>
    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($list_data) {
                        $Serial = 1;
                        foreach ($list_data->result() as $row) {
                        ?>
                        <tr>
                            <td><?= $Serial++ ?></td>
                            <td><?= $row->i_id + 1000; ?><br>
                                <!-- Faul client wants -->
                                
                            </td>
                            <td>
                                <?= $row->i_createdat; ?>
                            </td>
                            
                            <td>
                                <a href="<?php echo base_url(); ?>vendor/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>
                                View </a>                                
                            </td>
                        </tr>
                        <?php }
                        } else { }
                        ?>
                    </tbody>

                </table>
                    </div>
    </section>


	
<!-- /.content -->
</div>