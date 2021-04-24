<?php


namespace App\Domain\Expenses;


use App\Domain\Mobi\ExpenseItem;
use Symfony\Component\Yaml\Yaml;

class Patterns
{
    /**
     * @var Pattern[]
     */
    private $patterns;

    public function loadFromYaml()
    {
        $values = Yaml::parse(file_get_contents(__DIR__ . '/patterns.yml'));

        foreach ($values as $category) {
            foreach ($category as $categoryName => $patterns) {
                foreach ($patterns as $pattern) {
                    $this->patterns[] = new Pattern(new Category($categoryName), $pattern);
                }
            }
        }
    }

    public function categorize(ExpenseItem $expenseItem)
    {
        foreach ($this->patterns as $pattern) {
            if ($pattern->match($expenseItem->purposeDescription())) {
                $expenseItem->belongsTo($pattern->category());
            }
        }
    }
}