<style>
    .new__custom__pagination {
        display: inline;
        margin-top: 20px;
    }

    .pagination_ci_custom li {
        display: inline;
    }

    .pagination_ci_custom li a {
        border: 1px solid #00c0ef;
        padding: 15px 20px;
    }

    .pagination_ci_custom a.active {
        background-color: #00c0ef;
        color: #fff;
    }

    .small-box:hover {
        color: #000;
    }
</style>


<?php
function numberTowords($num)
{

    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    ); /*limit t quadrillion */
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}
extract($_POST);
if (isset($convert)) {
    echo "<p align='center' style='color:blue'>" . numberTowords("$num") . "</p>";
}
?>


<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Product List
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
            <li class="active">Product List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <div class="row">
                    <form id="cat_main" method="POST" action="<?php echo base_url('backend/Report/genarate_sales_report') ?>">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">From</label>
                                <input required type="date" name="f_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">To</label>
                                <input required type="date" name="t_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-3">




                        </div>

                        <div class="col-md-3">
                            <button id="submit_button" type="submit" class="btn btn-primary a_x">Search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php if ($this->session->userdata('invoiceCount')) {
                                        echo $this->session->userdata('invoiceCount');
                                    } else {
                                        echo 0;
                                    }
                                    ?></h3>

                                <p>Total Number of Sell Invoice</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= (int)$this->session->userdata('invoiceCastSum')
                                    ?>
                                </h3>

                                <p>Total Sell Amount</p>
                                <p> <?php if ((int)$this->session->userdata('invoiceCastSum') != "0") {
                                        echo  strtolower(numberTowords((int)$this->session->userdata('invoiceCastSum')));
                                    }
                                    ?> BDT</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                if ($this->session->userdata('first_date') && $this->session->userdata('end_date')) {
                                ?>
                                    <h3>
                                        Sell Report Between

                                    </h3>

                                    <p>
                                        <?= date_tine_formater(date('Y-m-d H:i', strtotime('+6 hours', strtotime($this->session->userdata('first_date')))));
                                        ?>
                                        To
                                        <?= date_tine_formater(date('Y-m-d H:i', strtotime('+6 hours', strtotime($this->session->userdata('end_date')))));
                                        ?>
                                    </p>
                                <?php } else {
                                ?>
                                    <h3>
                                        Full Sells Report Until Now

                                    </h3>

                                    <p>
                                        Start From End
                                    </p>
                                <?php
                                }

                                ?>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th class="text-center">Customer Information</th>
                            <th>Total Cost</th>
                            <th>Profit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i_totalcost = 0;
                        $total_income = 0;
                        if ($report_data) {
                            $serial;
                            foreach ($report_data->result() as $row) {
                        ?>
                                <tr>
                                    <td><?= $serial++ ?></td>
                                    <td><?= $row->i_id + 1000; ?>
                                    </td>
                                    <td>
                                        <?= $row->i_createdat; ?>

                                    </td>
                                    <td>
                                        <table class="table">
                                            <tbody class="table  table-striped">
                                                <tr>
                                                    <td><?= $row->i_name; ?></td>
                                                    <td><?= $row->i_address; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $row->i_mobile; ?></td>
                                                    <td><?= $row->i_thana; ?></td>
                                                    <td><?= $row->i_district; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td><?= $row->i_totalcost; ?></td>
                                    <td><?= $row->i_total_profit; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>">
                                            View </a>

                                    </td>
                                </tr>

                            <?php

                                $i_totalcost += $row->i_totalcost;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-center text-danger">
                                    No data Found
                                </td>
                            </tr>
                        <?php  }
                        ?>

                    </tbody>

                </table>
                <input type="hidden" id="valRes" value="<?php if (isset($report_data->result_id->num_rows)) {
                                                            echo $report_data->result_id->num_rows;
                                                        } else {
                                                            echo 0;
                                                        } ?>">
                <div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
                    <?= $this->pagination->create_links() ?><br>
                    <span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?> Result</span>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>
<!-- /.content-wrapper -->

<style>
    .a_x {

        margin-top: 24px;

    }
</style>
<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        var valRes = $("#valRes").val()
        $("#showingRow").text(valRes)
    })
</script>