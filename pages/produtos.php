<div id="produtos">
    <section class="hero-section hero-section-product">
        <div class="container">
            <h1 class="display-4 fw-bold">Nossos Produtos</h1>
            <p class="lead">Conheça nossa linha exclusiva de chocolates artesanais</p>
        </div>
        <div class="wave-divider-small wave-white wave-invertida">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Brownies Especiais</h2>
            <div class="row">
                <?php 
                // Exibe os primeiros 3 produtos
                foreach (array_slice($products, 0, 3) as $product) { 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image" style="background-image: url('<?= $product['image']; ?>');">
                        </div>
                        <div class="product-info">
                            <h4 class="product-title"><?= $product['name']; ?></h4>
                            <p class="product-description"><?= $product['description']; ?></p>
                            <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>
                            <a href="/loja" class="btn btn-sm btn-primary shop-button">Comprar</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--light-color);">
        <div class="container">
            <h2 class="section-title">Outros Produtos</h2>
            <div class="row">
                <?php 
                // Exibe o restante dos produtos
                foreach (array_slice($products, 3) as $product) { 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image" style="background-image: url('<?= $product['image']; ?>');">
                        </div>
                        <div class="product-info">
                            <h4 class="product-title"><?= $product['name']; ?></h4>
                            <p class="product-description"><?= $product['description']; ?></p>
                            <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>
                            <a href="/loja" class="btn btn-sm btn-primary shop-button">Comprar</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>