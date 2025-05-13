$(document).ready(function() {
    
    // Inicialização da página
    $('#home').addClass('active');
    $('a[data-page="home"]').addClass('active');
    
    // Navegação entre páginas via SPA
    $('a[data-page]').on('click', function(e) {
        e.preventDefault();
        
        var pageId = $(this).data('page');
        
        $('.page').removeClass('active');
        $('.nav-link').removeClass('active');
        
        $('a[data-page="' + pageId + '"]').addClass('active');
        $('#' + pageId).addClass('active');
        
        window.scrollTo(0, 0);
    });
    
    // Efeito na navbar ao scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('bg-white').css('box-shadow', '0 2px 4px rgba(0,0,0,0.1)');
        } else {
            $('.navbar').removeClass('bg-white').css('box-shadow', 'none');
        }
    });
    
    // Manipulação do formulário de contato
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        alert('Mensagem enviada com sucesso! Em breve entraremos em contato.');
        this.reset();
    });

    // Animações na seção de informações
    setTimeout(animateInfoSection, 150);
    window.addEventListener('scroll', animateInfoSection, {passive: true});
    
    // Inicializa os elementos do modal de produtos
    initProductModal();
});

// Função para garantir que o preloader seja removido
function removePreloader() {
    $('.preloader').addClass('fade-out');
    
    // Certifica-se de que o preloader é completamente removido após a animação
    setTimeout(function() {
        $('.preloader').css('display', 'none');
    }, 1000);
}

// Tentativa de remoção do preloader pelo evento load tradicional
$(window).on('load', function() {
    removePreloader();
});

// Remoção forçada do preloader após 2 segundos, mesmo se outros métodos falharem
setTimeout(function() {
    removePreloader();
}, 2000);

// Depoimentos
const testimonials = [
    {
        id: 1,
        avatar: "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
        rating: 5,
        text: "Os brownies da Cacau são simplesmente divinos! A textura macia por dentro e crocante por fora é perfeita.",
        author: "Mariana Silva"
    },
    {
        id: 2,
        avatar: "https://i.pinimg.com/originals/76/b2/79/76b2799fcd3c8b77e6e0e83a98af8657.jpg",
        rating: 5,
        text: "Encomendei para o aniversário da minha filha e todos os convidados ficaram impressionados! Super recomendo!",
        author: "Rafael Oliveira"
    },
    {
        id: 3,
        avatar: "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
        rating: 5,
        text: "Nunca provei brownies tão deliciosos! O de Nutella com nozes é o meu favorito. Simplesmente perfeito!",
        author: "Juliana Santos"
    },
    {
        id: 4,
        avatar: "https://i.pinimg.com/originals/76/b2/79/76b2799fcd3c8b77e6e0e83a98af8657.jpg",
        rating: 4.5,
        text: "Sou cliente fiel há mais de um ano e posso dizer que são os melhores brownies da cidade!",
        author: "Carlos Mendes"
    },
    {
        id: 5,
        avatar: "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
        rating: 5,
        text: "Cada mordida é uma explosão de sabor! Os brownies são úmidos e extremamente saborosos.",
        author: "Fernanda Lima"
    }
];

// Função para criar estrelas de avaliação
function createRatingStars(rating) {
    let starsHTML = '';
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    
    for (let i = 0; i < fullStars; i++) {
        starsHTML += '<i class="fas fa-star"></i>';
    }
    
    if (hasHalfStar) {
        starsHTML += '<i class="fas fa-star-half-alt"></i>';
    }
    
    return starsHTML;
}

// Função para criar cartões de depoimentos
function createTestimonialCard(testimonial) {
    return `
        <div class="testimonial-card" data-id="${testimonial.id}">
            <div class="testimonial-avatar">
                <img src="${testimonial.avatar}" alt="Cliente ${testimonial.id}" class="rounded-circle">
            </div>
            <div class="testimonial-content">
                <div class="testimonial-rating">
                    ${createRatingStars(testimonial.rating)}
                </div>
                <p class="testimonial-text">"${testimonial.text}"</p>
                <p class="testimonial-author">${testimonial.author}</p>
            </div>
        </div>
    `;
}

