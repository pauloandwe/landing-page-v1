<div id="home">
    <section class="hero-section-first">
         <div class="hero-video-container">
        <video autoplay muted loop playsinline class="hero-video">
        <source src="video/video-back.mp4" type="video/mp4">            
            <div class="video-fallback"></div>
        </video>
        <div class="hero-video-overlay"></div>
    </div>
        <div class="container hero-container">
            <div class="hero-content">
                <img src="img/logo.jpg" class="hero-section-img" alt="Doces Cacau">
                <h2 class="lead-1">EXPERIMENTE HOJE!</h2>
                <h1 class="lead-2">OS MELHORES BROWNIES DA CIDADE</h1>
                <p class="hero-description">Descubra nossa seleção premium de brownies artesanais, feitos com
                    chocolate belga 70% cacau e receita exclusiva que derrete na boca e aquece a alma. Cada mordida é uma explosão de sabor!</p>

                <div class="hero-badge mb-4">
                    <span class="badge rounded-pill bg-light text-dark shadow-sm px-4 py-2">
                        <i class="fas fa-star me-1" style="color: #FFD700;"></i>
                        <span class="fw-bold">+2000 clientes satisfeitos</span>
                        <span class="ms-2">|</span>
                        <span class="ms-2"><i class="fas fa-heart me-1" style="color: var(--highlight-color);"></i> 97% de aprovação</span>
                    </span>
                </div>

                <a href="produtos" class="btn btn-lg btn-primary">Explorar Sabores <i class="fas fa-arrow-right ms-2"></i></a>

                <p class="delivery-info">
                    <i class="fas fa-truck me-2"></i> Entregamos em toda Campo Mourão e região!
                </p>
            </div>

            <div class="gallery" id="gallery">
            </div>
        </div>

        <div class="wave-divider wave-white wave-invertida">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="brand-story py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3 class="story-title">BROWNIES QUE AQUECEM A ALMA</h3>
                    <div class="divider mx-auto my-4"></div>
                    <p class="story-text">
                        Há mais de uma década, transformamos momentos comuns em experiências inesquecíveis através dos nossos brownies artesanais.
                        Cada receita nasce da paixão por sabores autênticos e do compromisso com ingredientes selecionados.
                        Nossos brownies não são apenas sobremesas — são abraços em forma de chocolate, capazes de espantar a tristeza
                        e trazer o aconchego que todo mundo merece.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="brownie-showcase py-5">
        <div class="container">
            <h2 class="section-title">Descubra Nossas Delícias</h2>
            <p class="text-center mb-5">Brownies artesanais preparados com ingredientes selecionados e muito
                amor para momentos que valem a pena</p>

           <div class="brownie-gallery">
                <?php
                $featuredItems = array_slice($products, 0, 7);
                $largeItems = [1, 5];

                foreach ($featuredItems as $index => $product) {
                    $isLarge = in_array($index, $largeItems) ? 'large' : '';
                    $badge = '';
                    
                    // Sistema de badges baseado nas propriedades do produto
                    if ($product['is_bestseller']) {
                        $badge = '<div class="product-badge">BEST SELLER</div>';
                    } elseif (isset($product['badge'])) {
                        $badgeClass = $product['is_new'] ? 'product-badge-new' : '';
                        $badge = '<div class="product-badge ' . $badgeClass . '">' . $product['badge'] . '</div>';
                    } elseif ($product['is_new']) {
                        $badge = '<div class="product-badge product-badge-new">NOVO SABOR</div>';
                    } elseif ($product['is_featured']) {
                        $badge = '<div class="product-badge" style="background-color: #4B2E2B;">DESTAQUE</div>';
                    }
                ?>
                    <div class="brownie-item <?= $isLarge; ?>" style="--i:<?= $index; ?>">
                        <a href="produtos">
                            <div class="brownie-image">
                                <?= $badge; ?>
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
                <a href="produtos" class="btn-ver-todos">Ver Todos os Produtos</a>
            </div>
        </div>
    </section>

    <section class="combo-cta-section">
    <div class="wave-divider-top wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
            <div class="container">
                <div class="combo-cta-card">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="combo-content">
                                <div class="combo-header">
                                    <span class="combo-badge">Oferta Especial</span>
                                    <h3 class="combo-title">Combo Degustação</h3>
                                    <p class="combo-subtitle">6 mini brownies com sabores únicos</p>
                                </div>
                                
                                <div class="combo-flavors">
                                    <span class="flavor-tag">Tradicional</span>
                                    <span class="flavor-tag">Nutella</span>
                                    <span class="flavor-tag">Maracujá</span>
                                    <span class="flavor-tag">Doce de Leite</span>
                                    <span class="flavor-tag">Nozes</span>
                                    <span class="flavor-tag">Morango</span>
                                </div>

                                <div class="combo-price-section">
                                    <div class="price-row">
                                        <span class="old-price">R$ 29,90</span>
                                        <span class="current-price">R$ 14,90</span>
                                        <span class="discount-tag">23% OFF</span>
                                    </div>
                                    <p class="price-info">Embalagem especial para presente incluída</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 text-center">
                            <div class="combo-cta-action">
                                <div class="combo-image-stack">
                                    <img src="img/products/product-13.png" alt="Combo Degustação" class="combo-img">
                                </div>
                                <a href="produtos" class="btn-ver-todos">
                                    <span>Quero Experimentar</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <p class="delivery-note">
                                    <i class="fas fa-truck"></i> Entrega rápida
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wave-divider wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
        </section>

    <section class="categories-section py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Para Cada Momento Especial</h2>
            <p class="text-center mb-5">Nossos brownies são perfeitos para qualquer ocasião, de presentes a eventos corporativos</p>

            <div class="row categories-grid">
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4>Presentes</h4>
                        <p>Surpreenda alguém especial com nossas caixas de brownies decoradas para qualquer ocasião.</p>
                        <div class="category-examples">
                            <span>Aniversários</span>
                            <span>Dia dos Namorados</span>
                            <span>Agradecimentos</span>
                        </div>
                        <a href="produtos" class="category-link">Ver opções <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <h4>Festas e Eventos</h4>
                        <p>Encomendas personalizadas com sua marca e em grandes quantidades para eventos inesquecíveis.</p>
                        <div class="category-examples">
                            <span>Casamentos</span>
                            <span>Formaturas</span>
                            <span>Aniversários</span>
                        </div>
                        <a href="produtos" class="category-link">Ver opções <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4>Corporativo</h4>
                        <p>Brownies personalizados com a logo da sua empresa, perfeitos como brindes e presentes.</p>
                        <div class="category-examples">
                            <span>Brindes</span>
                            <span>Reuniões</span>
                            <span>Coffee breaks</span>
                        </div>
                        <a href="produtos" class="category-link">Ver opções <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info-highlight-section">
        <div class="wave-divider-top wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="container">
            <div class="info-cards-container">
                <div class="info-card" data-delay="0">
                    <div class="info-card-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3>Ingredientes Premium</h3>
                    <p>Chocolate belga 70% cacau e ingredientes frescos selecionados para um sabor incomparável.</p>
                </div>

                <div class="info-card" data-delay="200">
                    <div class="info-card-icon">
                        <i class="fas fa-mortar-pestle"></i>
                    </div>
                    <h3>Receita Artesanal</h3>
                    <p>Cada brownie é produzido à mão em pequenos lotes, garantindo o controle de qualidade perfeito.</p>
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
                <a href="produtos" class="cta-button">
                    <span>Descubra Nossos Sabores</span>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>
        </div>

        <div class="wave-divider wave-white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="additional-info-section">
        <div class="container pb-5">
            <h2 class="section-title">Descubra Nossa Qualidade</h2>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="img-container position-relative">
                        <img src="img/brownie-artesanal.png" alt="Processo artesanal" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="additional-content">
                        <h3 class="mb-4" style="color: var(--primary-color); font-family: 'Playfair Display', serif; font-weight: 700;">
                            Nosso Compromisso com a Excelência</h3>

                        <div class="mb-4">
                            <div class="d-flex mb-3">
                                <div class="feature-icon-sm me-3" style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Ingredientes Selecionados</h5>
                                    <p>Utilizamos apenas chocolates premium e ingredientes frescos e naturais em nossas receitas, sem conservantes ou aditivos.</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="feature-icon-sm me-3" style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Produção Artesanal</h5>
                                    <p>Cada brownie é feito à mão com carinho e atenção aos detalhes para garantir uma textura macia por dentro e crocante por fora.</p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="feature-icon-sm me-3" style="color: var(--secondary-color); font-size: 1.5rem;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h5 style="color: var(--primary-color);">Experiência Única</h5>
                                    <p>Oferecemos não apenas um doce, mas uma experiência completa que transforma momentos comuns em memórias especiais para compartilhar com quem você ama.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="quem-somos" class="btn-ver-todos">Saiba Mais Sobre Nós</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wave-divider wave-light">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--light-color);">
        <div class="container">
            <h2 class="section-title">O Que Nossos Clientes Dizem</h2>
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="review-summary mb-4">
                        <div class="stars-average">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="review-count">4.9 de 5 estrelas com base em <strong>156 avaliações</strong></div>
                    </div>
                </div>
            </div>

            <div class="testimonial-slider-container">
                <div id="testimonial-track" class="testimonial-track">
                </div>
            </div>

            <div class="row corporate-clients mt-5">
                <div class="col-12 text-center mb-3">
                    <h5 class="text-muted">Empresas que confiam em nossos brownies:</h5>
                </div>
                <div class="col-12">
                    <div class="client-logos">
                        <img src="img/logos/logo-1.png" width="160px" alt="Cliente Corporativo 1" class="client-logo">
                        <img src="img/logos/logo-2.webp" width="160px" alt="Cliente Corporativo 2" class="client-logo">
                        <img src="img/logos/logo-3.webp" width="160px" alt="Cliente Corporativo 3" class="client-logo">
                        <img src="img/logos/logo-4.webp" width="160px" alt="Cliente Corporativo 4" class="client-logo">
                        <img src="img/logos/logo-5.png" width="160px" alt="Cliente Corporativo 5" class="client-logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="whatsapp-cta py-5 bg-white">
        <div class="container text-center">
            <h3 class="mb-3">Tem alguma dúvida? Fale conosco!</h3>
            <p class="mb-4">Entre em contato pelo WhatsApp para encomendas personalizadas, dúvidas ou sugestões.</p>
            <a href="https://wa.me/5511999988888?text=Ol%C3%A1%21%20Tenho%20interesse%20em%20fazer%20uma%20encomenda.%20Voc%C3%AAs%20poderiam%20me%20passar%20mais%20informa%C3%A7%C3%B5es%3F" class="btn btn-success btn-lg whatsapp-btn">
                <i class="fab fa-whatsapp me-2"></i> Conversar pelo WhatsApp
            </a>
        </div>
    </section>
</div>

<style>
.hero-video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    overflow: hidden;
}

