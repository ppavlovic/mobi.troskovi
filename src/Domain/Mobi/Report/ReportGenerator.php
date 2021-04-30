<?php


namespace App\Domain\Mobi\Report;

use App\Domain\Mobi\ExpenseItem;

class ReportGenerator
{
    /**
     * @var array|ExpenseItem[]
     */
    private $expenseItems;

    /**
     * @var array|ExpenseItem[]
     */
    private $categories;

    public function __construct(ExpenseItem ...$expenseItems)
    {
        $this->expenseItems = $expenseItems;
    }

    public function analyze()
    {
        foreach ($this->expenseItems as $item) {
            $this->categories[(string) $item->category()][] = $item;
        }
    }

    public function report(): array
    {
        return $this->categories;
    }
}
