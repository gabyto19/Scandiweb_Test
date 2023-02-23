<?php

namespace app\Model;

class Book extends AbstractProduct
{
    private int $weight;

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function saveBook()
    {
        $this->saveMainProduct("book");

        $productId = $this->getLastId()[0]["product_id"];
        $sql = "INSERT INTO book (weight, product_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getWeight(), $productId]);
    }

}