// Inicializa o carrossel de depoimentos
document.addEventListener('DOMContentLoaded', function() {
    // Força a remoção do preloader quando o DOM estiver pronto
    // removePreloader();
    
    const track = document.getElementById('testimonial-track');
    const container = document.querySelector('.testimonial-slider-container');
    
    if (track) {
        let isPaused = false;
        let animationSpeed = 1; 
        let position = 0;
        let animationId = null;
        
        function initCarousel() {
            // Adiciona os depoimentos ao carrossel
            for (let i = 0; i < 3; i++) {
                testimonials.forEach(testimonial => {
                    track.innerHTML += createTestimonialCard(testimonial);
                });
            }
            
            startAnimation();
            
            // Pausa a animação ao passar o mouse
            container.addEventListener('mouseenter', () => {
                isPaused = true;
            });
            
            container.addEventListener('mouseleave', () => {
                isPaused = false;
            });
            
            // Reinicia a animação ao voltar para a página home
            $('a[data-page="home"]').on('click', function() {
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                position = 0;
                track.style.transform = `translateX(0px)`;
                startAnimation();
            });
        }
        
        function startAnimation() {
            const cardWidth = 350; // Largura do cartão + margem
            const trackWidth = testimonials.length * cardWidth;
            
            function animate() {
                if (!isPaused) {
                    position -= animationSpeed;
                    
                    if (Math.abs(position) >= trackWidth) {
                        position = 0;
                    }
                    
                    track.style.transform = `translateX(${position}px)`;
                }
                
                animationId = requestAnimationFrame(animate);
            }
            
            animationId = requestAnimationFrame(animate);
        }
        
        initCarousel();
    }
});

// Verifica se um elemento está visível na viewport
function isElementInViewport(el) {
    if (!el) return false;
    
    const rect = el.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.85
    );
}

// Anima a seção de informações
function animateInfoSection() {
    const infoCards = document.querySelectorAll('.info-card');
    infoCards.forEach(card => {
        if (isElementInViewport(card) && !card.classList.contains('visible')) {
            const delay = parseInt(card.getAttribute('data-delay') || 0);
            setTimeout(() => {
                card.classList.add('visible');
            }, delay);
        }
    });
    
    const ctaContainer = document.querySelector('.cta-container');
    if (ctaContainer && isElementInViewport(ctaContainer) && !ctaContainer.classList.contains('visible')) {
        ctaContainer.classList.add('visible');
    }
}

// Reset das animações ao navegar
document.addEventListener('DOMContentLoaded', function() {
    const homeLinks = document.querySelectorAll('a[data-page="home"]');
    homeLinks.forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.info-card').forEach(card => {
                card.classList.remove('visible');
            });
            
            const ctaContainer = document.querySelector('.cta-container');
            if (ctaContainer) {
                ctaContainer.classList.remove('visible');
            }
            
            setTimeout(animateInfoSection, 100);
        });
    });
});

// ================= MODAL DE PRODUTOS =================

// Dados dos produtos
const products = [
  {
    id: 1,
    name: "Brownie Tradicional",
    price: 8.90,
    image: "https://t3.ftcdn.net/jpg/02/69/57/22/360_F_269572238_Ke3L7nzIgvoftjLHGgnqFdTknRw5mWUw.jpg",
    description: "Nosso clássico brownie com pedaços de chocolate belga"
  },
  {
    id: 2,
    name: "Brownie com Nozes",
    price: 10.90,
    image: "https://deliciasfit.com/wp-content/uploads/2023/02/d8f177db40.jpg",
    description: "A combinação perfeita de chocolate e nozes crocantes"
  },
  {
    id: 3,
    name: "Brownie de Maracujá",
    price: 12.50,
    image: "https://www.receiteria.com.br/wp-content/uploads/120246860_356739658701595_3960607736628361468_n.jpg",
    description: "Brownie especial com cobertura de maracujá"
  },
  {
    id: 4,
    name: "Brownie no Pote",
    price: 15.90,
    image: "https://www.unileverfoodsolutions.com.br/dam/global-ufs/mcos/SLA/calcmenu/recipes/BR-recipes/desserts-&-bakery/bolo-de-pote/main-header.jpg",
    description: "Deliciosa combinação de brownie com creme e toppings"
  },
  {
    id: 5,
    name: "Brownie de Doce de Leite",
    price: 13.90,
    image: "https://s2-receitas.glbimg.com/t-nEwSx0ID4S2KCPg_Ufle4vNRo=/0x0:1037x1280/810x0/smart/filters:strip_icc()/s.glbimg.com/po/rc/media/2014/02/28/11_58_51_363_brownie_.jpg",
    description: "Brownie recheado com doce de leite caseiro"
  },
  {
    id: 6,
    name: "Kit Brownie (6 unidades)",
    price: 45.90,
    image: "https://media.istockphoto.com/id/1130692246/photo/homemade-chocolate-brownies-shot-from-above.jpg?s=612x612&w=0&k=20&c=vwXHR_DXORJNqHA8ufMhD38y4YqfPvChZioxT0bZjQQ=",
    description: "Kit com 6 brownies sortidos para experimentar todos os sabores"
  }
];

