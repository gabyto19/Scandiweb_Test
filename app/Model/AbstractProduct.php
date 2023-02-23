<?php

namespace app\Model;

use app\Core\Database;
use PDO;

abstract class AbstractProduct extends Database
{
    private string $sku;
    private string $name;
    private float $price;

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function saveMainProduct(string $productName)
    {
        $sql = "INSERT INTO product (sku, name, price, type_id) VALUES (?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$this->getSku(), $this->getName(), $this->getPrice(), $this->getTypeId($productName)["type_id"]]);
    }

    public function getTypeId(string $productName)
    {
        $sql = "SELECT type_id FROM product_types WHERE product_name = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$productName]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getCollection($tableName)
    {
        $sql = "SELECT * FROM $tableName JOIN product p ON ($tableName.product_id = p.product_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastId()
    {
        $sql = "SELECT * FROM product WHERE product_id=(SELECT max(product_id) FROM product)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function massDelete(array $ids)
    {
        $in  = str_repeat('?,', count($ids[0]) - 1) . '?';
        $sql = "DELETE FROM product WHERE product_id IN ($in)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($ids[0]);
    }
}
