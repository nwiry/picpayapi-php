<?php
error_reporting(E_ALL);

require_once(__DIR__ . '/../vendor/autoload.php');

use PicPay\Buyer\Buyer;
use PicPay\Picpay;

$msg = '';

$picpay = new Picpay(
    '44501993-b3f4-497b-ba2d-8a5f5ffc632f', // x-picpay-token
    '5b3bef7b-ad48-4e7c-bb42-d9aa10f14927', // x-seller-token
    'http://localhost:3000/tests/ReturnCallback.php', // callback url
    'http://localhost:3000/tests/PaymentApproved.php' // return url
);
$buyer = new Buyer();

$expDate = "2021-08-03/15:00:00"; //Y-m-d/H:i:s
if(isset($_POST['firstName'], $_POST['lastName'], $_POST['document'], $_POST['email'], $_POST['phone'], $_POST['value'], $_POST['requestPayment'])):
    $randomRef = rand(50000, 90000);
    $prodData = [
        "referenceId" => 'Fatura #' . $randomRef,
        "value" => $_POST['value']
    ];
    $buyerData = $buyer->returnBuyer($_POST['firstName'], $_POST['lastName'], $_POST['document'], $_POST['email'], $_POST['phone']);
    $reqPay = $picpay->requestPayment($buyerData, $prodData, $expDate);
    if(isset($reqPay->paymentUrl)){
        header('location: '. $reqPay->paymentUrl);
    }else{
        $msg = "alert('". $reqPay->message . "')";
    }
endif;

?>
<center>
    <h1>Pagar com PicPay</h1>
    <form method="post">
        <label>Seu Nome</label><br />
        <input type="text" name="firstName" placeholder="Digite aqui seu nome" required="" /><br /><br />
        <label>Seu Sobrenome</label><br />
        <input type="text" name="lastName" placeholder="Digite aqui seu sobrenome" required="" /><br /><br />
        <label>CPF/CNPJ</label><br />
        <input type="text" name="document" placeholder="Digite aqui seu CPF/CNPJ" required="" /><br /><br />
        <label>Seu E-mail</label><br />
        <input type="email" name="email" placeholder="Digite aqui seu nome" required="" /><br /><br />
        <br />
        <label>Seu Telefone</label><br />
        <input type="tel" name="phone" placeholder="Digite aqui seu nome" required="" /><br /><br />
        <br />
        <label>Valor</label><br />
        <input type="number" name="value" placeholder="Digite aqui o valor a pagar" required="" /><br /><br />
        <br />
        <input type="submit" name="requestPayment" value="Pagar com PicPay" />
    </form>
</center>
<script type=text/javascript>
<?=$msg?>
</script>