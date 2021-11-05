<?php

declare(strict_types=1);

namespace Omnipay\GoPay\Message\Refund;

use Omnipay\Common\Message\AbstractRequest;

class RefundRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->getParameter('transactionReference');
    }

    /**
     * Get the transaction reference which was used to create recurrent profile
     *
     * @return mixed
     */
    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $this->getParameter('token'),
        ];

        $transactionReference = $this->getTransactionReference();

        $httpResponse = $this->httpClient->request(
            'POST',
            sprintf('%s/api/payments/payment/%s/refund', $this->getParameter('apiUrl'), $transactionReference),
            $headers,
            http_build_query($data)
        );

        $refundResponseData = json_decode($httpResponse->getBody()->getContents(), true);

        $response = new RefundResponse($this, $refundResponseData);
        return $response;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->setParameter('token', $token);
    }

    public function setPurchaseData($data)
    {
        $this->setParameter('purchaseData', $data);
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->setParameter('apiUrl', $apiUrl);
    }
}
