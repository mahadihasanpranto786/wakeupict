<?php
require 'config.php';
$activeMember = "SELECT * FROM members WHERE active_status=1";
$memberResult = $conn->query($activeMember);

$today = date("Y-m-d");

$sql = "SELECT members.name as name,members.designation as designation, members.start_time as start_time, members.end_time as end_time,attandence.date_time_mod as t,attandence.status as s, attandence.id as att_id, attandence.remarks as r
FROM members
INNER JOIN attandence ON attandence.member_id=members.id
WHERE date_time= '$today' ORDER BY attandence.id DESC";

$result = $conn->query($sql);

?>
<?php require 'header.php'; ?>
<?php
$memberInformation = $_SESSION['memberData'];
if (empty($memberInformation)) { ?>
  <div class="alert alert-danger" role="alert">
    You need to login first!
  </div>
<?php } else { ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="shadow border-danger p-3 bg-light border border-danger rounded sticky-top">
          <form action="submit_penalty.php" method="post" class="">
            <div class="form-group">
              <label for="">Select Employee</label>
              <select name="memberId" class="form-control select2bs4">
                <?php
                if ($memberResult->num_rows > 0) {
                  while ($row = $memberResult->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                <?php }
                } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Remark</label>
              <textarea id="" class="form-control" name="remark" rows="3" placeholder="Enter ..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <div class="col-sm-6">
        <table class="table table-striped py-5">
          <tr>
            <th class="w-20">Employee</th>
            <th class="m_remark">Remark</th>
            <th class="">Action</th>
          </tr>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($row["s"] == "000") {
          ?>
                <tr>
                  <td>
                    <?= $row["name"]; ?>
                    <br>
                    <span class="m_designation"></span><?= $row["designation"]; ?>
                  </td>
                  <td class="m_remark"><?= $row["r"]; ?></td>
                  <td>
                    <a href="delete_penalty.php?attId=<?= $row["att_id"]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>

                </tr>
          <?php
              }
            }
          } ?>

        </table>

      </div>
    </div>
  </div>

<?php  } ?>


<script src="./plugins/ckeditor-4/ckeditor.js"></script>
<script>
  CKEDITOR.replace("test", {
    height: 200,
  });
</script>


<div class="mt-5">
  <?php require 'footer.php'; ?>
</div>