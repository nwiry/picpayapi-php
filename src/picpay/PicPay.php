<?php

namespace PicPay;

class Picpay{

    /**
     * @var string
     */
    private $x_picpay_token;
    /**
     * @var string
     */
    private $x_seller_token;

    public function __construct($x_picpay_token, $x_seller_token){
        $this->x_picpay_token = $x_picpay_token;
        $this->x_seller_token = $x_seller_token;
    }
}