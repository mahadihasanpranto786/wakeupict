<?php

require 'config.php';
$today = date("Y-m-d");


$sql = "SELECT members.name as name,members.designation as designation, members.start_time as start_time, members.end_time as end_time,attandence.date_time_mod as t,attandence.status as s, attandence.id as att_id, attandence.remarks as r
FROM members
INNER JOIN attandence ON attandence.member_id=members.id
WHERE date_time= '$today' ORDER BY attandence.id DESC";


$result = $conn->query($sql);

// print_r($result->fetch_assoc()['s']);

?>
<?php require './header.php' ?>
<div class="row mb-5 mobile__login__layout" id="computed_props">
    <div class="col-md-3 border border-primary pt-4 shadow-lg p-3 bg-white rounded sticky-top">
        <form action="system.php" method="post" class="">
            <div class="form-group">
                <label for="">Your Mobile Number</label>
                <input v-model="mobile" type="text" class="form-control" name="mobile" id="" placeholder="Your Mobile Number">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input v-model="password" type="password" class="form-control" name="password" id="" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select class="form-control select2bs4" name="status" required>
                    <option value="" selected disabled>Select Status</option>
                    <option value="Enter">Enter</option>
                    <option value="Leave">Leave</option>
                    <option value="Break Start">Break Start</option>
                    <option value="Break End">Break End</option>
                    <option value="Coffee">Coffee</option>
                    <option value="Tea">Tea</option>
                    <option value="Just Login">Login</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Remarks</label>
                <input type="text" class="form-control" name="remarks" id="" placeholder="Remarks">
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <br>
        <?php
        if (empty($_SESSION['isLogin'])) {
        } else {
        ?>
            <form action="./logout.php">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        <?php
        }

        ?>


        <br>
        <div class="alert__message">
            <?php
            if (empty($_SESSION['msg'])) {
            ?>

            <?php
            } else {
            ?>
                <div class=" <?= $_SESSION['style']; ?>" role="alert">
                    <?= $_SESSION['msg']; ?>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
    <div class="col-md-9 overflow-auto information__table" style="height: 80vh;">
        <table class="table table-striped py-5">
            <tr>
                <th class="w-20">Employee Name</th>
                <th class="m_designation">Designation</th>
                <th class="m_date_time">Date Time</th>
                <th>Status</th>
                <th class="m_remark">Remarks</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $startOfficeTime = $row["start_time"];
                    $endOfficeTime = $row["end_time"];
                    $showingstartOfficeTime = date('h:i a ', strtotime($startOfficeTime));
                    $showingendOfficeTime = date('h:i a ', strtotime($endOfficeTime));
                    $timingToday = $row["t"];
                    $showingTimeToday = date('h:i:s a m/d/Y', strtotime($timingToday));

                    $entryTime = date('H:i', strtotime($timingToday));
                    if ($row["s"] == 'Enter') {

                        if ($startOfficeTime >= $entryTime) {
                            $x = 'bg-success text-white';
                        } else {
                            $x = 'bg-danger text-white';
                        }
                    } else {
                        $x = '';
                    }
                    if ($row["s"] == '000') {
                        $x = 'bg-warning';
                    }
                    if ($row["name"] == 'Sajib Sarker' && $row["s"] == 'Just Login') {
                        $x = 'd-none';
                    }

            ?>
                    <tr class="<?= $x ?>">
                        <td> <?= $row["name"]; ?> </td>
                        <td class="m_designation"> <?= $row["designation"]; ?></td>
                        <td class="m_date_time"><span class="starting__and__ending" style="font-size: 14px;">(<?= $showingstartOfficeTime; ?> - <?= $showingendOfficeTime; ?>)<br></span> <?= $showingTimeToday ?> </td>
                        <td><?= $row["s"] == '000' ? '' : $row["s"] ?></td>
                        <td class="m_remark">
                            <?= $row["r"]; ?>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<p class="alert alert-danger">No DATA FOUND</p>';
            } ?>

        </table>

        <div class="m_alert_style alert alert-info">
            <transition name="fade">
                <h1 v-show="show" v-bind:style="styleobj" class="">Username: {{mobile}}</h1>
            </transition>
            <hr>
            <transition name="fade">
                <h1 v-show="show" v-bind:style="styleobj" class="">Password: {{password}}</h1>
            </transition>
        </div>
        <div class="m_alert_style--button" v-on:click="show = !show">
            <button class="btn btn-info">Hide || Show</button>
        </div>

    </div>

</div>
</div>
</div>
<?php require "./footer.php" ?>