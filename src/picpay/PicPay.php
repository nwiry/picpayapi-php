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
     * @var class
     */
    private $newPayment;
    /**
     * @var class
     */
    private $cancelPayment;
    /**
     * @var string
     */
    private $callback;

    /**
     * Constructor
     */
    public function __construct(string $x_picpay_token, string $x_seller_token, string $callback){
        /**
         * @return x-picpay-token
         */
        $this->x_picpay_token = $x_picpay_token;
        /**
         * @return x-seller-token
         */
        $this->x_seller_token = $x_seller_token;
        /**
         * @return class
         */
        $this->newPayment = new NewPayment();
        /**
         * @return class
         */
        $this->cancelPayment = new CancelPayment();
        /**
         * @return callback
         */
        $this->callback = $callback;
    }

    public function requestPayment(array $buyer, string $expire, string $price){
        /**
         * @return date
         * format: Y-m-d/H:i:s
         */
        $expires = explode("/", $expire);
        // 0 = Date
        // 1 = Hour
        $expires = $expires[0] . "T" . $expires[1] . "+05:00";
    }
}