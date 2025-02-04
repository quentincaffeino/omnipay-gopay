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
     * @return array
     */
    public function getData()
    {
        return $this->getParameter('refundData');
    }

    /**
     * @param array $refundData
     */
    public function setRefundData($refundData)
    {
        $this->setParameter('refundData', $refundData);
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
     * @param  array $data The data to send
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $transactionReference = $this->getTransactionReference();
        $url = sprintf('%s/api/payments/payment/%s/refund', $this->getParameter('apiUrl'), $transactionReference);

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $this->getParameter('token'),
        ];

        $body = http_build_query($data);

        $httpResponse = $this->httpClient->request(
            'POST',
            $url,
            $headers,
            $body
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

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->setParameter('apiUrl', $apiUrl);
    }
}
