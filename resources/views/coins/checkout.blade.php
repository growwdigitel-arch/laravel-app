<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment...</title>
</head>
<body onload="document.forms['payuForm'].submit()">
    <div style="text-align: center; margin-top: 20%; font-family: sans-serif;">
        <h2>Redirecting to PayU...</h2>
        <p>Please do not close this window.</p>
        <form name="payuForm" action="{{ $action }}" method="POST">
            <input type="hidden" name="key" value="{{ $key }}" />
            <input type="hidden" name="txnid" value="{{ $txnid }}" />
            <input type="hidden" name="productinfo" value="{{ $productinfo }}" />
            <input type="hidden" name="amount" value="{{ $amount }}" />
            <input type="hidden" name="email" value="{{ $email }}" />
            <input type="hidden" name="firstname" value="{{ $firstname }}" />
            <input type="hidden" name="surl" value="{{ $surl }}" />
            <input type="hidden" name="furl" value="{{ $furl }}" />
            <input type="hidden" name="hash" value="{{ $hash }}" />
        </form>
    </div>
</body>
</html>
