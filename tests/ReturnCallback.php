<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use PicPay\CallBack\Callback;

$callback = new Callback('44501993-b3f4-497b-ba2d-8a5f5ffc632f');
$callback = $callback->notification();

if($callback != false){
    /**
     * @var
     * @return data
     */
    $statusPayment = $callback->status;
    /**
     * @var
     * @return data
     */
    $authorizationId = $callback->authorizationId;
    /**
     * @var
     * @return data
     */
    $refID = $callback->referenceId;

    /**
     * ---------> Executar ações
     */
}else{
    /**
     * @return error404
     */
    http_response_code(404);
}