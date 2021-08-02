<?php

/**
 * ---> Exemplo de como utilizar essa biblioteca
 */

// Importe o autoload do composer:
require_once('vendor/autoload.php');

// Importe os Pacotes
use PicPay\Buyer\Buyer;
use PicPay\Picpay;

$msg = ''; // String que será tratada com informações da API

/**
 * Defiina os dados requeridos pela API
 */
$picpay = new Picpay(
    '', // x-picpay-token
    '', // x-seller-token
    '', // callback url
    '' // return url
);

/**
 * Defina a Classe Buyer:
 */
$buyer = new Buyer();

/**
 * Defina a expiração do pagamento:
 */
$expDate = "2021-08-03/15:00:00"; // O formato da expiração deve ser sempre Y-m-d/H:i:s

/**
 * Exemplo de Requisição de pagamento:
 */
if(isset(
    $_POST['firstName'], // Primeiro Nome
    $_POST['lastName'], // Último Nome
    $_POST['document'], // CPF/CNPJ
    $_POST['email'], // E-mail
    $_POST['phone'], // Telefone
    $_POST['value'], // Valor
    $_POST['requestPayment'] // Submit
    )):
    
    $prodData = [
        "referenceId" => 'Fatura Nº', // Randomizar de acordo a sua preferência
        "value" => $_POST['value'] // Valor do pagamento
    ];
    /**
     * A função returnBuyer automaticamente transforma os dados recebidos em Array
     */
    $buyerData = $buyer->returnBuyer($_POST['firstName'], $_POST['lastName'], $_POST['document'], $_POST['email'], $_POST['phone']);
    /**
     * Por fim, definimos o contato com a API do PicPay:
     */
    $reqPay = $picpay->requestPayment(
        $buyerData, // Array Tratado
        $prodData, // Array Tratado
        $expDate // Expiração de Pagamento
    );
    /**
     * Resultado da requisição:
     */
    if(isset($reqPay->paymentUrl)){
        /**
         * Redirecionamento para o pagamento
         */
        header('location: '. $reqPay->paymentUrl);
    }else{
        /**
         * Em caso de falha: Exiba a mensagem de falha:
         */
        echo "<script<alert('". $reqPay->message . "')</script>";
    }
endif;