.hero-video {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translateX(-50%) translateY(-50%);
    object-fit: cover;
}

.hero-video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: var(--primary-color);
    opacity: 0.7;
    z-index: 1;
}

.video-fallback {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/img/back-chocolate.png');
    background-size: cover;
    background-position: center;
    opacity: 0.2;
    display: none;
}

/* Responsividade móvel */
@media (max-width: 768px) {
    .hero-video {
        display: none;
    }
    
    .video-fallback {
        display: block !important;
    }
    
    .hero-video-overlay {
        background-color: var(--primary-color);
        opacity: 0.8;
    }
}

  /* ===== VARIÁVEIS CSS ===== */
:root {
    --primary-color: #4B2E2B;
    --secondary-color: #d4a76a;
    --light-color: #f8f3e9;
    --highlight-color: #f1a5a5;
    --dark-brown: #33201E;
    --cream: #fdf6e9;
}

/* ===== CONFIGURAÇÕES GERAIS ===== */
body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--light-color);
    overflow-x: hidden;
}

/* ===== ANIMATIONS & KEYFRAMES ===== */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* ===== BOTÕES BASE ===== */
.btn-primary, .cta-button, .btn-ver-todos {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transition: all 0.4s ease;
}

.btn-primary:hover, .btn-ver-todos:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: translateY(-5px);
}

