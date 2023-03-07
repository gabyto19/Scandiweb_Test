<?php

namespace app\Core;

use app\Model\AbstractProduct;
use PDO;

class ValidateData extends AbstractProduct
{
    public static array $errors = [];

    public static function isEmpty($value): bool
    {
        if ($value === "")
        {
            return true;
        }
        return false;
    }

    public static function isValidNum($value): bool
    {
        if ($value !== "" && !is_numeric($value) || (float)$value <0) {
            return false;
        }

        return true;
    }

    public function validateMainProduct()
    {
        $productType = $_POST["product_type"];
        $sku = $_POST["sku"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        
        if ($this->isEmpty($productType))
        {
            self::$errors[] = "Please choose product type";
        }

        if ($this->isEmpty($sku))
        {
            self::$errors[] = "Sku is missing";
        } else if ($this->skuExists($sku)) {
            self::$errors[] = "Sku already exists";
        }

        if ($this->isEmpty($name))
        {
            self::$errors[] = "Name is missing";
        }

        if ($this->isEmpty($price))
        {
            self::$errors[] = "Price is missing";
        } else if (!$this->isValidNum($price)) {
            self::$errors[] = 'Price must be a valid value';
        }
    }

    public function skuExists(string $sku): bool
    {
        $sql = "SELECT sku FROM product WHERE sku = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$sku]);
        $getAllSku = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($getAllSku)) {
            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return self::$errors;
    }
}