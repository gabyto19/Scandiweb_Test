<?php

namespace app\Model;

use app\Model\AbstractProduct;


class Dvd extends AbstractProduct
{
    private int $size;

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function saveDvd()
    {
        $this->saveMainProduct("dvd");

        $productId = $this->getLastId()[0]["type_id"];
        $sql = "INSERT INTO dvd (size,product_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getSize(), $productId]);
    }

}