<div id="loja">
    <section class="hero-section hero-section-product">
        <div class="container">
            <h1 class="display-4 fw-bold">Loja Virtual</h1>
            <p class="lead">Escolha seus brownies favoritos e faça seu pedido</p>
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
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="alert alert-light border" role="alert">
                        <i class="fas fa-info-circle me-2" style="color: var(--secondary-color);"></i>
                        Selecione os produtos e a quantidade desejada para fazer seu pedido
                    </div>
                </div>
            </div>

            <div class="row" id="shop-product-list">
                <?php foreach ($products as $product) { ?>
                <div class="col-md-4 mb-4">
                    <div class="product-card-modal" data-id="<?= $product['id']; ?>">
                        <div class="product-image-modal" style="background-image: url('<?= $product['image']; ?>');"></div>
                        <div class="product-info-modal">
                            <h4 class="product-title-modal"><?= $product['name']; ?></h4>
                            <p class="product-price-modal">R$ <?= number_format($product['price'], 2, ',', '.'); ?></p>
                            <p class="small text-muted"><?= $product['description']; ?></p>
                            <div class="quantity-control">
                                <button class="quantity-btn decrease" data-id="<?= $product['id']; ?>">-</button>
                                <input type="number" class="quantity-input" data-id="<?= $product['id']; ?>" value="0" min="0" max="20">
                                <button class="quantity-btn increase" data-id="<?= $product['id']; ?>">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow-sm">
                        <div class="card-header text-white" style="background-color: var(--primary-color);">
                            <h5 class="mb-0">Resumo do Pedido</h5>
                        </div>
                        <div class="card-body">
                            <div id="shop-selected-products" class="mb-3">
                                <p class="text-muted">Nenhum produto selecionado</p>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3">
                                <h5>Total:</h5>
                                <h5 id="shop-total-price">R$ 0,00</h5>
                            </div>
                            <div class="text-center mt-4">
                                <button id="shop-send-whatsapp" type="button" class="btn btn-success btn-lg" disabled>
                                    <i class="fab fa-whatsapp me-2"></i>Finalizar Pedido pelo WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let shopCart = [];
        let shopTotal = 0;

        function setupQuantityControls() {
            document.querySelectorAll('#shop-product-list .increase').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const input = document.querySelector(`#shop-product-list .quantity-input[data-id="${productId}"]`);
                    let currentValue = parseInt(input.value);
                    
                    if (currentValue < 20) {
                        input.value = currentValue + 1;
                        updateShopCart(productId, currentValue + 1);
                    }
                });
            });

            document.querySelectorAll('#shop-product-list .decrease').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const input = document.querySelector(`#shop-product-list .quantity-input[data-id="${productId}"]`);
                    let currentValue = parseInt(input.value);
                    
                    if (currentValue > 0) {
                        input.value = currentValue - 1;
                        updateShopCart(productId, currentValue - 1);
                    }
                });
            });

            document.querySelectorAll('#shop-product-list .quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-id');
                    let currentValue = parseInt(this.value);
                    
                    if (isNaN(currentValue) || currentValue < 0) {
                        currentValue = 0;
                        this.value = 0;
                    } else if (currentValue > 20) {
                        currentValue = 20;
                        this.value = 20;
                    }
                    
                    updateShopCart(productId, currentValue);
                });
            });
        }

        function updateShopCart(productId, quantity) {
            productId = parseInt(productId);
            const product = products.find(p => p.id === productId);
            const existingItem = shopCart.find(item => item.id === productId);

            if (quantity > 0) {
                if (existingItem) {
                    existingItem.quantity = quantity;
                } else {
                    shopCart.push({
                        id: productId,
                        name: product.name,
                        price: product.price,
                        quantity: quantity
                    });
                }
            } else if (existingItem) {
                shopCart = shopCart.filter(item => item.id !== productId);
            }

            updateShopOrderSummary();
        }

        function updateShopOrderSummary() {
            const selectedProductsElement = document.getElementById('shop-selected-products');
            const totalPriceElement = document.getElementById('shop-total-price');
            const whatsappButton = document.getElementById('shop-send-whatsapp');

            if (!selectedProductsElement || !totalPriceElement || !whatsappButton) return;

            selectedProductsElement.innerHTML = '';
            shopTotal = 0;

            if (shopCart.length === 0) {
                selectedProductsElement.innerHTML = '<p class="text-muted">Nenhum produto selecionado</p>';
                whatsappButton.disabled = true;
            } else {
                shopCart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    shopTotal += itemTotal;
                    
                    const productElement = document.createElement('div');
                    productElement.className = 'selected-product-item';
                    productElement.innerHTML = `
                        <div>
                            <span class="fw-bold">${item.quantity}x</span> ${item.name}
                        </div>
                        <div>
                            R$ ${itemTotal.toFixed(2).replace('.', ',')}
                        </div>
                    `;
                    
                    selectedProductsElement.appendChild(productElement);
                });
                
                whatsappButton.disabled = false;
            }

            totalPriceElement.textContent = `R$ ${shopTotal.toFixed(2).replace('.', ',')}`;
        }

        document.getElementById('shop-send-whatsapp').addEventListener('click', function() {
            if (shopCart.length === 0) return;

            let message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";

            shopCart.forEach(item => {
                message += `• ${item.quantity}x ${item.name} - R$ ${(item.price * item.quantity).toFixed(2).replace('.', ',')}\n`;
            });

            message += `\nTotal: R$ ${shopTotal.toFixed(2).replace('.', ',')}`;
            message += "\n\nPor favor, poderia me confirmar este pedido e informar o prazo de entrega?";

            const encodedMessage = encodeURIComponent(message);
            const whatsappNumber = "5511999988888";
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

            window.open(whatsappUrl, '_blank');
        });

        setupQuantityControls();
    });
    </script>
</div>