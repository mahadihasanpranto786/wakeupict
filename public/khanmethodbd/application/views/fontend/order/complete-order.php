<div class="content-wrapper clearfix ">
    <div class="container">


        <section class="confirmation text-center">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
            <h2>Your order has been placed!</h2>
            <p>
                Your Invoice No is<span> <?= $this->session->userdata('invoice_number') ?></span>
                <br>
                Thanks for shopping with us.
            </p>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>


<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        swal({
            title: "success",
            text: "Your order has been placed successfully.",
            icon: "success",
            showConfirmButton: false,
            timer: 1000
        });

    });
</script>