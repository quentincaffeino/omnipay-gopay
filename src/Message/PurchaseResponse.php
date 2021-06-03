<?php

namespace Omnipay\GoPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Response isn't "successful" because it it succedes
     * we don't know before person completes payment, that is
     * why it is a redirect response.
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * It is a redirect response therefore must have this method which returns true
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     */
    public function getRedirectUrl()
    {
        if (!is_array($this->data) || !isset($this->data['gw_url']) || !is_string($this->data['gw_url'])) {
            return null;
        }
        return $this->data['gw_url'];
    }

    /**
     * Get the required redirect method (either GET or POST).
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        return null;
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