<?php

use app\Core\Template;

$template = new Template();

$page = $_SERVER["REQUEST_URI"] ?? null;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$response = http_response_code();

switch ($page)
{
    case @"/":
        return $template->render("product-list.php");
    case @"/addproduct":
        if ($requestMethod === "GET")
        {
            return $template->render("add-product.php", );
        }

        if ($requestMethod === "POST")
        {
            // Todo
        }

        break;
    case $page ?? null:
        return $template->render("_404.php");

}