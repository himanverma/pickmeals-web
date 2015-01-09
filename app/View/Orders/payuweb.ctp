<?php
// Merchant key here as provided by Payu (JBZaLc)
$MERCHANT_KEY = "q23BRi";

// Merchant Salt as provided by Payu(GQs7yium)
$SALT = "f8oqAWZO";

// End point - change to https://secure.payu.in for LIVE mode Or Test https://test.payu.in
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';


$posted = array();
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}

$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {

    if (
            empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider'])
    ) {
        $formError = 1;
    } else {
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>

<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
        if (hash == '') {
            return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
    }

    window.onload = function() {
       document.forms['payuForm'].submit();
    }
</script>
<style>
    .payu1{
        width: 100%;
    }
    .payu2{
        margin: 20% auto; width: 220px;
    }
    .payu4{
        float: left;
        /*margin-left: 20%;*/
        width: 100%;
    }
    .payu5{
        float: left;
        margin-left: 23%;
    }
</style>
<div class="payu1">
    <div class="payu2">
        <img class="payu4" style="" src="<?php echo $this->Html->url('/img/ajax-loader.gif'); ?>">
        <p style="font-size:13px; font-family:'Arial'; text-align:center">Please don't refresh or click back !</p>
    </div>
</div>

<br/>
<?php if ($formError) { ?>
    <span style="color:red">Please fill all mandatory fields.</span>
    <br/>
    <br/>
<?php } ?>
<form action="<?php echo $action; ?>" method="post" name="payuForm" style="display: none;">
    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <table>
        <tr>
            <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
            <td>Amount: </td>
            <td><input name="amount" value="<?php echo $total; ?>" /></td>
            <td>First Name: </td>
            <td><input name="firstname" id="firstname" value="<?php echo $order['Address']['f_name']; ?>" /></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input name="email" id="email" value="<?php
                if ($order['Customer']['email']) {
                    echo $order['Customer']['email'];
                } else {
                    echo "your.email@domain.com";
                }
                ?>" /></td>
            <td>Phone: </td>
            <td><input name="phone" value="<?php echo $order['Address']['phone_number']; ?>" /></td>
        </tr>
        <tr>
            <td>Product Info: </td>
            <td colspan="3"><textarea name="productinfo"><?php echo $order['Order']['recipe_names']; ?></textarea></td>
        </tr>
        <tr>
            <td>Success URI: </td>
            <td colspan="3"><input name="surl" value="https://www.pickmeals.com/orders/payment_success/<?php echo $order['Order']['sku'] ?>" size="64" /></td>
        </tr>
        <tr>
            <td>Failure URI: </td>
            <td colspan="3"><input name="furl" value="https://www.pickmeals.com/orders/payment_failure/<?php echo $order['Order']['sku'] ?>" size="64" /></td>
        </tr>

        <tr>
            <td>Service Provider: </td>
            <td colspan="3"><input name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
            <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
            <td>Last Name: </td>
            <td><input name="lastname" id="lastname" value="<?php echo $order['Address']['l_name']; ?>" /></td>
            <td>Cancel URI: </td>
            <td><input name="curl" value="https://www.pickmeals.com/orders/payment_failure/<?php echo $order['Order']['sku'] ?>" /></td>
        </tr>
        <tr>
            <td>Address1: </td>
            <td><input name="address1" value="<?php echo $order['Address']['address']; ?>" /></td>
            <!--<td>Address2: </td>-->
            <!--<td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>-->
        </tr>
        <tr>
            <td>City: </td>
            <td><input name="city" value="<?php echo $order['Address']['city']; ?>" /></td>
            <td>State: </td>
            <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
            <td>Country: </td>
            <td><input name="country" value="India" /></td>
            <td>Zipcode: </td>
            <td><input name="zipcode" value="<?php echo $order['Address']['zipcode']; ?>" /></td>
        </tr>
        <tr>
            <td>UDF1: </td>
            <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
            <td>UDF2: </td>
            <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
            <td>UDF3: </td>
            <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
            <td>UDF4: </td>
            <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
            <td>UDF5: </td>
            <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
            <td>PG: </td>
            <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
            <?php // if(!$hash) {  ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
            <?php // }  ?>
        </tr>
    </table>
</form>
