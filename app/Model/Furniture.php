<?php

namespace app\Model;

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

    public function saveFurniture()
    {
        $this->saveMainProduct("furniture");

        $productId = $this->getLastId()[0]["product_id"];
        $sql = "INSERT INTO furniture (height, width, length, product_id) VALUES (?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getHeight(), $this->getWidth(), $this->getLength(), $productId]);
    }
}