/* ===== HERO SECTION ===== */
.hero-section-first {
    background-color: var(--primary-color);
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    min-height: 700px;
    display: flex;
    align-items: center;
    padding: 35px 0 80px 0;
}


.hero-container {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-section-img {
    width: 140px;
    height: 140px;
    border-radius: 70px;
    margin-bottom: 30px;
    border: 6px solid var(--cream);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.6s ease;
    animation: float 6s infinite ease-in-out;}

.hero-section-img:hover {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

.lead-1, .lead-2 {
    font-family: 'Playfair Display', serif;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    opacity: 0;
    animation-fill-mode: forwards;
}

.lead-1 {
    font-size: 2.8rem;
    font-weight: 700;
    margin-top: 0px;
    margin-bottom: 5px;
    letter-spacing: 2px;
    animation: fadeInUp 0.8s forwards 0.3s;
}

.lead-2 {
    font-size: 5rem;
    font-weight: 800;
    color: var(--highlight-color);
    margin-top: 0;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 1;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.8s forwards 0.6s;
}

.hero-description {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.25rem;
    font-weight: 300;
    margin-bottom: 35px;
    max-width: 600px;
    line-height: 1.7;
    opacity: 0;
    animation: fadeInUp 0.8s forwards 0.9s;
}

.hero-section-first .btn-primary {
    background-color: var(--highlight-color);
    border: none;
    color: var(--primary-color);
    font-weight: 600;
    padding: 14px 34px;
    font-size: 1.1rem;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 5px 15px rgba(241, 165, 165, 0.4);
    position: relative;
    overflow: hidden;
    margin-bottom: 40px;
}

.hero-section-first .btn-primary:before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.hero-section-first .btn-primary:hover {
    background-color: #fff;
    transform: translateY(-7px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.hero-section-first .btn-primary:hover:before {
    left: 100%;
}

.gallery {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-top: 30px;
    position: relative;
    width: 100%;
    opacity: 0;
    animation: fadeIn 1.5s forwards 1.5s;
}

.delivery-info {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
}

/* ===== HERO BADGE ===== */
.hero-badge {
    margin-top: 1.5rem;
}

.hero-badge .badge {
    font-size: 0.9rem;
    padding: 0.75rem 1.5rem;
}

/* ===== BRAND STORY ===== */
.brand-story {
    padding: 60px 0;
    background-color: white;
}

.story-title {
    color: var(--primary-color);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    margin-bottom: 25px;
    font-size: 2rem;
}

.story-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
}

.divider {
    height: 3px;
    width: 80px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 3px;
}

/* ===== BROWNIE SHOWCASE ===== */
.brownie-showcase {
    background-color: #fff;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.brownie-showcase:before, .brownie-showcase:after {
    content: '';
    position: absolute;
    background-color: var(--light-color);
    border-radius: 50%;
    opacity: 0.5;
}

.brownie-showcase:before {
    width: 300px;
    height: 300px;
    top: -150px;
    left: -150px;
}

.brownie-showcase:after {
    width: 200px;
    height: 200px;
    bottom: -100px;
    right: -100px;
}

.brownie-gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 30px;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.brownie-item {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    transform: translateY(50px);
    opacity: 0;
    animation: fadeInUp 0.8s forwards;
    animation-delay: calc(var(--i) * 0.1s);
}

.brownie-item.large {
    grid-column: span 2;
}

.brownie-item:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 20px 40px rgba(75, 46, 43, 0.15);
    z-index: 2;
}

.brownie-image {
    position: relative;
    overflow: hidden;
    height: 280px;
}

.brownie-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
}

.brownie-item:hover .brownie-image img {
    transform: scale(1.1);
}

.brownie-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(0deg, rgba(75, 46, 43, 0.9) 0%, rgba(75, 46, 43, 0.7) 60%, rgba(75, 46, 43, 0) 100%);
    color: white;
    padding: 30px;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.4s ease;
}