// Variáveis do modal de produtos
let cart = [];
let total = 0;
let productModal;

// Inicializa o modal de produtos
function initProductModal() {
  // Cria e adiciona o HTML do modal ao body
  const modalHTML = `
  <!-- Modal de Produtos -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header" style="background-color: var(--primary-color); color: white;">
          <h5 class="modal-title" id="productModalLabel">Selecione seus produtos</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <!-- Os produtos serão carregados via JavaScript -->
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

  <style>
    /* Ajustes para posicionamento centralizado da modal */
    .modal-dialog-centered {
      display: flex;
      align-items: center;
      min-height: calc(100% - 1rem);
    }
    
    /* Garante que a modal tenha scroll interno quando for muito grande */
    .modal-dialog-scrollable .modal-content {
      max-height: calc(100vh - 60px);
      overflow: hidden;
    }
    
    .modal-dialog-scrollable .modal-body {
      overflow-y: auto;
    }
    
    /* Ajuste para corrigir posicionamento em dispositivos móveis */
    @media (max-width: 576px) {
      .modal-dialog-centered {
        min-height: calc(100% - 3.5rem);
      }
    }
    
    .product-card-modal {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
      margin-bottom: 20px;
      border: 1px solid #eee;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    
    .product-card-modal:hover {
      transform: translateY(-5px);
    }
    
    .product-image-modal {
      height: 150px;
      background-size: cover;
      background-position: center;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .product-info-modal {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    
    .product-title-modal {
      color: var(--primary-color);
      font-weight: 600;
      font-size: 1.1rem;
      margin-bottom: 5px;
    }
    
    .product-price-modal {
      color: var(--secondary-color);
      font-weight: 700;
      font-size: 1.15rem;
      margin-bottom: 15px;
    }
    
    .quantity-control {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: auto;
      padding-top: 10px;
    }
    
    .quantity-btn {
      background-color: var(--light-color);
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s;
      color: var(--primary-color);
    }
    
    .quantity-btn:hover {
      background-color: var(--secondary-color);
      color: white;
    }
    
    .quantity-input {
      width: 50px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin: 0 10px;
      height: 30px;
    }
    
    .selected-product-item {
      padding: 10px;
      border-radius: 8px;
      background-color: var(--light-color);
      margin-bottom: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    #total-price {
      color: var(--primary-color);
      font-weight: 700;
    }
    
    #send-whatsapp {
      background-color: #25D366;
      border-color: #25D366;
      font-weight: 600;
    }
    
    #send-whatsapp:hover {
      background-color: #20BA5C;
      border-color: #20BA5C;
    }
    
    /* Impede o scroll da página quando modal está aberta */
    body.modal-open {
      overflow: hidden;
      padding-right: 17px; /* Compensação para a barra de rolagem */
    }
  </style>`;

  // Adiciona o modal ao body se ele ainda não existir
  if (!document.getElementById('productModal')) {
    const modalElement = document.createElement('div');
    modalElement.innerHTML = modalHTML;
    document.body.appendChild(modalElement.firstElementChild);
  }
  
  // Inicializa o modal Bootstrap
  productModal = new bootstrap.Modal(document.getElementById('productModal'), {
    backdrop: 'static' // Impede o fechamento do modal ao clicar fora
  });
  
  // Carrega os produtos no modal
  loadProductsInModal();
  
  // Adiciona evento ao botão de WhatsApp
  document.getElementById('send-whatsapp').addEventListener('click', sendWhatsAppOrder);
  
  // Configura os botões "Comprar"
  setupBuyButtons();
  
  // Ajusta o scroll ao abrir e fechar a modal
  const modalElement = document.getElementById('productModal');
  modalElement.addEventListener('show.bs.modal', function() {
    // Salva a posição atual de scroll
    window.scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    
    // Rola para o topo suavemente antes de abrir a modal
    window.scrollTo({top: 0, behavior: 'smooth'});
    
    // Adiciona um pequeno atraso para garantir que os produtos sejam carregados corretamente
    setTimeout(() => {
      updateOrderSummary();
    }, 100);
  });
}

