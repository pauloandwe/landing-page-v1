<div id="home">
    <section class="hero-section-first">
        <div class="container hero-container">
            <div class="hero-content">
                <img src="img/logo.jpg" class="hero-section-img" alt="Doces Cacau">
                <h2 class="lead-1">EXPERIMENTE!</h2>
                <h1 class="lead-2">BROWNIES DIVINOS</h1>
                <p class="hero-description">Descubra nossa seleção premium de brownies artesanais, feitos com
                    chocolate belga e receita exclusiva para momentos inesquecíveis.</p>
                <a href="/produtos" class="btn btn-lg btn-primary">Explorar Sabores</a>
            </div>

            <div class="gallery" id="gallery"></div>
        </div>
        <div class="wave-divider wave-white wave-invertida">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="brownie-showcase py-5">
        <div class="container">
            <h2 class="section-title">Descubra Nossas Delícias</h2>
            <p class="text-center mb-5">Brownies artesanais preparados com ingredientes selecionados e muito
                amor</p>

            <div class="brownie-gallery">
                <?php 
                $featuredItems = array_slice($products, 0, 7); 
                $largeItems = [1, 5]; 
                
                foreach ($featuredItems as $index => $product) {
                    $isLarge = in_array($index, $largeItems) ? 'large' : '';
                ?>
                <div class="brownie-item <?= $isLarge; ?>">
                    <a href="/produtos">
                        <div class="brownie-image">
                            <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
                            <div class="brownie-overlay">
                                <h4><?= $product['name']; ?></h4>
                                <p><?= $product['description']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>

            <div class="text-center mt-5">
                <a href="/produtos" class="btn-ver-todos">Ver Todos os Produtos</a>
            </div>
        </div>
    </section>


    <section class="info-highlight-section">
        <div class="wave-divider-top wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>

        <div class="parallax-bg"></div>

        <div class="container">
            <div class="info-cards-container">
                <div class="info-card" data-delay="0">
                    <div class="info-card-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3>Ingredientes Premium</h3>
                    <p>Chocolate belga 70% cacau e ingredientes frescos selecionados para um sabor incomparável.
                    </p>
                </div>

                <div class="info-card" data-delay="200">
                    <div class="info-card-icon">
                        <i class="fas fa-mortar-pestle"></i>
                    </div>
                    <h3>Receita Artesanal</h3>
                    <p>Cada brownie é produzido à mão em pequenos lotes, garantindo o controle de qualidade
                        perfeito.</p>
                </div>

                <div class="info-card" data-delay="400">
                    <div class="info-card-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3>Ocasiões Especiais</h3>
                    <p>Oferecemos kits personalizados para festas, eventos corporativos e momentos únicos.</p>
                </div>
            </div>

            <div class="cta-container">
                <a href="/produtos" class="cta-button">
                    <span>Descubra Nossos Sabores</span>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>
        </div>
        <div class="wave-divider wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>


    <section class="additional-info-section">
        <div class="container pb-5">
            <h2 class="section-title">Descubra Nossa Qualidade</h2>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="img-container position-relative">
                        <img src="img/brownie-artesanal.png" alt="Processo artesanal"
                            class="img-fluid rounded-3 shadow-lg">
                        <div
                            class="img-badge position-absolute bg-primary text-white py-2 px-4 rounded-pill shadow">
                            Feito à mão
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="additional-content">
                        <h3 class="mb-4"
                            style="color: var(--primary-color); font-family: 'Playfair Display', serif; font-weight: 700;">
                            Nosso Compromisso com a Excelência</h3>

                        <div class="mb-4">
                            <div class="d-flex mb-3">
                                <div class="feature-icon-sm me-3"
                                    style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Ingredientes Selecionados</h5>
                                    <p>Utilizamos apenas chocolates premium e ingredientes frescos e naturais em
                                        nossas receitas.</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="feature-icon-sm me-3"
                                    style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Produção Artesanal</h5>
                                    <p>Cada brownie é feito à mão com carinho e atenção aos detalhes para
                                        garantir perfeição.</p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="feature-icon-sm me-3"
                                    style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Experiência Única</h5>
                                    <p>Oferecemos não apenas um doce, mas uma experiência gastronômica completa
                                        para surpreender seu paladar.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="/quem-somos" class="btn-ver-todos">Saiba Mais Sobre Nós</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wave-divider wave-light">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="py-3" style="background-color: var(--light-color);">
        <div class="container">
            <h2 class="section-title">O Que Nossos Clientes Dizem</h2>

            <div class="testimonial-slider-container">
                <div id="testimonial-track" class="testimonial-track">
                </div>
            </div>
        </div>
    </section>
</div>