.brownie-overlay h4, .brownie-overlay p {
    transform: translateY(20px);
    transition: transform 0.5s ease;
}

.brownie-overlay h4 {
    margin-bottom: 10px;
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.5rem;
    transition-delay: 0.1s;
}

.brownie-overlay p {
    margin: 0;
    font-size: 1rem;
    transition-delay: 0.2s;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
}

.brownie-item:hover .brownie-overlay {
    opacity: 1;
    transform: translateY(0);
}

.brownie-item:hover .brownie-overlay h4,
.brownie-item:hover .brownie-overlay p {
    transform: translateY(0);
}

/* ===== PRODUCT BADGES ===== */
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
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.product-badge-new {
    background-color: #00a978;
}

.stock-warning {
    font-size: 0.85rem;
    color: var(--highlight-color);
    margin-top: 5px;
}

/* ===== COMBO CTA SECTION ===== */
.combo-cta-section {
    padding: 180px 0;
    background-color: var(--primary-color);
    color: white;
    position: relative;
    overflow: hidden;
}

.combo-cta-section:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('img/muitos-brownies.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    opacity: 0.2;
    z-index: 0;
}

.combo-cta-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
    border: 1px solid rgba(212, 167, 106, 0.2);
}

.combo-content {
    padding-right: 20px;
}

