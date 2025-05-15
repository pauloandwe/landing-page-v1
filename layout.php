<?php
require_once 'products.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doces Cacau - Chocolates Artesanais</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">SOMOS APAIXONADOS POR BROWNIES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'home' ? 'active' : '' ?>" href="/home">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'quem-somos' ? 'active' : '' ?>" href="/quem-somos">QUEM SOMOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'produtos' ? 'active' : '' ?>" href="/produtos">PRODUTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'contato' ? 'active' : '' ?>" href="/contato">CONTATO</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="preloader">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>

    <main id="page-content">
        <?php
        // Carregar a página solicitada
        $page_file = "pages/{$page}.php";
        if (file_exists($page_file)) {
            include $page_file;
        } else if ($page === '404') {
            include 'pages/404.php';
        } else {
            echo "<div class='container py-5'><h2>Página não encontrada</h2></div>";
        }
        ?>
    </main>

    <!-- Modal para produtos -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                    <h5 class="modal-title" id="productModalLabel">Selecione seus produtos</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fas fa-info-circle me-2" style="color: var(--secondary-color);"></i>
                                Selecione os produtos e a quantidade desejada para fazer seu pedido
                            </div>
                        </div>
                    </div>

                    <div id="product-list" class="row">
                    </div>

                    <hr class="my-4">

                    <div id="order-summary" class="mt-4">
                        <h5 class="mb-3" style="color: var(--primary-color); font-weight: 600;">Resumo do Pedido</h5>
                        <div id="selected-products" class="mb-3">
                            <p class="text-muted">Nenhum produto selecionado</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5>Total:</h5>
                            <h5 id="total-price">R$ 0,00</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="send-whatsapp" type="button" class="btn btn-success" disabled>
                        <i class="fab fa-whatsapp me-2"></i>Pedir pelo WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Doces Cacau</h4>
                    <p>Transformando o cacau em momentos de felicidade desde 2010. Nossos chocolates artesanais são
                        feitos com paixão e os melhores ingredientes.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Contato</h4>
                    <ul class="list-unstyled footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> Rua das Flores, 123 - São Paulo</li>
                        <li><i class="fas fa-phone"></i> (11) 9999-8888</li>
                        <li><i class="fas fa-envelope"></i> contato@docescacau.com.br</li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Links Rápidos</h4>
                    <ul class="list-unstyled footer-links">
                        <li><a href="/home">Home</a></li>
                        <li><a href="/quem-somos">Quem Somos</a></li>
                        <li><a href="/produtos">Produtos</a></li>
                        <li><a href="/loja">Loja Virtual</a></li>
                        <li><a href="/contato">Contato</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Doces Cacau. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <div class="whatsapp-button">
        <a href="https://wa.me/5511999988888?text=Ol%C3%A1%21%20Tenho%20interesse%20em%20fazer%20uma%20encomenda%20para%20um%20evento.%20Voc%C3%AAs%20poderiam%20me%20passar%20mais%20informa%C3%A7%C3%B5es%3F"
            target="_blank" rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <script>
        const products = <?= json_encode($products); ?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>