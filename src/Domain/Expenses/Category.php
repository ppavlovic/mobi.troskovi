<?php


namespace App\Domain\Expenses;

class Category
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }

    public static function uncategorized()
    {
        return new Category('* Nekategorizovano *');
    }
}
