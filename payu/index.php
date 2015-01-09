<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="https://secure.payu.com/paygw/UTF/NewPayment" method="POST" name="payform">
    Name: <input type="text" name="first_name" value=""><br/>
    Surname: <input type="text" name="last_name" value=""><br/>
    E-mail: <input type="text" name="email" value=""><br/>
    <input type="hidden" name="pos_id" value="12345">
    <input type="hidden" name="pos_auth_key" value="wq2iO3q">
    <input type="hidden" name="session_id" value="1234565">
    <input type="hidden" name="amount" value="1000">
    <input type="hidden" name="desc" value="Opispłatności">
    <input type="hidden" name="client_ip" value="123.123.123.123">
    <input type="hidden" name="js" value="0">
    <input type="submit" value="Pay via Platnosci.pl">
</form>
<script language="JavaScript" type="text/javascript">
    <!--
    document.forms['payform'].js.value=1;
    -->
</script>
    </body>
</html>
