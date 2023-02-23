<?php

use app\Core\Template;
use app\Model\Book;
use app\Model\Dvd;
use app\Model\Furniture;

$template = new Template();

$page = $_SERVER["REQUEST_URI"] ?? null;
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($page)
{
    case @"/":
        $dvdCollection = new Dvd();
        $furnitureCollection = new Furniture();
        $bookCollection = new Book();

        $template->render("product-list.php",
            [
                "dvd" => $dvdCollection->getCollection("dvd"),
                "furniture" => $furnitureCollection->getCollection("furniture"),
                "book" => $bookCollection->getCollection("book")
            ]);
        break;
    case @"/addproduct":

        if ($requestMethod === "GET")
        {
            if (isset($_POST["sku"]))
            {
                echo "<pre>";
                var_dump("ewe");
                echo "</pre>";
                exit;
            }
            $template->render("add-product.php");
        }

        if ($requestMethod === "POST")
        {
            $errors = [];
            if ($_POST["product_type"] === "dvd")
            {
                if (isset($_POST["sku"]))
                {
                    echo "rame";
                }
                $dvd = new Dvd();
                $dvd->setSku($_POST["sku"]);
                $dvd->setName($_POST["name"]);
                $dvd->setPrice($_POST["price"]);
                $dvd->setSize($_POST["size"]);
                $dvd->saveDvd();
            }

            if ($_POST["product_type"] === "furniture")
            {
                $furniture = new Furniture();
                $furniture->setSku($_POST["sku"]);
                $furniture->setName($_POST["name"]);
                $furniture->setPrice($_POST["price"]);
                $furniture->setHeight($_POST["height"]);
                $furniture->setWidth($_POST["width"]);
                $furniture->setLength($_POST["length"]);
                $furniture->saveFurniture();
            }

            if ($_POST["product_type"] === "book")
            {
                $book = new Book();
                $book->setSku($_POST["sku"]);
                $book->setName($_POST["name"]);
                $book->setPrice($_POST["price"]);
                $book->setWeight($_POST["weight"]);
                $book->saveBook();
            }
        }
        break;
    case @"/massdelete":
        if ($requestMethod === "POST")
        {
            $deleteData = new Dvd();
            $deleteData->massDelete([$_POST["ids"]]);
        }
        break;
    default:
        $template->render("_404.php");
        break;
}