.combo-header {
    margin-bottom: 25px;
}

.combo-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--highlight-color), #ff8a8a);
    color: white;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(241, 165, 165, 0.3);
}

.combo-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 2.2rem;
    color: var(--primary-color);
    margin-bottom: 8px;
    line-height: 1.2;
}

.combo-subtitle {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 0;
}

.combo-flavors {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 25px;
}

.flavor-tag {
    background-color: var(--light-color);
    color: var(--primary-color);
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid rgba(212, 167, 106, 0.3);
    transition: all 0.3s ease;
}


.combo-price-section {
    background-color: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    border-left: 4px solid var(--secondary-color);
}

.price-row {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 8px;
}

.old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 1.1rem;
}

.current-price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
}

.discount-tag {
    background-color: #28a745;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.price-info {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0;
    display: flex;
    align-items: center;
}

.price-info:before {
    content: '✓';
    color: var(--secondary-color);
    font-weight: bold;
    margin-right: 8px;
}

.combo-cta-action {
    padding-left: 20px;
}

.combo-image-stack {
    position: relative;
    margin-bottom: 25px;
    display: inline-block;
}

.combo-img {
    width: 200px;
    height: 200px;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.combo-cta-action:hover .combo-img {
    transform: scale(1.05) rotate(2deg);
}

.combo-image-stack:before {
    content: '🔥';
    position: absolute;
    top: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--highlight-color), #ff8a8a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    z-index: 2;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.combo-cta-btn {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 16px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    box-shadow: 0 10px 30px rgba(75, 46, 43, 0.3);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    margin-bottom: 15px;
    position: relative;
    overflow: hidden;
}

.combo-cta-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.combo-cta-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(75, 46, 43, 0.4);
    color: white;
}

.combo-cta-btn:hover:before {
    left: 100%;
}

.combo-cta-btn i {
    margin-left: 10px;
    transition: transform 0.3s ease;
}

.combo-cta-btn:hover i {
    transform: translateX(5px);
}

.delivery-note {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 15px;
}

.delivery-note i {
    color: var(--secondary-color);
}

/* ===== CATEGORIES SECTION ===== */
.categories-section {
    padding: 80px 0;
    background-color: white;
}

.categories-grid {
    margin-top: 30px;
}

