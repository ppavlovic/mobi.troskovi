<?php


namespace App\Domain\Mobi;


use App\Domain\Currency\Currency;
use App\Domain\Currency\CurrencyCode;

class ExpenseItemFactory
{
    public static function fromCsv($row): ExpenseItem
    {
        [$creditorName, $creditorAccountNumber, $currencyAmount, $currencyCode, $purposeDescription, $purposeCode, $valueDate] = str_getcsv($row);

        return new ExpenseItem(
            trim($creditorName),
            trim($creditorAccountNumber),
            new Currency((float) $currencyAmount, new CurrencyCode($currencyCode)),
            trim($purposeDescription),
            (int) $purposeCode,
            date_create($valueDate)
        );
    }
}