<?php


namespace App\Domain\Expenses;


class Pattern
{
    private $category;
    private $text;

    public function __construct(Category $category, string $text)
    {
        $this->category = $category;
        $this->text = $text;
    }

    public function match(string $description)
    {
        return stripos($description, $this->text) !== false;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function text(): string
    {
        return $this->text;
    }
}