.category-card {
    background-color: white;
    border-radius: 15px;
    padding: 30px;
    height: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    border-bottom: 4px solid var(--secondary-color);
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.category-card:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    z-index: 1;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.category-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    color: white;
    font-size: 28px;
    transition: all 0.4s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.1) rotate(10deg);
}

.category-card h4 {
    color: var(--primary-color);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.category-card p {
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
}

.category-examples {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
}

.category-examples span {
    background-color: var(--light-color);
    font-size: 0.75rem;
    padding: 5px 12px;
    border-radius: 50px;
    color: var(--primary-color);
}

.category-link {
    color: var(--secondary-color);
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s;
}

.category-link i {
    margin-left: 5px;
    transition: transform 0.3s;
}

.category-link:hover {
    color: var(--primary-color);
}

.category-link:hover i {
    transform: translateX(5px);
}

/* ===== SECTION TITLES ===== */
.section-title {
    color: var(--primary-color);
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 40px;
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 2.8rem;
    font-weight: 700;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 3px;
}

/* ===== BUTTONS ===== */
.btn-ver-todos {
    padding: 15px 40px;
    font-size: 1.1rem;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 8px 20px rgba(75, 46, 43, 0.2);
    font-weight: 600;
    display: inline-block;
    text-decoration: none;
}

.btn-ver-todos:hover {
    background-color: var(--secondary-color);
    box-shadow: 0 12px 25px rgba(75, 46, 43, 0.25);
    color: var(--primary-color);
}

.cta-button {
    display: inline-flex;
    align-items: center;
    background-color: var(--highlight-color);
    color: var(--dark-brown);
    padding: 16px 36px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 10px 25px rgba(241, 165, 165, 0.5);
    position: relative;
    overflow: hidden;
    border: 2px solid transparent;
}

.cta-button span, .cta-button i {
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.cta-button i {
    margin-left: 10px;
}

.cta-button:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background-color: white;
    transition: all 0.4s ease;
    z-index: 0;
}

.cta-button:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(241, 165, 165, 0.7);
    border-color: var(--highlight-color);
    color: var(--primary-color);
}

.cta-button:hover:before {
    width: 100%;
}

.cta-button:hover i {
    transform: translateX(5px);
}

/* ===== WAVES ===== */
.wave-section {
    position: relative;
    padding-bottom: 70px; 
}

.wave-section-bottom {
    position: relative;
    margin-top: -70px;
    padding-top: 70px;
}

.wave-divider, .wave-divider-small, .wave-divider-top {
    position: absolute;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    z-index: 1;
}

.wave-divider {
    bottom: 0;
    left: 0;
}

.wave-divider-small {
    top: 465px;
    left: 0;
}

.wave-divider-top {
    top: 0;
    left: 0;
    margin-top: -2px;
}

.wave-invertida {
    transform: rotate(180deg) translateY(-1px);
}

.wave-divider svg, .wave-divider-small svg, .wave-divider-top svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 70px;
}

.wave-white .shape-fill {
    fill: white;
}

.wave-light .shape-fill {
    fill: var(--light-color);
}

.wave-primary .shape-fill {
    fill: var(--primary-color);
}

/* ===== INFO HIGHLIGHT SECTION ===== */
.info-highlight-section {
    position: relative;
    padding: 140px 0;
    overflow: hidden;
    background-color: var(--primary-color);
    color: white;
}

.info-highlight-section:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('img/back-bro.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    opacity: 0.2;
    z-index: 0;
}

.info-cards-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}

.info-card {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 40px 30px;
    text-align: center;
    flex: 1;
    min-width: 280px;
    max-width: 350px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    transform: translateY(50px);
    opacity: 0;
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.8s ease;
    position: relative;
    border-bottom: 5px solid var(--highlight-color);
}

.info-card.visible {
    transform: translateY(0);
    opacity: 1;
}

.info-card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 25px;
    color: white;
    font-size: 32px;
    box-shadow: 0 10px 20px rgba(75, 46, 43, 0.3);
    transition: transform 0.5s ease;
}

.info-card:hover .info-card-icon {
    transform: scale(1.1) rotate(10deg);
}

