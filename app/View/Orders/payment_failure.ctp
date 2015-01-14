
<div class="col-sm-2"></div>

<div class="col-sm-8">
    <div class="order_success_in">
        <div class="order_success_title">
            <h1>Your order has been received Successfully</h1>
        </div>
        <div class="order_success_review">
            <div class="order_success_review_in">
                <h3>Order ID:<b><?php echo $oid; ?></b></h3>
            </div>
            <pre>
                <?php 
                    print_r($orders);
                    
                  
                ?>
            </pre>
            <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2>
        </div>
    </div>
</div>

<div class="col-sm-2"></div>
<script type="text/javascript">
    setTimeout(function() {
        try {
            Android.welcome("test");
        } catch (e) {
//            alert(e.message);
        }
    }, 10000);
</script>