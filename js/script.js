


  $(document).ready(function() {
            // Por padrão, exibe a página inicial
            $('#home').addClass('active');
            $('a[data-page="home"]').addClass('active');
            
            // Manipulador de eventos para links de navegação
            $('a[data-page]').on('click', function(e) {
                e.preventDefault();
                
                // Obtém o ID da página a ser exibida
                var pageId = $(this).data('page');
                
                // Esconde todas as páginas
                $('.page').removeClass('active');
                
                // Remove a classe ativa de todos os links
                $('.nav-link').removeClass('active');
                
                // Adiciona a classe ativa ao link clicado
                $('a[data-page="' + pageId + '"]').addClass('active');
                
                // Exibe a página selecionada
                $('#' + pageId).addClass('active');
                
                // Rola para o topo da página
                window.scrollTo(0, 0);
            });
            
            // Efeito na navbar ao rolar
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('bg-white').css('box-shadow', '0 2px 4px rgba(0,0,0,0.1)');
                } else {
                    $('.navbar').removeClass('bg-white').css('box-shadow', 'none');
                }
            });
            
            // Alerta para botões de ação
            $(document).on('click', '.btn-primary', function() {
                if ($(this).text() === 'Adicionar ao Carrinho') {
                    var productName = $(this).closest('.product-info').find('.product-title').text();
                    alert('Produto "' + productName + '" adicionado ao carrinho!');
                }
            });
            
            // Submissão do formulário de contato
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                alert('Mensagem enviada com sucesso! Em breve entraremos em contato.');
                this.reset();
            });
        });

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
      
      // Função para criar as estrelas de avaliação
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
      
      // Função para criar um cartão de depoimento
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
      
      document.addEventListener('DOMContentLoaded', function() {
          const track = document.getElementById('testimonial-track');
          const container = document.querySelector('.testimonial-slider-container');
          let isPaused = false;
          let animationSpeed = 1; // pixels por frame
          let position = 0;
          let animationId = null;
          
          // Inicializa o carrossel
          function initCarousel() {
              // Adiciona os cartões ao track (3 conjuntos para garantir o loop infinito)
              for (let i = 0; i < 3; i++) {
                  testimonials.forEach(testimonial => {
                      track.innerHTML += createTestimonialCard(testimonial);
                  });
              }
              
              // Inicia a animação
              startAnimation();
              
              // Adiciona eventos para pausar a animação
              container.addEventListener('mouseenter', () => {
                  isPaused = true;
              });
              
              container.addEventListener('mouseleave', () => {
                  isPaused = false;
              });
              
              // Reinicia a animação quando a página home é ativada
              $('a[data-page="home"]').on('click', function() {
                  if (animationId) {
                      cancelAnimationFrame(animationId);
                  }
                  position = 0;
                  track.style.transform = `translateX(0px)`;
                  startAnimation();
              });
          }
          
          // Função para animar o carrossel
          function startAnimation() {
              const cardWidth = 350; // Largura do cartão + margem
              const trackWidth = testimonials.length * cardWidth;
              
              function animate() {
                  if (!isPaused) {
                      position -= animationSpeed;
                      
                      // Se o primeiro conjunto de cartões sair completamente da tela, reseta a posição
                      if (Math.abs(position) >= trackWidth) {
                          position = 0;
                      }
                      
                      track.style.transform = `translateX(${position}px)`;
                  }
                  
                  animationId = requestAnimationFrame(animate);
              }
              
              animationId = requestAnimationFrame(animate);
          }
          
          // Inicializa quando a página for carregada
          if (track) {
              initCarousel();
          }
      });