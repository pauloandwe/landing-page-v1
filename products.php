<?php
$products = [
    [
        'id' => 1,
        'name' => "Brownie Tradicional",
        'price' => 8.90,
        'image' => "https://bolosparavender.com/wp-content/uploads/2019/07/bolo-de-churros-no-pote-1200x900.jpg",
        'description' => "Nosso clássico brownie com pedaços de chocolate belga"
    ],
    [
        'id' => 2,
        'name' => "Brownie com Nozes com Morango",
        'price' => 20.90,
        'image' => "https://www.minhareceita.com.br/app/uploads/2025/01/Design_sem_nome_8-990x480.webp",
        'description' => "A combinação perfeita de chocolate e nozes crocantes"
    ],
    [
        'id' => 3,
        'name' => "Brownie de Maracujá",
        'price' => 12.50,
        'image' => "https://dabisa.com.br/wp-content/uploads/2024/06/Bolo-de-Pote-Dois-amores-doces-bolos-sobremesas-dabisasabores-vilamatilde-vilacarrao-analiafranco-tatuape-zonalestebolo-zonalestedoces-1.jpeg",
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
        'image' => "https://guiadacozinha.com.br/wp-content/uploads/2019/11/Bolo-de-brigadeiro-branco-com-frutas-vermelhas.jpg",
        'description' => "Brownie recheado com doce de leite caseiro"
    ],
    [
        'id' => 6,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 7,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 8,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 9,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 10,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
    [
        'id' => 11,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2020/07/13/bolo-pote-maracuja.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ],
];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}
?>
