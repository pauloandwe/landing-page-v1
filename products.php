<?php
$products = [
    [
        'id' => 1,
        'name' => "Brownie Tradicional",
        'price' => 8.90,
        'image' => "https://t3.ftcdn.net/jpg/02/69/57/22/360_F_269572238_Ke3L7nzIgvoftjLHGgnqFdTknRw5mWUw.jpg",
        'description' => "Nosso clássico brownie com pedaços de chocolate belga"
    ],
    [
        'id' => 2,
        'name' => "Brownie com Nozes",
        'price' => 10.90,
        'image' => "https://deliciasfit.com/wp-content/uploads/2023/02/d8f177db40.jpg",
        'description' => "A combinação perfeita de chocolate e nozes crocantes"
    ],
    [
        'id' => 3,
        'name' => "Brownie de Maracujá",
        'price' => 12.50,
        'image' => "https://www.receiteria.com.br/wp-content/uploads/120246860_356739658701595_3960607736628361468_n.jpg",
        'description' => "Brownie especial com cobertura de maracujá"
    ],
    [
        'id' => 4,
        'name' => "Brownie no Pote",
        'price' => 15.90,
        'image' => "https://www.unileverfoodsolutions.com.br/dam/global-ufs/mcos/SLA/calcmenu/recipes/BR-recipes/desserts-&-bakery/bolo-de-pote/main-header.jpg",
        'description' => "Deliciosa combinação de brownie com creme e toppings"
    ],
    [
        'id' => 5,
        'name' => "Brownie de Doce de Leite",
        'price' => 13.90,
        'image' => "https://s2-receitas.glbimg.com/t-nEwSx0ID4S2KCPg_Ufle4vNRo=/0x0:1037x1280/810x0/smart/filters:strip_icc()/s.glbimg.com/po/rc/media/2014/02/28/11_58_51_363_brownie_.jpg",
        'description' => "Brownie recheado com doce de leite caseiro"
    ],
    [
        'id' => 6,
        'name' => "Kit Brownie (6 unidades)",
        'price' => 45.90,
        'image' => "https://media.istockphoto.com/id/1130692246/photo/homemade-chocolate-brownies-shot-from-above.jpg?s=612x612&w=0&k=20&c=vwXHR_DXORJNqHA8ufMhD38y4YqfPvChZioxT0bZjQQ=",
        'description' => "Kit com 6 brownies sortidos para experimentar todos os sabores"
    ]
];

// Se for acessado diretamente, retorna os dados em formato JSON
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}
?>