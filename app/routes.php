<?php

use app\Core\Template;
use app\Model\Dvd;

$template = new Template();

$page = $_SERVER["REQUEST_URI"] ?? null;
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($page)
{
    case @"/":
        $template->render("product-list.php");
        break;
    case @"/addproduct":

        if ($requestMethod === "GET")
        {
            $template->render("add-product.php");
        }


        if ($requestMethod === "POST")
        {
            if ($_POST["product_type"] === "dvd")
            {
                $dvd = new Dvd();
                $dvd->setSku($_POST["sku"]);
                $dvd->setName($_POST["name"]);
                $dvd->setPrice($_POST["price"]);
                $dvd->setSize($_POST["size"]);
                $dvd->saveDvd();
            }


//            if ($_POST["product_type"] === "furniture")
//            {
//                //Todo
//            }
//
//            if ($_POST["product_type"] === "book")
//            {
//                //Todo
//            }
        }
        break;
    default:
        $template->render("_404.php");
        break;
}
