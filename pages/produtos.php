<?php
// Encontrar o produto best seller
$bestseller = null;
foreach ($products as $product) {
    if ($product['is_bestseller']) {
        $bestseller = $product;
        break;
    }
}

// Separar produtos por categoria
$featured_products = array_filter($products, function($product) {
    return $product['is_featured'] && !$product['is_bestseller'];
});

$other_products = array_filter($products, function($product) {
    return !$product['is_featured'] && !$product['is_bestseller'];
});
?>

<div id="produtos">
    <section class="hero-section hero-section-product">
        <div class="container">
            <h1 class="display-4 fw-bold">BROWNIES IRRESISTÍVEIS</h1>
            <p class="lead">Descubra os sabores que fazem nossos clientes voltarem sempre</p>

            <div class="hero-badge">
                <span class="badge rounded-pill bg-light text-dark shadow-sm px-4 py-2 mb-4">
                    <i class="fas fa-star me-1" style="color: #FFD700;"></i>
                    <span class="fw-bold">+2000 clientes satisfeitos</span>
                    <span class="ms-2">|</span>
                    <span class="ms-2"><i class="fas fa-heart me-1" style="color: var(--highlight-color);"></i> 97% de aprovação</span>
                </span>
            </div>
        </div>
        <div class="wave-divider-small wave-white wave-invertida">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <?php if ($bestseller): ?>
    <section class="py-5 bg-white spotlight-section">
        <div class="container">
            <div class="spotlight-product">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="spotlight-image">
                            <img src="<?= $bestseller['image']; ?>" alt="<?= $bestseller['name']; ?>" class="img-fluid shadow">
                            <div class="spotlight-badge"><?= $bestseller['spotlight_badge']; ?></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="spotlight-content">
                            <span class="spotlight-category"><?= $bestseller['spotlight_category']; ?></span>
                            <h2 class="spotlight-title"><?= $bestseller['name']; ?></h2>
                            <div class="spotlight-rating">
                                <?php 
                                $rating = $bestseller['rating'];
                                $fullStars = floor($rating);
                                $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                
                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                if ($hasHalfStar) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                }
                                ?>
                                <span class="ms-2"><?= $rating; ?> (<?= $bestseller['reviews_count']; ?> avaliações)</span>
                            </div>
                            <p class="spotlight-description">
                                <?= $bestseller['description']; ?>
                            </p>
                            
                            <?php if (isset($bestseller['features'])): ?>
                            <p class="spotlight-features">
                                <?php foreach ($bestseller['features'] as $feature): ?>
                                <span><i class="fas fa-check-circle"></i> <?= $feature; ?></span>
                                <?php endforeach; ?>
                            </p>
                            <?php endif; ?>
                            
                            <div class="spotlight-price-box">
                                <div class="d-flex align-items-end">
                                    <span class="spotlight-price">R$ <?= number_format($bestseller['price'], 2, ',', '.'); ?></span>
                                    <?php if (isset($bestseller['old_price'])): ?>
                                    <span class="spotlight-old-price ms-2">R$ <?= number_format($bestseller['old_price'], 2, ',', '.'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if (isset($bestseller['discount'])): ?>
                                <span class="spotlight-discount"><?= $bestseller['discount']; ?>% OFF</span>
                                <?php endif; ?>
                            </div>
                            <div class="spotlight-actions">
                                <button class="btn btn-lg btn-primary shop-button" data-product-id="<?= $bestseller['id']; ?>">
                                    <i class="fas fa-shopping-bag me-2"></i> Comprar agora
                                </button>
                                <?php if (isset($bestseller['stock_warning'])): ?>
                                <div class="spotlight-stock">
                                    <i class="fas fa-exclamation-circle"></i> <?= $bestseller['stock_warning']; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="py-5 bg-white products-grid-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Brownies Especiais</h2>
                <p class="section-subtitle text-center mb-5">Receitas exclusivas que derretem na boca e aquecem a alma</p>
            </div>

            <div class="row">
                <?php
                $featured_slice = array_slice($featured_products, 0, 3);
                foreach ($featured_slice as $product) {
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="product-card product-card-enhanced">
                            <?php if (isset($product['badge'])): ?>
                                <div class="product-badge <?= $product['is_new'] ? 'product-badge-new' : '' ?>"><?= $product['badge']; ?></div>
                            <?php endif; ?>

                            <div class="product-image" style="background-image: url('<?= $product['image']; ?>');">
                                <div class="product-quick-actions">
                                    <button class="btn-quick-view" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="shop-button btn-add-cart" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-shopping-basket"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-info">
                                <div class="product-rating">
                                    <?php 
                                    $rating = $product['rating'];
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    if ($hasHalfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    // Preencher estrelas vazias se necessário
                                    $totalStars = $fullStars + ($hasHalfStar ? 1 : 0);
                                    for ($i = $totalStars; $i < 5; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </div>
                                <h4 class="product-title"><?= $product['name']; ?></h4>
                                <p class="product-description">
                                    <?= $product['description']; ?>
                                </p>

                                <div class="product-price-box">
                                    <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>

                                    <?php if ($product['price'] > 15): ?>
                                        <span class="product-installment">ou 2x de R$ <?= number_format($product['price'] / 2, 2, ',', '.'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-action">
                                    <a href="loja" class="btn btn-primary shop-button btn-product"><i class="fas fa-shopping-bag me-2"></i>Comprar</a>
                                    <button class="btn-wishlist" data-bs-toggle="tooltip" title="Adicionar aos favoritos">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--light-color);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Outros Sabores Irresistíveis</h2>
                <p class="section-subtitle text-center mb-5">Conheça toda nossa linha e encontre seu brownie favorito</p>
            </div>

            <div class="row" id="outros-sabores-container">
                <?php
                $other_slice = array_slice($other_products, 0, 3);
                $hidden_products = array_slice($other_products, 3);

                foreach ($other_slice as $product) {
                ?>
                    <div class="col-md-4 mb-4 product-item">
                        <div class="product-card product-card-enhanced">
                            <?php if (isset($product['badge'])): ?>
                                <div class="product-badge <?= $product['is_new'] ? 'product-badge-new' : '' ?>"><?= $product['badge']; ?></div>
                            <?php endif; ?>

                            <div class="product-image" style="background-image: url('<?= $product['image']; ?>');">
                                <div class="product-quick-actions">
                                    <button class="btn-quick-view" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="shop-button btn-add-cart" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-shopping-basket"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-info">
                                <div class="product-rating">
                                    <?php 
                                    $rating = $product['rating'];
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    if ($hasHalfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    $totalStars = $fullStars + ($hasHalfStar ? 1 : 0);
                                    for ($i = $totalStars; $i < 5; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </div>
                                <h4 class="product-title"><?= $product['name']; ?></h4>

                                <p class="product-description">
                                    <?= $product['description']; ?>
                                </p>

                                <div class="product-price-box">
                                    <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>

                                    <?php if ($product['price'] > 15): ?>
                                        <span class="product-installment">ou 3x de R$ <?= number_format($product['price'] / 3, 2, ',', '.'); ?> sem juros</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-action">
                                    <a href="loja" class="btn btn-primary shop-button btn-product"><i class="fas fa-shopping-bag me-2"></i>Comprar</a>
                                    <button class="btn-wishlist" data-bs-toggle="tooltip" title="Adicionar aos favoritos">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php
                foreach ($hidden_products as $product) {
                ?>
                    <div class="col-md-4 mb-4 product-item product-item-hidden" style="display: none;">
                        <div class="product-card product-card-enhanced">
                            <?php if (isset($product['badge'])): ?>
                                <div class="product-badge <?= $product['is_new'] ? 'product-badge-new' : '' ?>"><?= $product['badge']; ?></div>
                            <?php endif; ?>

                            <div class="product-image" style="background-image: url('<?= $product['image']; ?>');">
                                <div class="product-quick-actions">
                                    <button class="btn-quick-view" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="shop-button btn-add-cart" data-product-id="<?= $product['id']; ?>">
                                        <i class="fas fa-shopping-basket"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-info">
                                <div class="product-rating">
                                    <?php 
                                    $rating = $product['rating'];
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    if ($hasHalfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    $totalStars = $fullStars + ($hasHalfStar ? 1 : 0);
                                    for ($i = $totalStars; $i < 5; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </div>
                                <h4 class="product-title"><?= $product['name']; ?></h4>

                                <p class="product-description">
                                    <?= $product['description']; ?>
                                </p>

                                <div class="product-price-box">
                                    <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>

                                    <?php if ($product['price'] > 15): ?>
                                        <span class="product-installment">ou 3x de R$ <?= number_format($product['price'] / 3, 2, ',', '.'); ?> sem juros</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-action">
                                    <a href="loja" class="btn btn-primary shop-button btn-product"><i class="fas fa-shopping-bag me-2"></i>Comprar</a>
                                    <button class="btn-wishlist" data-bs-toggle="tooltip" title="Adicionar aos favoritos">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if (count($hidden_products) > 0): ?>
                <div class="text-center mt-4" id="ver-mais-container">
                    <button class="btn-ver-mais-produtos" id="btn-ver-mais">
                        <span class="btn-text">Ver Mais Produtos</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </button>
                    <p class="mt-2 text-muted small">
                        Mostrando <?= count($other_slice); ?> de <?= count($other_products); ?> produtos
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-5 bg-white testimonial-product-section">
        <div class="container">
            <h2 class="section-title">O que nossos clientes dizem</h2>

            <div class="row mt-4">
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-product-card">
                        <div class="testimonial-product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-product-text">
                            "Os brownies da Doces Cacau são simplesmente divinos! Encomendei para o aniversário da minha filha e todos os convidados ficaram impressionados. A textura macia por dentro e crocante por fora é perfeita."
                        </p>
                        <div class="testimonial-product-author">
                            <img src="https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg" alt="Cliente" class="testimonial-product-avatar">
                            <div>
                                <p class="testimonial-product-name">Mariana Silva</p>
                                <p class="testimonial-product-date">Cliente desde 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-product-card">
                        <div class="testimonial-product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-product-text">
                            "Nunca provei brownies tão deliciosos! O de Nutella com nozes é o meu favorito. Cada mordida é uma explosão de sabor. Agora sou cliente fiel e sempre peço para eventos especiais."
                        </p>
                        <div class="testimonial-product-author">
                            <img src="https://i.pinimg.com/originals/76/b2/79/76b2799fcd3c8b77e6e0e83a98af8657.jpg" alt="Cliente" class="testimonial-product-avatar">
                            <div>
                                <p class="testimonial-product-name">Rafael Oliveira</p>
                                <p class="testimonial-product-date">Cliente desde 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-product-card">
                        <div class="testimonial-product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="testimonial-product-text">
                            "Os bolos de pote são maravilhosos! Pedi o kit para experimentar todos os sabores e foi difícil escolher o favorito. A entrega foi rápida e os produtos chegaram muito bem embalados!"
                        </p>
                        <div class="testimonial-product-author">
                            <img src="https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg" alt="Cliente" class="testimonial-product-avatar">
                            <div>
                                <p class="testimonial-product-name">Juliana Santos</p>
                                <p class="testimonial-product-date">Cliente desde 2021</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NOVO: Seção FAQ -->
    <section class="py-5" style="background-color: var(--light-color);">
        <div class="container">
            <h2 class="section-title">Perguntas Frequentes</h2>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Qual a validade dos brownies?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Nossos brownies têm validade de 7 dias quando mantidos em geladeira. Os brownies tradicionais podem ser conservados em temperatura ambiente por até 3 dias em local fresco. Já os brownies no pote devem ser mantidos sempre refrigerados.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Como funcionam as entregas?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Realizamos entregas em toda Campo Mourão capital. O prazo de entrega varia de 24h a 48h após a confirmação do pedido. Para regiões centrais, oferecemos entrega no mesmo dia para pedidos feitos até as 12h. Pedidos para outras cidades são enviados via transportadora.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Vocês fazem brownies personalizados para eventos?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Sim! Temos uma linha especial para eventos como casamentos, aniversários e corporativos. Oferecemos embalagens personalizadas e podemos adaptar as receitas conforme sua necessidade. Entre em contato pelo WhatsApp para um orçamento personalizado.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white final-cta-section">
        <div class="container text-center">
            <h2 class="mb-4">Pronto para experimentar?</h2>
            <p class="lead mb-4">Peça agora e receba em casa esse prazer incomparável!</p>
            <a href="loja" class="btn btn-lg btn-primary px-5 py-3 cta-shop-link">
                <i class="fas fa-shopping-bag me-2"></i> Fazer Pedido
            </a>
            <p class="mt-3 text-muted">
                <i class="fas fa-truck me-2"></i> Entrega rápida para toda Campo Mourão
            </p>
        </div>
    </section>

    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <img src="" alt="" class="img-fluid rounded" id="quickview-image">
                        </div>
                        <div class="col-md-6">
                            <h4 id="quickview-title" class="mb-3"></h4>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3" id="quickview-stars">
                                </div>
                                <span id="quickview-rating"></span>
                            </div>
                            <p id="quickview-description" class="mb-4"></p>
                            <h5 class="mb-3" id="quickview-price"></h5>
                            <div class="d-flex align-items-center">
                                <div class="input-group me-3" style="width: 130px;">
                                    <button class="btn btn-outline-secondary" type="button" id="quickview-decrease">-</button>
                                    <input type="text" class="form-control text-center" value="1" id="quickview-quantity">
                                    <button class="btn btn-outline-secondary" type="button" id="quickview-increase">+</button>
                                </div>
                                <button class="btn btn-primary" id="quickview-add-to-cart">
                                    <i class="fas fa-cart-plus me-2"></i>Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-badge {
        margin-top: 1.5rem;
    }

    .category-filter-section {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .filter-pills {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .filter-pill-btn {
        background-color: #f8f3e9;
        color: var(--primary-color);
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        display: inline-block;
        transition: all 0.3s;
    }

    .filter-pills li.active .filter-pill-btn,
    .filter-pill-btn:hover {
        background-color: var(--primary-color);
        color: white;
    }

    .special-offer {
        background-color: #f1a5a5;
        color: var(--primary-color);
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-block;
    }

    .spotlight-product {
        background-color: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 0;
    }

    .spotlight-image {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .spotlight-image img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        transition: transform 0.6s;
    }

    .spotlight-product:hover .spotlight-image img {
        transform: scale(1.05);
    }

    .spotlight-badge {
        position: absolute;
        top: 20px;
        left: -5px;
        background-color: var(--highlight-color);
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .spotlight-badge:before {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        border-top: 5px solid #d68787;
        border-left: 5px solid transparent;
    }

    .spotlight-content {
        padding: 1.5rem;
    }

    .spotlight-category {
        color: var(--secondary-color);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .spotlight-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }

    .spotlight-rating {
        color: #FFD700;
        margin-bottom: 1rem;
    }

    .spotlight-description {
        font-size: 1rem;
        color: #555;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .spotlight-features {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .spotlight-features span {
        display: inline-flex;
        align-items: center;
        background-color: #f8f8f8;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #444;
    }

    .spotlight-features i {
        color: var(--secondary-color);
        margin-right: 0.5rem;
    }

    .spotlight-price-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .spotlight-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .spotlight-old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 1.2rem;
    }

    .spotlight-discount {
        background-color: #e7f9f5;
        color: #00a978;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .spotlight-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .spotlight-stock {
        color: #ef6c6c;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .spotlight-stock i {
        margin-right: 0.5rem;
    }

    .product-card-enhanced {
        background-color: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card-enhanced:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 10;
    }

    .product-badge-new {
        background-color: #00a978;
    }

    .product-image {
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }

    .product-quick-actions {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(75, 46, 43, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .product-card-enhanced:hover .product-quick-actions {
        opacity: 1;
    }

    .btn-quick-view,
    .btn-add-cart {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: white;
        color: var(--primary-color);
        display: flex;
        justify-content: center;
        align-items: center;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-add-cart {
        background-color: var(--highlight-color);
        color: white;
    }

    .btn-quick-view:hover,
    .btn-add-cart:hover {
        transform: scale(1.1);
    }

    .product-info {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-rating {
        color: #FFD700;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .product-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.25rem;
    }

    .product-description {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 15px;
        flex: 1;
    }

    .product-price-box {
        margin-bottom: 20px;
    }

    .product-price {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    .product-installment {
        color: #777;
        font-size: 0.85rem;
    }

    .product-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .btn {
        border-radius: 20px;
    }

    .btn-product {
        border-radius: 50px;
        width: 200px;
        padding: 10px 0;
        font-size: 18px;
    }

    .btn-wishlist {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f5f5f5;
        color: #777;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s;
    }

    .btn-wishlist:hover {
        background-color: #ffedee;
        color: #ff5c6c;
    }

    .btn-wishlist:hover i {
        transform: scale(1.2);
    }

    .promo-banner {
        background-color: var(--primary-color);
        color: white;
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .promo-banner:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://images.unsplash.com/photo-1606312619070-d48b4c652a52?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        z-index: 0;
    }

    .promo-title {
        font-family: 'Oswald', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .promo-description {
        font-size: 1.2rem;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
    }

    .promo-badge {
        display: inline-block;
        background-color: white;
        color: var(--primary-color);
        padding: 5px 15px;
        border-radius: 50px;
        font-weight: 600;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .promo-btn {
        position: relative;
        z-index: 1;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
    }

    .promo-image {
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        max-height: 250px;
        position: relative;
        z-index: 1;
    }

    .testimonial-product-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .testimonial-product-rating {
        color: #FFD700;
        margin-bottom: 15px;
    }

    .testimonial-product-text {
        color: #555;
        font-style: italic;
        margin-bottom: 20px;
        line-height: 1.7;
    }

    .testimonial-product-author {
        display: flex;
        align-items: center;
    }

    .testimonial-product-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
        border: 3px solid var(--secondary-color);
    }

    .testimonial-product-name {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0;
    }

    .testimonial-product-date {
        color: #777;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .accordion-item {
        border: none;
        margin-bottom: 15px;
        border-radius: 10px !important;
        overflow: hidden;
    }

    .accordion-button {
        background-color: #fff;
        color: var(--primary-color);
        font-weight: 600;
        padding: 20px 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    .accordion-button::after {
        background-size: 16px;
    }

    .accordion-body {
        padding: 20px 25px;
        color: #555;
    }

    .final-cta-section {
        background-color: #fff;
        position: relative;
    }

    .cta-shop-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        transition: all 0.4s ease;
        z-index: 2;
    }

    .cta-shop-link:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-ver-mais-produtos {
        background-color: var(--primary-color);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 20px rgba(75, 46, 43, 0.2);
        transition: all 0.4s ease;
        cursor: pointer;
        position: relative;
    }

    .btn-ver-mais-produtos:hover {
        background-color: var(--secondary-color);
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(75, 46, 43, 0.25);
    }

    .btn-ver-mais-produtos:active {
        transform: translateY(-2px);
    }

    .btn-ver-mais-produtos.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-ver-mais-produtos i {
        transition: transform 0.3s ease;
    }

    .btn-ver-mais-produtos:hover i {
        transform: translateY(3px);
    }

    .product-item-hidden {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .product-item-hidden.show {
        opacity: 1;
        transform: translateY(0);
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #ver-mais-container {
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    @media (max-width: 767px) {
        .spotlight-title {
            font-size: 1.8rem;
        }

        .spotlight-price {
            font-size: 1.5rem;
        }

        .product-action {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }

        .product-action .btn {
            width: 100%;
        }

        .btn-wishlist {
            margin-left: auto;
        }
    }

    #quickViewModal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }

    #quickViewModal .modal-body {
        padding: 20px 30px 30px;
    }

    #quickViewModal .btn-close {
        position: absolute;
        right: 20px;
        top: 20px;
        z-index: 10;
        background-color: white;
        opacity: 1;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    #quickview-image {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    #quickview-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.8rem;
    }

    #quickview-description {
        color: #555;
        line-height: 1.7;
    }

    #quickview-price {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.8rem;
    }

    #quickview-quantity {
        border-color: #ddd;
    }

    #quickview-add-to-cart {
        padding-left: 25px;
        padding-right: 25px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        const quickViewBtns = document.querySelectorAll('.btn-quick-view');

        quickViewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const product = products.find(p => p.id == productId);

                if (product) {
                    document.getElementById('quickview-image').src = product.image;
                    document.getElementById('quickview-title').textContent = product.name;
                    document.getElementById('quickview-description').textContent = product.description;
                    document.getElementById('quickview-price').textContent = `R$ ${product.price.toFixed(2).replace('.', ',')}`;
                    document.getElementById('quickview-quantity').value = 1;
                    
                    // Atualizar estrelas
                    const starsContainer = document.getElementById('quickview-stars');
                    const rating = product.rating || 4.5;
                    const fullStars = Math.floor(rating);
                    const hasHalfStar = (rating - fullStars) >= 0.5;
                    
                    let starsHTML = '';
                    for (let i = 0; i < fullStars; i++) {
                        starsHTML += '<i class="fas fa-star text-warning"></i>';
                    }
                    if (hasHalfStar) {
                        starsHTML += '<i class="fas fa-star-half-alt text-warning"></i>';
                    }
                    const totalStars = fullStars + (hasHalfStar ? 1 : 0);
                    for (let i = totalStars; i < 5; i++) {
                        starsHTML += '<i class="far fa-star text-warning"></i>';
                    }
                    
                    starsContainer.innerHTML = starsHTML;
                    document.getElementById('quickview-rating').textContent = `(${rating})`;

                    quickViewModal.show();
                }
            });
        });

        document.getElementById('quickview-increase').addEventListener('click', function() {
            const input = document.getElementById('quickview-quantity');
            let value = parseInt(input.value);
            if (value < 20) input.value = value + 1;
        });

        document.getElementById('quickview-decrease').addEventListener('click', function() {
            const input = document.getElementById('quickview-quantity');
            let value = parseInt(input.value);
            if (value > 1) input.value = value - 1;
        });

        document.getElementById('quickview-add-to-cart').addEventListener('click', function() {
            const title = document.getElementById('quickview-title').textContent;
            const product = products.find(p => p.name === title);
            const quantity = parseInt(document.getElementById('quickview-quantity').value);

            if (product && quantity > 0) {
                cart = [{
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: quantity
                }];

                setTimeout(() => {
                    document.querySelectorAll('.quantity-input').forEach(input => {
                        if (parseInt(input.getAttribute('data-id')) === product.id) {
                            input.value = quantity;
                        } else {
                            input.value = 0;
                        }
                    });

                    quickViewModal.hide();

                    setTimeout(() => {
                        if (typeof productModal !== 'undefined') {
                            updateOrderSummary();
                            productModal.show();
                        }
                    }, 300);
                }, 300);
            }
        });

        const filterPills = document.querySelectorAll('.filter-pill-btn');
        filterPills.forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.filter-pills li.active').classList.remove('active');
                this.parentElement.classList.add('active');
            });
        });

        const addToCartBtns = document.querySelectorAll('.btn-add-cart');
        addToCartBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const productId = this.getAttribute('data-product-id');
                const product = products.find(p => p.id == productId);

                if (product) {
                    cart = [{
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        quantity: 1
                    }];

                    setTimeout(() => {
                        document.querySelectorAll('.quantity-input').forEach(input => {
                            if (parseInt(input.getAttribute('data-id')) === product.id) {
                                input.value = 1;
                            } else {
                                input.value = 0;
                            }
                        });

                        if (typeof productModal !== 'undefined') {
                            updateOrderSummary();
                            productModal.show();
                        }
                    }, 300);
                }
            });
        });

        // Funcionalidade do botão "Ver Mais Produtos"
        const btnVerMais = document.getElementById('btn-ver-mais');
        const verMaisContainer = document.getElementById('ver-mais-container');

        if (btnVerMais) {
            btnVerMais.addEventListener('click', function() {
                const button = this;
                const hiddenProducts = document.querySelectorAll('.product-item-hidden');

                button.classList.add('loading');
                button.querySelector('.btn-text').textContent = 'Carregando...';

                hiddenProducts.forEach((product, index) => {
                    setTimeout(() => {
                        product.style.display = 'block';
                        requestAnimationFrame(() => {
                            product.classList.add('show');
                        });
                    }, index * 200);
                });

                setTimeout(() => {
                    verMaisContainer.style.opacity = '0';
                    verMaisContainer.style.transform = 'translateY(-20px)';

                    setTimeout(() => {
                        verMaisContainer.style.display = 'none';
                    }, 500);
                }, hiddenProducts.length * 200 + 500);
            });
        }
    });
</script>