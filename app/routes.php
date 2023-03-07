<?php

use app\Core\Template;
use app\Core\ValidateData;
use app\Model\Book;
use app\Model\Dvd;
use app\Model\Furniture;

$template = new Template(); // instance the template engine
$page = $_SERVER["REQUEST_URI"] ?? null; // get the current page
$requestMethod = $_SERVER["REQUEST_METHOD"]; // get the request method


switch ($page)
{
    case @"/":
        $dvdModel = new Dvd();
        $furnitureModel = new Furniture();
        $bookModel = new Book();

        // render the product list view
        $template->render("product-list.php",
            [
                "dvd" => $dvdModel->getCollection("dvd"),
                "furniture" => $furnitureModel->getCollection("furniture"),
                "book" => $bookModel->getCollection("book")
            ]);
        break;
    case @"/addproduct":
        $validator = new ValidateData();

        if ($requestMethod === "POST")
        {
            if ($validator::isEmpty($_POST["product_type"])) {
                ValidateData::$errors[] = 'Product type is missing';
                http_response_code(400);
                echo json_encode($validator->getErrors());
                break;
            }

            $productType = "app\\Model\\{$_POST["product_type"]}";
            $productObj = new $productType();

            $validator->validateMainProduct();
            $productObj->validateData();

            if (!$validator->getErrors()) {
                $productObj->setSku($_POST['sku']);
                $productObj->setName($_POST['name']);
                $productObj->setPrice($_POST['price']);
                $productObj->setData();
                $productObj->save();
                http_response_code(200);
            }else  {
                http_response_code(400);
                echo json_encode($validator->getErrors());
                break;
            }
        }
        $template->render("add-product.php");
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
