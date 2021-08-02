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
     * @var string
     */
    private $callback;
    /**
     * @var string
     */
    private $returnSite;

    /**
     * Constructor
     */
    public function __construct(string $x_picpay_token, string $x_seller_token, string $callback, string $returnSite){
        /**
         * @return x-picpay-token
         */
        $this->x_picpay_token = $x_picpay_token;
        /**
         * @return x-seller-token
         */
        $this->x_seller_token = $x_seller_token;
        /**
         * @return callback
         */
        $this->callback = $callback;
        /**
         * @return url
         */
        $this->returnSite = $returnSite;
    }

    public function requestPayment(array $buyer, array $product, string $expire, array $addInfo = []){
        /**
         * @return date
         * format: Y-m-d/H:i:s
         */
        $expires = explode("/", $expire);
        // 0 = Date
        // 1 = Hour
        $expires = $expires[0] . "T" . $expires[1] . "+05:00"; // Return Final "expiresAt";
        /**
         * @param class
         */
        $newPay = new NewPayment($this->x_picpay_token, $buyer['firstName'], $buyer['lastName'], $buyer['document'], $buyer['email'], $buyer['phone']);
        /**
         * @return data
         */
        return $newPay->requestNewPayment($product['referenceId'], $this->callback, $expires, $this->returnSite, $product['value']);
    }
}