// Carrega os produtos no modal
function loadProductsInModal() {
  const productList = document.getElementById('product-list');
  if (!productList) return;
  
  productList.innerHTML = '';
  
  products.forEach(product => {
    const productCard = document.createElement('div');
    productCard.className = 'col-md-4 col-sm-6 mb-4'; // Adicionado mb-4 para espaçamento uniforme
    productCard.innerHTML = `
      <div class="product-card-modal" data-id="${product.id}">
        <div class="product-image-modal" style="background-image: url('${product.image}');"></div>
        <div class="product-info-modal">
          <h4 class="product-title-modal">${product.name}</h4>
          <p class="product-price-modal">R$ ${product.price.toFixed(2).replace('.', ',')}</p>
          <p class="small text-muted">${product.description}</p>
          <div class="quantity-control">
            <button class="quantity-btn decrease" data-id="${product.id}">-</button>
            <input type="number" class="quantity-input" data-id="${product.id}" value="0" min="0" max="20">
            <button class="quantity-btn increase" data-id="${product.id}">+</button>
          </div>
        </div>
      </div>
    `;
    productList.appendChild(productCard);
  });
  
  // Adiciona eventos aos botões de controle de quantidade
  setupQuantityControls();
}

// Configura controles de quantidade
function setupQuantityControls() {
  // Botões de aumento
  document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.getAttribute('data-id');
      const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
      let currentValue = parseInt(input.value);
      
      if (currentValue < 20) {
        input.value = currentValue + 1;
        updateCart(productId, currentValue + 1);
      }
    });
  });
  
  // Botões de diminuição
  document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.getAttribute('data-id');
      const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
      let currentValue = parseInt(input.value);
      
      if (currentValue > 0) {
        input.value = currentValue - 1;
        updateCart(productId, currentValue - 1);
      }
    });
  });
  
  // Input de quantidade
  document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
      const productId = this.getAttribute('data-id');
      let currentValue = parseInt(this.value);
      
      // Valida o valor do input
      if (isNaN(currentValue) || currentValue < 0) {
        currentValue = 0;
        this.value = 0;
      } else if (currentValue > 20) {
        currentValue = 20;
        this.value = 20;
      }
      
      updateCart(productId, currentValue);
    });
  });
}

// Atualiza o carrinho quando uma quantidade é alterada
function updateCart(productId, quantity) {
  productId = parseInt(productId);
  
  // Encontra o produto no array de produtos
  const product = products.find(p => p.id === productId);
  
  // Verifica se o produto já está no carrinho
  const existingItem = cart.find(item => item.id === productId);
  
  if (quantity > 0) {
    if (existingItem) {
      existingItem.quantity = quantity;
    } else {
      cart.push({
        id: productId,
        name: product.name,
        price: product.price,
        quantity: quantity
      });
    }
  } else if (existingItem) {
    // Remove o item do carrinho se a quantidade for zero
    cart = cart.filter(item => item.id !== productId);
  }
  
  // Atualiza o resumo do pedido
  updateOrderSummary();
}

