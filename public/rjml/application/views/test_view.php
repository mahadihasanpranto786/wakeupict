<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-success">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">Test List</h3>
                                </div>
                            </div>
                        </div>

                        <?= alert_check() ?>
                        <section class="content" style="margin-top:20px">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="example" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sl no..</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($list) {
                                                    $serial = 0;
                                                    foreach ($list->result() as $list) {
                                                        $serial++;
                                                ?>
                                                        <tr>
                                                            <td class="align-middle text-center"><?= $serial ?></td>
                                                            <td class="align-middle">
                                                                <?= $list->jr_id ?>
                                                            </td>
                                                            <td class="align-middle">
                                                                <?= $list->jr_rate ?>
                                                            </td>
                                                            <td class="align-middle">
                                                                <?= $list->jr_status ?>
                                                            </td>
                                                            <td width="200px" class="align-middle text-center">
                                                                <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>Welcome/deleteTest?jr_id=<?= $list->jr_id ?>" id="<?= $list->jr_id ?>">
                                                                    <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>Welcome/inactiveTest?jr_id=<?= $list->jr_id ?>" id="<?= $list->jr_id ?>">
                                                                    <button type='button' id="button" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <!-- <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>Welcome/inactiveTest?jr_id=<?= $list->jr_id ?>" id="<?= $list->jr_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a> -->
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
    </section>
</div>
<link src="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('#example').DataTable({
        select: true
    });

    $(document).ready(function() {
        var table = $('#example').DataTable();

        $('#example tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#button').click(function() {
            table.row('.selected').remove().draw(false);
        });
    });
</script>