<tr id='row_<?= $rowCount ?>'>
	<td>
		<div class='form-group col-sm-12'>
			<select class="form-control supplier_id" row_count='<?= $rowCount ?>' id='selectedit<?= $rowCount ?>' style='width:250px;' name='sp_s_id[]' required>
				<option value="">Select Supplier</option>
				<?php if ($suppliers) {
					foreach ($suppliers->result() as $supplier) {
						if ($supplier->s_sup_t_id == 1) {
				?>
							<option value="<?= $supplier->s_id; ?>">
								<?= $supplier->s_title; ?></option>
				<?php }
					}
				}
				?>
			</select>
			<span class="text-danger supplierResult" id="supplier_result<?= $rowCount ?>"></span>
		</div>
	</td>
	<td><span id="bankBranch<?= $rowCount ?>"></span></td>
	<td>
		<div class="form-group col-sm-6">
			<select class="form-control select2" style="width: 150%;" name="sp_paid_by[]">
				<option selected="Bank">Bank</option>
				<option value="Cash">Cash</option>
				<option value="Other">Other</option>
			</select>
		</div>
	</td>
	<td><input type="text" name="sp_amount[]" class="form-control amount" placeholder="" value='' required></td>
	<td><input type="text" name="sp_reference[]" class="form-control" id="exampleInputEmail1" placeholder="Comments" value=''></td>
	<td><button style='text-align: right;' class='btn btn-danger deleteRow' row_count='<?= $rowCount ?>' type='button' value='Delete'>Delete</button></td>
</tr>
<script>
	$(`#selectedit<?= $rowCount ?>`).select2();
</script>