<?php


namespace App\Domain\Mobi\Parser;

use App\Domain\Mobi\ExpenseItemFactory;

class CsvParser
{
    /**
     * @var string
     */
    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function parse()
    {
        $expenseItems = [];
        $fp = fopen($this->filename, 'rb');
        // skip first row
        fgets($fp);
        while (!feof($fp)) {
            $line = fgets($fp);
            if (trim($line) !== '') {
                $expenseItems[] = ExpenseItemFactory::fromCsv($line);
            }
        }
        return $expenseItems;
    }
}
