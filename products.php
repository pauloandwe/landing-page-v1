<?php
$products = [
    [
        'id' => 1,
        'name' => "Brownie Tradicional",
        'price' => 8.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Nosso clássico brownie com pedaços de chocolate belga"
    ],
    [
        'id' => 2,
        'name' => "Brownie com Nozes",
        'price' => 10.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "A combinação perfeita de chocolate e nozes crocantes"
    ],
    [
        'id' => 3,
        'name' => "Brownie de Maracujá",
        'price' => 12.50,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie especial com cobertura de maracujá"
    ],
    [
        'id' => 4,
        'name' => "Brownie no Pote",
        'price' => 15.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Deliciosa combinação de brownie com creme e toppings"
    ],
    [
        'id' => 5,
        'name' => "Brownie de Doce de Leite",
        'price' => 13.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie recheado com doce de leite caseiro"
    ],
    [
        'id' => 6,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 7,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ]
];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}
?>