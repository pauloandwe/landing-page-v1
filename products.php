<?php
$products = [
    [
        'id' => 1,
        'name' => "Brownie Tradicional",
        'price' => 8.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Nosso clássico brownie com pedaços de chocolate belga",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.8,
        'reviews_count' => 89
    ],
    [
        'id' => 2,
        'name' => "Brownie no Pote Duplo Chocolate",
        'price' => 15.90,
        'old_price' => 18.90,
        'discount' => 15,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Uma explosão de sabor em cada colherada! Nosso brownie no pote combina a textura úmida e macia do brownie tradicional com camadas .",
        'features' => [
            'Ingredientes premium',
            'Sem conservantes', 
            'Validade: 7 dias refrigerado'
        ],
        'is_bestseller' => true,
        'is_featured' => true,
        'is_new' => false,
        'rating' => 4.9,
        'reviews_count' => 156,
        'stock_warning' => 'Não perca essa oportunidade!',
        'spotlight_category' => 'Edição Especial',
        'spotlight_badge' => 'NOSSO BEST-SELLER'
    ],
    [
        'id' => 3,
        'name' => "Brownie de Maracujá",
        'price' => 12.50,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie especial com cobertura de maracujá",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.7,
        'reviews_count' => 67
    ],
    [
        'id' => 4,
        'name' => "Brownie com Nozes",
        'price' => 20.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "A combinação perfeita de chocolate e nozes crocantes",
        'is_bestseller' => false,
        'is_featured' => true,
        'is_new' => false,
        'rating' => 4.8,
        'reviews_count' => 92,
        'badge' => 'MAIS VENDIDO'
    ],
    [
        'id' => 5,
        'name' => "Brownie de Doce de Leite",
        'price' => 13.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie recheado com doce de leite caseiro",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.6,
        'reviews_count' => 78
    ],
    [
        'id' => 6,
        'name' => "Kit Brownie Premium",
        'price' => 45.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores. Ideal para presentear ou surpreender em momentos especiais. Nosso kit é o presente perfeito!",
        'is_bestseller' => false,
        'is_featured' => true,
        'is_new' => true,
        'rating' => 4.8,
        'reviews_count' => 34,
        'badge' => 'LANÇAMENTO'
    ],
    [
        'id' => 7,
        'name' => "Brownie Nutella Especial",
        'price' => 16.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Uma combinação especial de sabores que vai surpreender seu paladar!",
        'is_bestseller' => false,
        'is_featured' => true,
        'is_new' => true,
        'rating' => 4.7,
        'reviews_count' => 23,
        'badge' => 'NOVIDADE'
    ],
    [
        'id' => 8,
        'name' => "Brownie Red Velvet",
        'price' => 14.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie com massa red velvet e cobertura de cream cheese",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.5,
        'reviews_count' => 45
    ],
    [
        'id' => 9,
        'name' => "Brownie Cookies & Cream",
        'price' => 15.50,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie com pedaços de biscoito oreo e creme",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.6,
        'reviews_count' => 56
    ],
    [
        'id' => 10,
        'name' => "Brownie Caramelo Salgado",
        'price' => 17.90,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie gourmet com cobertura de caramelo salgado",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.7,
        'reviews_count' => 38
    ],
    [
        'id' => 11,
        'name' => "Brownie Morango",
        'price' => 13.50,
        'image' => "https://www.academiaassai.com.br/sites/default/files/receita-de-brownie.jpg",
        'description' => "Brownie com pedaços de morango fresco e cobertura especial",
        'is_bestseller' => false,
        'is_featured' => false,
        'is_new' => false,
        'rating' => 4.4,
        'reviews_count' => 42
    ],
];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}