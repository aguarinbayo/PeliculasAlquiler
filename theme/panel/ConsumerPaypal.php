<?php
use PayPal\Rest\ApiContext,
    PayPal\Auth\OAuthTokenCredential,
    PayPal\Api\CreditCard,
    PayPal\Exception\PayPalConnectionException,
    PayPal\Api\Amount,
    PayPal\Api\Details,
    PayPal\Api\Item,
    PayPal\Api\ItemList,
    PayPal\Api\CreditCardToken,
    PayPal\Api\Transaction,
    PayPal\Api\Payment,
    PayPal\Api\Payer,
    PayPal\Api\FundingInstrument,
    PayPal\Api\PaymentExecution, 
    PayPal\Api\RedirectUrls; 

//..................................................................

/**
*
* genera un pedido sin procesar que devuelve una url para hacer el redirect
*
*/
public function savePaymentWithPaypal() 
{
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $item1 = new Item();
    $item1->setName('Curso de Socket.IO')
        ->setCurrency('EUR')
        ->setQuantity(1)
        ->setSku("1")
        ->setPrice(25);
    $item2 = new Item();
    $item2->setName('Curso de Node.js y Express 4')
        ->setCurrency('EUR')
        ->setQuantity(1)
        ->setSku("3")
        ->setPrice(15);

    $itemList = new ItemList();
    $itemList->setItems(array($item1, $item2));

    $details = new Details();
    $details->setShipping(0)->setTax(8.40)->setSubtotal(40);

    $amount = new Amount();
    $amount->setCurrency("EUR")->setTotal(48.40)->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Compra en cursosdesarrolloweb")
        ->setInvoiceNumber(uniqid());


    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($this->_baseUrl . "home/paypal_payment_response/success")
        ->setCancelUrl($this->_baseUrl . "home/paypal_payment_response/error");

    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

    try {
        $payment->create($this->_apiContext);
        return $payment->getApprovalLink();
    } catch (PayPalConnectionException $ex) {
        echo $ex->getData();
        exit;
    }
}

public function execute_payment($paymentId, $payerId)
{
    $payment = Payment::get($paymentId, $this->_apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    try {
        $payment->execute($execution, $this->_apiContext);
        return $payment;
    } catch (PayPalConnectionException $ex) {
        echo $ex->getData();
        exit;
    }
}

?>