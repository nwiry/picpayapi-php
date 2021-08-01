<?php

namespace PicPay;

use PicPay\NewPayment\NewPayment;
use PicPay\CancelPayment\CancelPayment;

class Picpay{

    /**
     * @var string
     */
    private $x_picpay_token;
    /**
     * @var string
     */
    private $x_seller_token;
    /**
     * @param class
     */
    private $newPayment;
    /**
     * @param class
     */
    private $cancelPayment;

    /**
     * Constructor
     */
    public function __construct(string $x_picpay_token, string $x_seller_token){
        $this->x_picpay_token = $x_picpay_token;
        $this->x_seller_token = $x_seller_token;
        $this->newPayment = new NewPayment();
        $this->cancelPayment = new CancelPayment();
    }
}