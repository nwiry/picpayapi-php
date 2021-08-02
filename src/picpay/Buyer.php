<?php

namespace PicPay\Buyer;

class Buyer{
    /**
     * @return array
     */
    public function returnBuyer(string $firstName, string $lastName, string $document, string $email, string $phone){
        $buyerData = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "document" => $document,
            "email" => $email,
            "phone" => $phone
        ];
        return (array) $buyerData;
    }
}