<?php

namespace Omnipay\GoPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\ResponseInterface;

class StatusResponse extends AbstractResponse implements ResponseInterface
{

    const PAID = "PAID";

    const STATUSES = [
        "CREATED" => "Payment created",
        "PAYMENT_METHOD_CHOSEN" => "Payment method chosen",
        StatusResponse::PAID => "Payment paid",
        "AUTHORIZED" => "Payment pre-authorized",
        "CANCELED" => "Payment canceled",
        "TIMEOUTED" => "Payment timeouted",
        "REFUNDED" => "Payment refunded",
        "PARTIALLY_REFUNDED" => "Payment partially refunded",
    ];


    /**
     * If payment was payed it was successfull
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getCode() == StatusResponse::PAID;
    }

    public function getCode()
    {
        if (isset($this->data['state'])) {
            return $this->data['state'];
        }
        return null;
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id']) && !empty(isset($this->data['id']))) {
            return (string) $this->data['id'];
        }
        return null;
    }

    public function getTransactionId()
    {
        if (isset($this->data['order_number']) && !empty($this->data['order_number'])) {
            return (string) $this->data['order_number'];
        }
        return null;
    }
}
