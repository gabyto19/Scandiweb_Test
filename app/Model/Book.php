<?php

namespace app\Model;

use app\Core\ValidateData;

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

    public function validateData()
    {
        $weight = $_POST["weight"];

        if (ValidateData::isEmpty($weight)) {
            ValidateData::$errors[] = 'Weight is missing';
        } else if (!ValidateData::isValidNum($weight)) {
            ValidateData::$errors[] = 'Weight is not a numeric value';
        } else {
            $this->setWeight($weight);
        }
    }

    public function setData()
    {
        $this->setWeight($_POST["weight"]);
    }

    public function save()
    {
        $this->saveMainProduct("book");

        $productId = $this->getLastId()[0]["product_id"];
        $sql = "INSERT INTO book (weight, product_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getWeight(), $productId]);
    }

}