.info-card h3 {
    color: var(--primary-color);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 20px;
}

.info-card p {
    color: #555;
    line-height: 1.7;
    font-size: 1.05rem;
    margin-bottom: 0;
}

.cta-container {
    text-align: center;
    margin-top: 30px;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease 0.6s;
    position: relative;
    z-index: 1;
}

.cta-container.visible {
    opacity: 1;
    transform: translateY(0);
}

/* ===== ADDITIONAL INFO SECTION ===== */
.additional-info-section {
    position: relative;
    background-color: #ffff;
    overflow: hidden;
    padding-bottom: 65px;
}

.img-container {
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease;
}

.img-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.img-container img {
    transition: transform 0.7s ease;
}

.img-container:hover img {
    transform: scale(1.05);
}

.img-badge {
    bottom: 20px;
    right: -15px;
    background-color: var(--primary-color);
    color: white;
    font-weight: 600;
    letter-spacing: 1px;
    transform: rotate(-2deg);
    transition: all 0.4s ease;
}

.img-container:hover .img-badge {
    transform: rotate(0deg) translateY(-5px);
    background-color: var(--secondary-color);
}

.additional-content {
    padding: 0 20px;
}

.feature-icon-sm {
    transition: transform 0.4s ease;
}

.d-flex:hover .feature-icon-sm {
    transform: scale(1.2) rotate(5deg);
    color: var(--highlight-color);
}

/* ===== TESTIMONIALS ===== */
.testimonial-section {
    background-color: var(--light-color);
    padding: 80px 0;
    position: relative;
}

.testimonial-section:before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 40%;
    height: 100%;
    background-image: url('https://images.unsplash.com/photo-1511381939415-e44015466834?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80');
    background-size: cover;
    background-position: center;
    opacity: 0.1;
}

.testimonial-slider-container {
    overflow: hidden;
    position: relative;
    padding: 30px 0;
    margin: 0 auto;
}

.testimonial-track {
    display: flex;
    position: relative;
    transition: transform 0.1s ease;
}

.testimonial-card {
    flex: 0 0 350px;
    background-color: white;
    border-radius: 16px;
    padding: 30px;
    margin: 0 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    display: flex;
    flex-direction: column;
    min-height: 260px;
    transition: all 0.4s ease;
    transform: scale(0.95);
}

