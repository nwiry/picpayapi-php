<?php

namespace PicPay\CallBack;

class Callback{
    /**
     * @var string
     */
    private $x_picpay_token;

    public function __construct($x_picpay_token){
        /**
         * @return x-picpay-token
         */
        $this->x_picpay_token = $x_picpay_token;
    }

    public function notification(){
        /**
         * @param callback
         * @return data
         */
        $picpayResponse = json_decode(trim(file_get_contents("php://input")));

        if(isset($picpayResponse->authorizationId)){
            /**
             * @param curl
             */
            $pp = curl_init('https://appws.picpay.com/ecommerce/public/payments/'.$picpayResponse->referenceId.'/status');
            curl_setopt($pp, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($pp, CURLOPT_HTTPHEADER, array('x-picpay-token: '.$this->x_picpay_token)); 
            $req = curl_exec($pp);
            curl_close($pp);
            /**
             * @return object
             */
            $callback = json_decode($req);
            /**
             * @var object
             */
            $callback->referenceId = $picpayResponse->referenceId;
            /**
             * @var object
             */
            $callback->authorizationId = $picpayResponse->authorizationId;
            /**
             * @return data
             */
            return $callback;
        }
        /**
         * @return bool
         */
        return false;
    }

}