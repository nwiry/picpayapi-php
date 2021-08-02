<?php

namespace PicPay\NewPayment;

class NewPayment{
    /**
     * @var string
     */
    private $x_picpay_token;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $document;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $phone;

    public function __construct(string $x_picpay_token, string $firstName, string $lastName, string $document, string $email, string $phone){
        /**
         * @return x_picpay_token
         */
        $this->x_picpay_token = $x_picpay_token;
        /**
         * @return firstName
         */
        $this->firstName = $firstName;
        /**
         * @return lastName
         */
        $this->lastName = $lastName;
        /**
         * @return document
         */
        $this->document = $document;
        /**
         * @return email
         */
        $this->email = $email;
        /**
         * @return phone
         */
        $this->phone = $phone;
    }

    public function requestNewPayment(string $referenceId, string $callbackUrl, string $expiresAt, string $returnUrl, string $value, array $additionalInfo = [ null ]){
        /**
         * @var array
         * @return data
         */
        $dataPicpay = [
            "referenceId" => $referenceId,
            "callbackUrl" => $callbackUrl,
            "expiresAt" => $expiresAt,
            "returnUrl" => $returnUrl,
            "value" => $value,
            "additionalInfo" => $additionalInfo,
            "buyer" => [
                "firstName" => $this->firstName,
                "lastName" => $this->lastName,
                "document" => $this->document,
                "email" => $this->email,
                "phone" => $this->phone
            ]
        ];
        /**
         * @param curl
         */
        $pp = curl_init('https://appws.picpay.com/ecommerce/public/payments');
        curl_setopt($pp, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($pp, CURLOPT_POSTFIELDS, http_build_query($dataPicpay));
        curl_setopt($pp, CURLOPT_HTTPHEADER, array('x-picpay-token: ' . $this->x_picpay_token));
        $req = curl_exec($pp);
        curl_close($pp);
        $response = json_decode($req);
        /**
         * @return response
         */
        return $response;
    }
    
}