.testimonial-card:hover {
    transform: translateY(-10px) scale(1);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.testimonial-avatar {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.testimonial-avatar img {
    width: 80px;
    height: 80px;
    border: 4px solid var(--secondary-color);
    border-radius: 50%;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
}

.testimonial-card:hover .testimonial-avatar img {
    transform: scale(1.1);
    border-color: var(--highlight-color);
}

.testimonial-content {
    flex-grow: 1;
    text-align: center;
}

.testimonial-rating {
    color: var(--secondary-color);
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 15px;
    color: #555;
    line-height: 1.7;
    font-size: 1.1rem;
}

.testimonial-author {
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0;
    font-size: 1.1rem;
}

/* ===== REVIEW SUMMARY ===== */
.review-summary {
    display: inline-block;
    background-color: white;
    padding: 15px 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.stars-average {
    font-size: 1.5rem;
    color: #FFD700;
    margin-bottom: 5px;
}

.review-count {
    color: #555;
}

.corporate-clients {
    margin-top: 50px;
}

.client-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.client-logo {
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s;
}

.client-logo:hover {
    filter: grayscale(0);
    opacity: 1;
}

/* ===== WHATSAPP CTA ===== */
.whatsapp-cta {
    padding: 60px 0;
    background-color: white;
}

.whatsapp-btn {
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1.1rem;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    transition: all 0.3s;
}

.whatsapp-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(37, 211, 102, 0.4);
}

/* ===== MEDIA QUERIES ===== */
@media (min-width: 1940px) {
    .lead-2 {
        font-size: 190px;
    }
}

@media (min-width: 992px) {
    .hero-container {
        flex-direction: row;
        text-align: left;
        padding: 0 40px;
    }

    .hero-content {
        text-align: left;
        width: 60%;
        padding-right: 40px;
    }

    .lead-1 {
        font-size: 3rem;
    }

    .lead-2 {
        font-size: 5.5rem;
    }

    .gallery {
        width: 40%;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
}

@media (max-width: 991px) {
    .hero-section-first {
        padding-top: 100px;
    }
    
    .lead-1 {
        font-size: 2.2rem;
    }

    .lead-2 {
        font-size: 4rem;
    }

    .hero-section-img {
        width: 120px;
        height: 120px;
    }

    .brownie-gallery {
        grid-template-columns: repeat(2, 1fr);
    }

    .brownie-item.large {
        grid-column: auto;
    }

    .combo-title {
        font-size: 1.8rem;
    }

    .combo-content {
        padding-right: 0;
        margin-bottom: 30px;
    }

    .combo-cta-action {
        padding-left: 0;
    }
}

@media (max-width: 767px) {
    .lead-1 {
        font-size: 2rem;
    }

    .lead-2 {
        font-size: 3.5rem;
    }

    .hero-description {
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 2.2rem;
    }

    .testimonial-card {
        flex: 0 0 300px;
        padding: 25px;
        min-height: 240px;
    }

    .category-card {
        margin-bottom: 20px;
    }
}

@media (max-width: 576px) {
    .lead-1 {
        font-size: 1.8rem;
    }

    .lead-2 {
        font-size: 3rem;
    }

    .hero-section-first {
        padding: 100px 0px 60px 0px;
    }

    .brownie-gallery {
        grid-template-columns: 1fr;
    }

    .brownie-image img,
    .brownie-item.large .brownie-image img {
        height: 250px;
    }

    .testimonial-card {
        flex: 0 0 280px;
        padding: 20px;
        min-height: 220px;
    }

    .testimonial-avatar img {
        width: 70px;
        height: 70px;
    }

    .testimonial-text {
        font-size: 1rem;
    }
    
    .info-highlight-section {
        padding: 80px 0;
    }
    
    .info-card {
        flex: 1 0 100%;
        max-width: 100%;
        margin: 0 15px;
    }
    
    .cta-button {
        padding: 14px 30px;
        font-size: 1rem;
    }

    .combo-cta-card {
        padding: 25px 20px;
    }

    .combo-title {
        font-size: 1.6rem;
        text-align: center;
    }

    .combo-subtitle {
        text-align: center;
        margin-bottom: 20px;
    }

    .combo-badge {
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }

    .combo-flavors {
        justify-content: center;
        margin-bottom: 20px;
    }

    .flavor-tag {
        font-size: 0.8rem;
        padding: 6px 12px;
    }

    .current-price {
        font-size: 1.6rem;
    }

    .combo-img {
        width: 150px;
        height: 150px;
    }

    .combo-cta-btn {
        padding: 14px 28px;
        font-size: 1rem;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientLogos = document.querySelectorAll('.client-logo');
        setTimeout(() => {
            clientLogos.forEach((logo, index) => {
                setTimeout(() => {
                    logo.style.opacity = '0.6';
                    logo.style.transform = 'translateY(0)';
                }, index * 200);
            });
        }, 500);
    });
    document.addEventListener('DOMContentLoaded', function() {
    // Otimização do vídeo de fundo
    const heroVideo = document.querySelector('.hero-video');
    const videoFallback = document.querySelector('.video-fallback');
    
    if (heroVideo) {
        // Verifica conexão lenta
        if ('connection' in navigator && navigator.connection.effectiveType === 'slow-2g') {
            heroVideo.style.display = 'none';
            if (videoFallback) videoFallback.style.display = 'block';
        }
        
        // Fallback para erro no vídeo
        heroVideo.addEventListener('error', function() {
            this.style.display = 'none';
            if (videoFallback) videoFallback.style.display = 'block';
        });
        
        // Pausa quando página não está visível
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                heroVideo.pause();
            } else {
                heroVideo.play().catch(console.log);
            }
        });
    }
});
</script>