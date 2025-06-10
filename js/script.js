$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $(".navbar")
        .addClass("bg-white")
        .css("box-shadow", "0 2px 4px rgba(0,0,0,0.1)");
    } else {
      $(".navbar").removeClass("bg-white").css("box-shadow", "none");
    }
  });

  $("#contactForm").on("submit", function (e) {
    e.preventDefault();

    // Limpar mensagens de erro anteriores
    clearFormErrors();

    // Validar o formulário
    if (!validateForm()) {
      return;
    }

    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    const originalText = submitBtn.html();
    const formAction = form.attr("action");

    submitBtn.html(
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'
    );
    submitBtn.prop("disabled", true);

    const formData = new FormData(form[0]);

    $.ajax({
      url: formAction,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        Swal.fire({
          title: "Mensagem enviada com sucesso!",
          text: "Em breve entraremos em contato.",
          icon: "success",
          draggable: true,
        });
        form[0].reset();
        clearFormErrors();
      },
      error: function (xhr, status, error) {
        Swal.fire({
          title: "Erro ao enviar mensagem",
          text: "Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.",
          icon: "error",
          draggable: true,
        });
      },
      complete: function () {
        submitBtn.html(originalText);
        submitBtn.prop("disabled", false);
      },
    });
  });

  // Máscara para telefone
  $("#phone").on("input", function () {
    let value = $(this).val().replace(/\D/g, "");

    if (value.length <= 11) {
      if (value.length <= 2) {
        $(this).val(value);
      } else if (value.length <= 6) {
        $(this).val(`(${value.slice(0, 2)}) ${value.slice(2)}`);
      } else if (value.length <= 10) {
        $(this).val(
          `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`
        );
      } else {
        $(this).val(
          `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7, 11)}`
        );
      }
    }
  });

  // Validação em tempo real para nome
  $("#name").on("blur", function () {
    const name = $(this).val().trim();
    const errorId = "name-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (name !== "") {
      if (name.length < 2) {
        showFieldError("name", "O nome deve ter pelo menos 2 caracteres");
      } else if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(name)) {
        showFieldError("name", "O nome deve conter apenas letras");
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Validação em tempo real para email
  $("#email").on("blur", function () {
    const email = $(this).val().trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorId = "email-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (email !== "") {
      if (!emailRegex.test(email)) {
        showFieldError("email", "Por favor, insira um e-mail válido");
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Validação em tempo real para telefone
  $("#phone").on("blur", function () {
    const phone = $(this).val().trim();
    const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
    const errorId = "phone-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (phone !== "") {
      if (!phoneRegex.test(phone)) {
        showFieldError(
          "phone",
          "Por favor, insira um telefone válido no formato (11) 99999-9999"
        );
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Validação em tempo real para cidade
  $("#city").on("blur", function () {
    const city = $(this).val().trim();
    const errorId = "city-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (city !== "") {
      if (city.length < 2) {
        showFieldError("city", "A cidade deve ter pelo menos 2 caracteres");
      } else if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(city)) {
        showFieldError("city", "A cidade deve conter apenas letras");
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Validação em tempo real para assunto
  $("#subject").on("blur", function () {
    const subject = $(this).val().trim();
    const errorId = "subject-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (subject !== "") {
      if (subject.length < 3) {
        showFieldError("subject", "O assunto deve ter pelo menos 3 caracteres");
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Validação em tempo real para mensagem
  $("#message").on("blur", function () {
    const message = $(this).val().trim();
    const errorId = "message-error";

    $("#" + errorId).remove();
    $(this).removeClass("is-invalid is-valid");

    if (message !== "") {
      if (message.length < 10) {
        showFieldError(
          "message",
          "A mensagem deve ter pelo menos 10 caracteres"
        );
      } else if (message.length > 1000) {
        showFieldError(
          "message",
          "A mensagem não pode exceder 1000 caracteres"
        );
      } else {
        $(this).addClass("is-valid");
      }
    }
  });

  // Contador de caracteres para mensagem
  $("#message").on("input", function () {
    const currentLength = $(this).val().length;
    const maxLength = 1000;

    // Remove contador anterior
    $(".char-counter").remove();

    // Adiciona contador
    const counterColor =
      currentLength > maxLength
        ? "text-danger"
        : currentLength > maxLength * 0.8
        ? "text-warning"
        : "text-muted";
    const counter = `<small class="char-counter ${counterColor}">${currentLength}/${maxLength} caracteres</small>`;
    $(this).after(counter);
  });

  setTimeout(animateInfoSection, 150);
  window.addEventListener("scroll", animateInfoSection, { passive: true });

  initProductModal();
});

function removePreloader() {
  $(".preloader").addClass("fade-out");

  setTimeout(function () {
    $(".preloader").css("display", "none");
  }, 1000);
}

$(window).on("load", function () {
  removePreloader();
});

setTimeout(function () {
  removePreloader();
}, 2000);

const testimonials = [
  {
    id: 1,
    avatar:
      "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
    rating: 5,
    text: "Os brownies da Cacau são simplesmente divinos! A textura macia por dentro e crocante por fora é perfeita.",
    author: "Mariana Silva",
  },
  {
    id: 2,
    avatar:
      "https://i.pinimg.com/originals/76/b2/79/76b2799fcd3c8b77e6e0e83a98af8657.jpg",
    rating: 5,
    text: "Encomendei para o aniversário da minha filha e todos os convidados ficaram impressionados! Super recomendo!",
    author: "Rafael Oliveira",
  },
  {
    id: 3,
    avatar:
      "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
    rating: 5,
    text: "Nunca provei brownies tão deliciosos! O de Nutella com nozes é o meu favorito. Simplesmente perfeito!",
    author: "Juliana Santos",
  },
  {
    id: 4,
    avatar:
      "https://i.pinimg.com/originals/76/b2/79/76b2799fcd3c8b77e6e0e83a98af8657.jpg",
    rating: 4.5,
    text: "Sou cliente fiel há mais de um ano e posso dizer que são os melhores brownies da cidade!",
    author: "Carlos Mendes",
  },
  {
    id: 5,
    avatar:
      "https://i.pinimg.com/736x/36/c0/e8/36c0e88ff688eeb7a39132c9b099dc16.jpg",
    rating: 5,
    text: "Cada mordida é uma explosão de sabor! Os brownies são úmidos e extremamente saborosos.",
    author: "Fernanda Lima",
  },
];

function createRatingStars(rating) {
  let starsHTML = "";
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

function createTestimonialCard(testimonial) {
  return `
      <div class="testimonial-card" data-id="${testimonial.id}">
          <div class="testimonial-avatar">
              <img src="${testimonial.avatar}" alt="Cliente ${
    testimonial.id
  }" class="rounded-circle">
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

document.addEventListener("DOMContentLoaded", function () {
  const track = document.getElementById("testimonial-track");
  const container = document.querySelector(".testimonial-slider-container");

  if (track) {
    let isPaused = false;
    let animationSpeed = 1;
    let position = 0;
    let animationId = null;

    function initCarousel() {
      for (let i = 0; i < 3; i++) {
        testimonials.forEach((testimonial) => {
          track.innerHTML += createTestimonialCard(testimonial);
        });
      }

      startAnimation();

      container.addEventListener("mouseenter", () => {
        isPaused = true;
      });

      container.addEventListener("mouseleave", () => {
        isPaused = false;
      });
    }

    function startAnimation() {
      const cardWidth = 350;
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

function isElementInViewport(el) {
  if (!el) return false;

  const rect = el.getBoundingClientRect();
  return (
    rect.top <=
    (window.innerHeight || document.documentElement.clientHeight) * 0.85
  );
}

function animateInfoSection() {
  const infoCards = document.querySelectorAll(".info-card");
  infoCards.forEach((card) => {
    if (isElementInViewport(card) && !card.classList.contains("visible")) {
      const delay = parseInt(card.getAttribute("data-delay") || 0);
      setTimeout(() => {
        card.classList.add("visible");
      }, delay);
    }
  });

  const ctaContainer = document.querySelector(".cta-container");
  if (
    ctaContainer &&
    isElementInViewport(ctaContainer) &&
    !ctaContainer.classList.contains("visible")
  ) {
    ctaContainer.classList.add("visible");
  }
}

let cart = [];
let total = 0;
let productModal;

function openShopModal() {
  cart = [];

  setTimeout(() => {
    document.querySelectorAll(".quantity-input").forEach((input) => {
      input.value = 0;
    });
  }, 300);

  updateOrderSummary();
  productModal.show();
}

function initProductModal() {
  const modalElement = document.getElementById("productModal");
  if (!modalElement) return;

  productModal = new bootstrap.Modal(modalElement, {
    backdrop: "static",
  });

  loadProductsInModal();
  document
    .getElementById("send-whatsapp")
    .addEventListener("click", sendWhatsAppOrder);
  setupBuyButtons();
}

function loadProductsInModal() {
  const productList = document.getElementById("product-list");
  if (!productList) return;

  productList.innerHTML = "";

  products.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "col-md-4 col-sm-6 mb-4";
    productCard.innerHTML = `
          <div class="product-card-modal" data-id="${product.id}">
              <div class="product-image-modal" style="background-image: url('${
                product.image
              }');"></div>
              <div class="product-info-modal">
                  <h4 class="product-title-modal">${product.name}</h4>
                  <p class="product-price-modal">R$ ${product.price
                    .toFixed(2)
                    .replace(".", ",")}</p>
                  <p class="small text-muted">${product.description}</p>
                  <div class="quantity-control">
                      <button class="quantity-btn decrease" data-id="${
                        product.id
                      }">-</button>
                      <input type="number" class="quantity-input" data-id="${
                        product.id
                      }" value="0" min="0" max="20">
                      <button class="quantity-btn increase" data-id="${
                        product.id
                      }">+</button>
                  </div>
              </div>
          </div>
      `;
    productList.appendChild(productCard);
  });

  setupQuantityControls();
}

function setupQuantityControls() {
  document.querySelectorAll(".increase").forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.getAttribute("data-id");
      const input = document.querySelector(
        `.quantity-input[data-id="${productId}"]`
      );
      let currentValue = parseInt(input.value);

      if (currentValue < 20) {
        input.value = currentValue + 1;
        updateCart(productId, currentValue + 1);
      }
    });
  });

  document.querySelectorAll(".decrease").forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.getAttribute("data-id");
      const input = document.querySelector(
        `.quantity-input[data-id="${productId}"]`
      );
      let currentValue = parseInt(input.value);

      if (currentValue > 0) {
        input.value = currentValue - 1;
        updateCart(productId, currentValue - 1);
      }
    });
  });

  document.querySelectorAll(".quantity-input").forEach((input) => {
    input.addEventListener("change", function () {
      const productId = this.getAttribute("data-id");
      let currentValue = parseInt(this.value);

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

function updateCart(productId, quantity) {
  productId = parseInt(productId);
  const product = products.find((p) => p.id === productId);
  const existingItem = cart.find((item) => item.id === productId);

  if (quantity > 0) {
    if (existingItem) {
      existingItem.quantity = quantity;
    } else {
      cart.push({
        id: productId,
        name: product.name,
        price: product.price,
        quantity: quantity,
      });
    }
  } else if (existingItem) {
    cart = cart.filter((item) => item.id !== productId);
  }

  updateOrderSummary();
}

function updateOrderSummary() {
  const selectedProductsElement = document.getElementById("selected-products");
  const totalPriceElement = document.getElementById("total-price");
  const whatsappButton = document.getElementById("send-whatsapp");

  if (!selectedProductsElement || !totalPriceElement || !whatsappButton) return;

  selectedProductsElement.innerHTML = "";
  total = 0;

  if (cart.length === 0) {
    selectedProductsElement.innerHTML =
      '<p class="text-muted">Nenhum produto selecionado</p>';
    whatsappButton.disabled = true;
  } else {
    cart.forEach((item) => {
      const itemTotal = item.price * item.quantity;
      total += itemTotal;

      const productElement = document.createElement("div");
      productElement.className = "selected-product-item";
      productElement.innerHTML = `
              <div>
                  <span class="fw-bold">${item.quantity}x</span> ${item.name}
              </div>
              <div>
                  R$ ${itemTotal.toFixed(2).replace(".", ",")}
              </div>
          `;

      selectedProductsElement.appendChild(productElement);
    });

    whatsappButton.disabled = false;
  }

  totalPriceElement.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
}

function setupBuyButtons() {
  document.querySelectorAll(".shop-button").forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      cart = [];

      if (this.closest(".product-card")) {
        const productTitle =
          this.closest(".product-card").querySelector(
            ".product-title"
          ).textContent;
        const product = products.find(
          (p) => p.name === productTitle || productTitle.includes(p.name)
        );

        if (product) {
          cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1,
          });

          setTimeout(() => {
            document.querySelectorAll(".quantity-input").forEach((input) => {
              if (parseInt(input.getAttribute("data-id")) === product.id) {
                input.value = 1;
              } else {
                input.value = 0;
              }
            });
          }, 300);
        }
      } else {
        setTimeout(() => {
          document.querySelectorAll(".quantity-input").forEach((input) => {
            input.value = 0;
          });
        }, 300);
      }

      updateOrderSummary();
      productModal.show();
    });
  });

  const btnVerTodos = document.querySelector(".btn-ver-todos");
  if (btnVerTodos) {
    btnVerTodos.addEventListener("click", function (e) {
      if (window.location.pathname === "/") {
        e.preventDefault();
        openShopModal();
      }
    });
  }

  const exploreBtn = document.querySelector(".hero-section-first .btn-primary");
  if (exploreBtn) {
    exploreBtn.addEventListener("click", function (e) {
      if (window.location.pathname === "/") {
        e.preventDefault();
        openShopModal();
      }
    });
  }

  document.querySelectorAll(".brownie-item").forEach((item) => {
    item.addEventListener("click", function (e) {
      const title = this.querySelector("h4").textContent;
      const product = products.find(
        (p) =>
          p.name === title || title.includes(p.name) || p.name.includes(title)
      );

      if (product) {
        e.preventDefault();
        cart = [
          {
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1,
          },
        ];

        setTimeout(() => {
          document.querySelectorAll(".quantity-input").forEach((input) => {
            if (parseInt(input.getAttribute("data-id")) === product.id) {
              input.value = 1;
            } else {
              input.value = 0;
            }
          });
          updateOrderSummary();
        }, 300);

        window.scrollTo({ top: 0, behavior: "smooth" });

        setTimeout(() => {
          productModal.show();
        }, 300);
      }
    });
  });
}

function sendWhatsAppOrder() {
  if (cart.length === 0) return;

  let message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";

  cart.forEach((item) => {
    message += `• ${item.quantity}x ${item.name} - R$ ${(
      item.price * item.quantity
    )
      .toFixed(2)
      .replace(".", ",")}\n`;
  });

  message += `\nTotal: R$ ${total.toFixed(2).replace(".", ",")}`;
  message +=
    "\n\nPor favor, poderia me confirmar este pedido e informar o prazo de entrega?";

  const encodedMessage = encodeURIComponent(message);
  const whatsappNumber = "5511999988888";
  const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

  productModal.hide();

  setTimeout(() => {
    window.open(whatsappUrl, "_blank");
  }, 300);
}

// Função para validar o formulário
function validateForm() {
  let isValid = true;

  // Validar nome
  const name = $("#name").val().trim();
  if (name === "") {
    showFieldError("name", "O nome é obrigatório");
    isValid = false;
  } else if (name.length < 2) {
    showFieldError("name", "O nome deve ter pelo menos 2 caracteres");
    isValid = false;
  } else if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(name)) {
    showFieldError("name", "O nome deve conter apenas letras");
    isValid = false;
  }

  // Validar email
  const email = $("#email").val().trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    showFieldError("email", "O e-mail é obrigatório");
    isValid = false;
  } else if (!emailRegex.test(email)) {
    showFieldError("email", "Por favor, insira um e-mail válido");
    isValid = false;
  }

  // Validar telefone
  const phone = $("#phone").val().trim();
  const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
  if (phone === "") {
    showFieldError("phone", "O telefone é obrigatório");
    isValid = false;
  } else if (!phoneRegex.test(phone)) {
    showFieldError(
      "phone",
      "Por favor, insira um telefone válido no formato (11) 99999-9999"
    );
    isValid = false;
  }

  // Validar cidade
  const city = $("#city").val().trim();
  if (city === "") {
    showFieldError("city", "A cidade é obrigatória");
    isValid = false;
  } else if (city.length < 2) {
    showFieldError("city", "A cidade deve ter pelo menos 2 caracteres");
    isValid = false;
  } else if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(city)) {
    showFieldError("city", "A cidade deve conter apenas letras");
    isValid = false;
  }

  // Validar assunto
  const subject = $("#subject").val().trim();
  if (subject === "") {
    showFieldError("subject", "O assunto é obrigatório");
    isValid = false;
  } else if (subject.length < 3) {
    showFieldError("subject", "O assunto deve ter pelo menos 3 caracteres");
    isValid = false;
  }

  // Validar mensagem
  const message = $("#message").val().trim();
  if (message === "") {
    showFieldError("message", "A mensagem é obrigatória");
    isValid = false;
  } else if (message.length < 10) {
    showFieldError("message", "A mensagem deve ter pelo menos 10 caracteres");
    isValid = false;
  } else if (message.length > 1000) {
    showFieldError("message", "A mensagem não pode exceder 1000 caracteres");
    isValid = false;
  }

  return isValid;
}

// Função para exibir erro em um campo específico
function showFieldError(fieldId, message) {
  const field = $("#" + fieldId);
  const errorId = fieldId + "-error";

  // Remove classe de sucesso se existir
  field.removeClass("is-valid").addClass("is-invalid");

  // Remove mensagem de erro anterior
  $("#" + errorId).remove();

  // Adiciona nova mensagem de erro
  const errorElement = `<div id="${errorId}" class="invalid-feedback d-block">${message}</div>`;
  field.after(errorElement);
}

// Função para limpar todas as mensagens de erro
function clearFormErrors() {
  $(".form-control").removeClass("is-invalid is-valid");
  $(".invalid-feedback").remove();
}
