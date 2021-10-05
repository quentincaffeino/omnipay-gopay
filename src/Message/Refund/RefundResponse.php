<?php

declare(strict_types=1);

namespace Omnipay\GoPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class RefundResponse extends AbstractResponse
{

    const FINISHED = 'FINISHED';

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getResult() === static::FINISHED;
    }

    public function getId()
    {
        if (isset($this->data['id']) && !empty(isset($this->data['id']))) {
            return (string) $this->data['id'];
        }
        return null;
    }

    public function getResult()
    {
        if (isset($this->data['result']) && !empty($this->data['result'])) {
            return (string) $this->data['result'];
        }
        return null;
    }
}
