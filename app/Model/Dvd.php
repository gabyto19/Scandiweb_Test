<?php

namespace app\Model;

use app\Core\ValidateData;

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

    public function validateData()
    {
        $size = $_POST["size"];

        if (ValidateData::isEmpty($size))
        {
            ValidateData::$errors[] = "Size is missing";
        } else if (!ValidateData::isValidNum($size)){
            ValidateData::$errors[] = "Size must be valid number";
        }
    }

    public function setData()
    {
        $this->setSize($_POST['size']);
    }

    public function save()
    {
        $this->saveMainProduct("dvd");

        $productId = $this->getLastId()[0]["product_id"];
        $sql = "INSERT INTO dvd (size, product_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getSize(), $productId]);
    }

}