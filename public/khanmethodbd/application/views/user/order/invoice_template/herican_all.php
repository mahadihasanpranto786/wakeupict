<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Print Invoice</title>
</head>
<body style="font-family: arial; margin: 0; padding: 0;">

  
  <!--Header section - start-->


  <?php
        if ($invoice_list) {
            $Serial = 1;
            foreach ($invoice_list->result() as $invoice_information) {
        $product_list = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $invoice_information->i_id);
                ?>

<div style="max-width: 1250px; overflow: hidden; margin: 0 auto; width: 100%;">
  
  <!--Header section - start-->

  <header style="padding: 10px 0; box-sizing: border-box; overflow: hidden;">
    <div style="width: 60%; float: left;">
      <img style="max-width: 500px;" src="<?php echo base_url(); ?>assets/products/<?=$company_logo?>" alt="Logo">
    </div>
    <div style="width: 40%; float: left;" class="address">
      <address style="font-style: normal; font-size: 12px;text-align: right;">
        <span style="display: block;">36, Zigatola, Dhanmondi,Dhaka - 1209</span>
        <span style="display: block;">Visit: <a style="text-decoration: none;" href="http://www.heriken.com">www.heriken.com</a></span>
        <span style="display: block;">Mobile: 01714-000000</span>
      </address>
    </div>
  </header>

  <!--Header section - end-->

 
  <!-- Order Section - start-->
 
   <div style="">
    <table style="margin: 10px 0; width: 100%; border: 1px solid black !important; border-collapse: collapse;">
      <tr>
        <th style="text-align: left; background: grey; padding: 15px; font-size: 15px; color: #fff;border: 1px solid black; border-collapse: collapse;" colspan="2"><span>Order Date : </span> <span><?= $invoice_information->i_createdat; ?></span></th>
      </tr>
      <tr style="background: #dbdbdb;">
        <td style="border: 1px solid black; border-collapse: collapse;"><span style="font-size: 15px; font-weight: 700; padding: 15px; display: block;">Ship to: </span> </td>
        <td style="border: 1px solid black; border-collapse: collapse;"><span style="font-size: 15px; font-weight: 700; padding: 15px; display: block;">Order Number : <?= $invoice_information->i_id + 1000; ?></span></td>
      </tr>
      <tr>
        <td style="border: 1px solid black; border-collapse: collapse;" colspan="2">
          <address style="padding: 10px;">
            <span style="display:block; padding: 5px; font-size: 12px; font-style: normal;"><span style="font-weight: 700;">Name: </span> <?= $invoice_information->i_name; ?></span>
            <span style="display:block; padding: 5px; font-size: 12px; font-style: normal;"><span style="font-weight: 700;">Address: </span> <?= $invoice_information->i_address; ?></span>
            <span style="display:block; padding: 5px; font-size: 12px; font-style: normal;"><span style="font-weight: 700;">Phone : </span><?= $invoice_information->i_mobile; ?></span>
          </address>
        </td>
      </tr>
      <tr style=" background: #dbdbdb;">
        <td style="border: 1px solid black; border-collapse: collapse;"><span style="font-size: 15px; font-weight: 700; padding: 15px; display: block; color: #00b050; text-align: center;">Total Amount:</span></td>
        <td style="border: 1px solid black; border-collapse: collapse;"><span style="font-size: 15px; font-weight: 700; padding: 15px; display: block; color: #00b050; text-align: center;">৳<?= $invoice_information->i_totalcost - $invoice_information->i_payment+$invoice_information->i_shipping_cost ?></span></td>
      </tr>
      
      <tr>
          <td colspan="3">
              <div style="overflow: hidden; text-align: center; font-size: 12px; background: #dbdbdb;">
                  <div style="width: 25%;float: left; padding: 12px; box-sizing: border-box;">Products</div>
                  <div style="width: 25%;float: left; padding: 12px; box-sizing: border-box;">Image</div>
                  <div style="width: 50%;float: left; padding: 12px; box-sizing: border-box; overflow: hidden;">
                      <div style="width: 25%; float: left;">Price</div>
                      <div style="width: 25%; float: left;">Qty</div>
                      <div style="width: 25%; float: left;">Tax</div>
                      <div style="width: 25%; float: left;">Subtotal</div>
                  </div>
              </div>
          </td>
      </tr>
	  
	  <?php
                            $total_sum_cost = 0;
                            if ($product_list) {
                                $Serial = 1;

                                foreach ($product_list->result() as $row) {
                                    ?>

      <tr>
	  
          <td colspan="3">
              <div style="overflow: hidden; text-align: center; font-size: 12px; display: flex; align-items: center;">
                  <div style="width: 25%;float: left; padding: 10px; box-sizing: border-box;"><?= $row->p_tittle; ?></div>
                  <div style="width: 25%;float: left; padding: 10px; box-sizing: border-box;"><img style="max-width: 100px; width: 100%;" src="<?php echo base_url(); ?>assets/products/<?=$row->p_imagepath?>" alt="Image"></div>
                  <div style="width: 50%;float: left; padding: 12px; box-sizing: border-box; overflow: hidden;">
                      <div style="width: 25%; float: left;">৳<?= $row->p_sprice; ?></div>
                      <div style="width: 25%; float: left;"><?= $row->p_quantity; ?></div>
                      <div style="width: 25%; float: left;">৳0.00</div>
                      <div style="width: 25%; float: left;">৳<?= $row->p_quantity * $row->p_sprice; ?></div>
                  </div>
              </div>
          </td>
      </tr> 

<?php
        $total_sum_cost +=    $row->p_quantity * $row->p_sprice;
        }
        } else { }
        ?>	  
   
      
      <tr>
       <td></td>
        <td style="border-right: 1px solid black;">
          <span style="text-align: right; display: block; padding: 12px;">
            <span style="display: block; font-weight: 500; font-size: 12px;">
              <span style="width: 50%; float: left;">Shipping Cost: </span> <span style="width: 50%; float: left;">৳<?= $invoice_information->i_shipping_cost; ?></span>
            </span>
			<?php if($invoice_information->i_payment!=0){ ?>
            <span style="display: block; font-weight: 500; font-size: 12px;">
              <span style="width: 50%; float: left;">Advanced: </span> <span style="width: 50%; float: left;">৳<?= $invoice_information->i_payment; ?></span>
            </span>
			 <?php } ?>
			<?php if($invoice_information->i_discount!=0){ ?>
            <span style="display: block; font-weight: 500; font-size: 12px;">
              <span style="width: 50%; float: left;">Discount: </span> <span style="width: 50%; float: left;">৳<?= $invoice_information->i_discount; ?></span>
            </span>
			 <?php } ?>
			
          </span>
        </td>
      </tr>
      <tr>
       <td></td>
        <td style="border-right: 1px solid black;">
          <span style="text-align: right; display: block; padding: 12px;">
            <span style="font-weight: 900; font-size: 15px; width: 50%; float: left; white-space: nowrap;">Grand Total: </span> 
            <span style="font-weight: 900; font-size: 15px; width: 50%; float: left;">৳<?= $invoice_information->i_totalcost - $invoice_information->i_payment+$invoice_information->i_shipping_cost ?></span>
          </span>
		  
        </td>
      </tr>
    </table>
    </div>
  <!-- Order Section - end-->
   </div>
  <!-- Order Section - end-->
  <?php }
        } else { }
        ?>
     
  
</body>
</html>