// Atualiza o resumo do pedido
function updateOrderSummary() {
  const selectedProductsElement = document.getElementById('selected-products');
  const totalPriceElement = document.getElementById('total-price');
  const whatsappButton = document.getElementById('send-whatsapp');
  
  if (!selectedProductsElement || !totalPriceElement || !whatsappButton) return;
  
  // Limpa o conteúdo atual
  selectedProductsElement.innerHTML = '';
  
  // Calcula o total
  total = 0;
  
  if (cart.length === 0) {
    selectedProductsElement.innerHTML = '<p class="text-muted">Nenhum produto selecionado</p>';
    whatsappButton.disabled = true;
  } else {
    // Adiciona cada item ao resumo
    cart.forEach(item => {
      const itemTotal = item.price * item.quantity;
      total += itemTotal;
      
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
  
  // Atualiza o total
  totalPriceElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Configura os botões "Comprar" para abrir o modal
function setupBuyButtons() {
  // Botões na página de produtos
  document.querySelectorAll('.product-card .btn, a[data-page="loja"], .btn-ver-todos, a.btn-primary').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Limpa o carrinho
      cart = [];
      
      // Se for um botão de um produto específico, adiciona-o ao carrinho
      if (this.closest('.product-card')) {
        const productTitle = this.closest('.product-card').querySelector('.product-title').textContent;
        const product = products.find(p => p.name === productTitle || productTitle.includes(p.name));
        
        if (product) {
          cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1
          });
          
          // Atualiza a interface após o modal ser exibido
          setTimeout(() => {
            document.querySelectorAll('.quantity-input').forEach(input => {
              if (parseInt(input.getAttribute('data-id')) === product.id) {
                input.value = 1;
              } else {
                input.value = 0;
              }
            });
          }, 300);
        }
      } else {
        // Reseta os inputs de quantidade
        setTimeout(() => {
          document.querySelectorAll('.quantity-input').forEach(input => {
            input.value = 0;
          });
        }, 300);
      }
      
      // Atualiza o resumo do pedido
      updateOrderSummary();
      
      // Abre o modal
      productModal.show();
    });
  });
  
  // Botões na galeria de brownies na home
  document.querySelectorAll('.brownie-item').forEach(item => {
    item.addEventListener('click', function(e) {
      const title = this.querySelector('h4').textContent;
      const product = products.find(p => p.name === title || title.includes(p.name) || p.name.includes(title));
      
      if (product) {
        // Limpa o carrinho e adiciona o produto selecionado
        cart = [{
          id: product.id,
          name: product.name,
          price: product.price,
          quantity: 1
        }];
        
        // Atualiza a interface após o modal ser exibido
        setTimeout(() => {
          document.querySelectorAll('.quantity-input').forEach(input => {
            if (parseInt(input.getAttribute('data-id')) === product.id) {
              input.value = 1;
            } else {
              input.value = 0;
            }
          });
          updateOrderSummary();
        }, 300);
        
        // Rola a página para o topo antes de mostrar o modal
        window.scrollTo({ top: 0, behavior: 'smooth' });
        
        // Pequeno atraso para permitir que a rolagem termine
        setTimeout(() => {
          // Abre o modal
          productModal.show();
        }, 300);
      }
    });
  });
}

// Envia o pedido via WhatsApp
function sendWhatsAppOrder() {
  if (cart.length === 0) return;
  
  // Formata a mensagem para o WhatsApp
  let message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";
  
  cart.forEach(item => {
    message += `• ${item.quantity}x ${item.name} - R$ ${(item.price * item.quantity).toFixed(2).replace('.', ',')}\n`;
  });
  
  message += `\nTotal: R$ ${total.toFixed(2).replace('.', ',')}`;
  message += "\n\nPor favor, poderia me confirmar este pedido e informar o prazo de entrega?";
  
  // Codifica a mensagem para URL
  const encodedMessage = encodeURIComponent(message);
  
  // Número do WhatsApp (use o mesmo do botão existente no rodapé)
  const whatsappNumber = "5511999988888";
  
  // URL do WhatsApp
  const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
  
  // Fecha o modal
  productModal.hide();
  
  setTimeout(() => {
    window.open(whatsappUrl, '_blank');
  }, 300);
}