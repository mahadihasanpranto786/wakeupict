<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Withdrawal
        <small>Withdrawal Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Withdrawal</a></li>
            <li class="active">Withdrawal list</li>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Phone No</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($withdrawal_list) {
                            $Serial = 1;
                            foreach ($withdrawal_list->result() as $row) {
                            ?>
                            <tr>
                                <td><?= $Serial++ ?></td>
                                <td><?=$row->amount?></td>
                                <td><?=$row->method==1 ? 'Bkash' : ($row->method==2 ? 'Cash' :'Rocket')?></span></td>
                                <td><?=$row->number?></td>
                                <td><span ><?=$row->status==0 ? 'Pending' :($row->status==1 ? 'Accept' :'Reject')?></span></td>
                                <td><?=date('d-m-Y',strtotime($row->created_at))?></td>
                            </tr>
                            <?php }
                            } else { }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
</div>
