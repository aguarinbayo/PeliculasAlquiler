<?php
public function create_payment_with_paypal()
{
    $paypal = new ConsumerPaypal();
    $approvalUrl = $paypal->savePaymentWithPaypal();
    echo "<a href='".$approvalUrl."'>Pagar con paypal</a>";
}

public function paypal_payment_response($res)
{
    if($res == true)
    {
        $paymentId = $_GET["paymentId"];
        $token = $_GET["token"];
        $payerId = $_GET["PayerID"];
        echo sprintf(
            'PaymentID: %s <br>Token: %s<br>PayerID: %s',
            $paymentId, $token, $payerId
        );

        $paypal = new ConsumerPaypal();
        $payment = $paypal->execute_payment($paymentId, $payerId);

        echo "<pre>";
        print_r($payment->toArray());
    }
    else 
    {
        echo "Payment failed";
    }
}

?>