<?php

namespace app\Model;

use app\Core\ValidateData;

class Furniture extends AbstractProduct
{
    private int $height;
    private int $width;
    private int $length;

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function validateData()
    {
        $height = $_POST["height"];
        $width = $_POST["width"];
        $length = $_POST["length"];

        if (ValidateData::isEmpty($height)) {
            ValidateData::$errors[] = "Height is missing";
        } else if (!ValidateData::isValidNum($height)) {
            ValidateData::$errors[] = "Height is not a numeric value";
        } else {
            $this->setHeight($height);
        }

        if (ValidateData::isEmpty($width)) {
            ValidateData::$errors[] = "Width is missing";
        } else if (!ValidateData::isValidNum($width)) {
            ValidateData::$errors[] = "Width is not a numeric value";
        } else {
            $this->setHeight($width);
        }

        if (ValidateData::isEmpty($length)) {
            ValidateData::$errors[] = "Length is missing";
        } else if (!ValidateData::isValidNum($length)) {
            ValidateData::$errors[] = "Length is not a numeric value";
        } else {
            $this->setHeight($length);
        }
    }

    public function setData()
    {
        $this->setHeight($_POST["height"]);
        $this->setWidth($_POST["width"]);
        $this->setLength($_POST["length"]);
    }

    public function save()
    {
        $this->saveMainProduct("furniture");

        $productId = $this->getLastId()[0]["product_id"];
        $sql = "INSERT INTO furniture (height, width, length, product_id) VALUES (?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getHeight(), $this->getWidth(), $this->getLength(), $productId]);
    }
}