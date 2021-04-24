<?php


namespace App\Domain\Mobi;


use App\Domain\Currency\Currency;
use App\Domain\Expenses\Category;

class ExpenseItem
{
    /**
     * @var string
     */
    private $creditorName;
    /**
     * @var string
     */
    private $creditorAccountNumber;
    /**
     * @var Currency
     */
    private $currency;
    /**
     * @var string
     */
    private $purposeDescription;
    /**
     * @var int
     */
    private $purposeCode;
    /**
     * @var \DateTime
     */
    private $valueDate;

    /**
     * @var Category
     */
    private $category;

    public function __construct(string $creditorName, string $creditorAccountNumber, Currency $currency, string $purposeDescription, int $purposeCode, \DateTime $valueDate)
    {
        $this->creditorName = $creditorName;
        $this->creditorAccountNumber = $creditorAccountNumber;
        $this->currency = $currency;
        $this->purposeDescription = $purposeDescription;
        $this->purposeCode = $purposeCode;
        $this->valueDate = $valueDate;
    }

    /**
     * @return string
     */
    public function purposeDescription(): string
    {
        return $this->purposeDescription;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function valueDate(): \DateTime
    {
        return $this->valueDate;
    }

    public function belongsTo(Category $category)
    {
        $this->category = $category;
    }

    public function category()
    {
        return $this->category;
    }
}