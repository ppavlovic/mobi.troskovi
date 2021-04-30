<?php


namespace App\Domain\Currency;

class Currency
{
    /**
     * @var float
     */
    private $amount;
    /**
     * @var CurrencyCode
     */
    private $code;

    public function __construct(float $amount, CurrencyCode $code)
    {
        $this->amount = $amount;
        $this->code = $code;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function code(): CurrencyCode
    {
        return $this->code;
    }
}
