@extends('layout')
@section('title','PayU Payment Proceeding...')
@section('content')
<form id='payu_payment_form' name='payu_payment_form' action='<?php echo $payment_data['action_url']; ?>' method='post'>
    <input type="hidden" name="key" value="<?php echo $payment_data['merchant_key']; ?>" />
    <input type="hidden" name="txnid" value="<?php echo $payment_data['txnid']; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $payment_data['productinfo']; ?>" />
    <input type="hidden" name="amount" value="<?php echo $payment_data['amount']; ?>" />
    <input type="hidden" name="email" value="<?php echo $payment_data['email']; ?>" />
    <input type="hidden" name="firstname" value="<?php echo $payment_data['firstname']; ?>" />
    <input type="hidden" name="surl" value="<?php echo $payment_data['surl']; ?>" />
    <input type="hidden" name="furl" value="<?php echo $payment_data['furl']; ?>" />
    <input type="hidden" name="phone" value="<?php echo $payment_data['phone']; ?>" />
    <input type="hidden" name="service_provider" value="<?php echo $payment_data['service_provider']; ?>" />
    <input type="hidden" name="hash" value="<?php echo $payment_data['hash']; ?>" />
    <input style='display:none' type="submit" value="submit"> 
</form>
@endsection
<script>    
    window.onload = function(){
        document.forms['payu_payment_form'].submit();
    }
</script>