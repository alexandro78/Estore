<?php

session()->flash('success', 'Product added to cart successfully!');

// Получить все размеры для конкретного товара
$product = Product::find(1);
$sizes = $product->sizes;

// Получить все товары для конкретного размера
$size = Size::find(1);
$products = $size->products;


// Контроллер
$product = Product::find(1);
$sizes = $product->sizes;
return view('product_details', compact('product', 'sizes'));


//example implementation breadcrumsps 
class RouteNode {
    public $name;
    public $url;
    public $children = [];

    public function __construct($name, $url) {
        $this->name = $name;
        $this->url = $url;
    }
}

function generateBreadcrumbs($node, $currentPage) {
    $segments = explode('/', trim($currentPage, '/'));
    $breadcrumbs = '<ul class="breadcrumbs">';

    $url = '/';
    $currentNode = $node;

    foreach ($segments as $segment) {
        if (isset($currentNode->children[$segment])) {
            $currentNode = $currentNode->children[$segment];
            $url .= $segment . '/';
            $breadcrumbs .= '<li><a href="' . $url . '">' . $currentNode->name . '</a></li>';
        }
    }

    $breadcrumbs .= '</ul>';
    return $breadcrumbs;
}

// Построение дерева маршрутов (как в предыдущих примерах)

// Получение текущего URL
$currentPage = $_SERVER['REQUEST_URI'];

// Генерация дробных крошек на основе текущего URL
echo generateBreadcrumbs($routes, $currentPage);
////////////////////////////////////////////////////////////////////////