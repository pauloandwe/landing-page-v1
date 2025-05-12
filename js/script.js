


  $(document).ready(function() {
            $('#home').addClass('active');
            $('a[data-page="home"]').addClass('active');
            
            $('a[data-page]').on('click', function(e) {
                e.preventDefault();
                
                var pageId = $(this).data('page');
                
                $('.page').removeClass('active');
                
                $('.nav-link').removeClass('active');
                
                $('a[data-page="' + pageId + '"]').addClass('active');
                
                $('#' + pageId).addClass('active');
                
                window.scrollTo(0, 0);
            });
            
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('bg-white').css('box-shadow', '0 2px 4px rgba(0,0,0,0.1)');
                } else {
                    $('.navbar').removeClass('bg-white').css('box-shadow', 'none');
                }
            });
            
            $(document).on('click', '.btn-primary', function() {
                if ($(this).text() === 'Adicionar ao Carrinho') {
                    var productName = $(this).closest('.product-info').find('.product-title').text();
                    alert('Produto "' + productName + '" adicionado ao carrinho!');
                }
            });
            
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
          let animationSpeed = 1; 
          let position = 0;
          let animationId = null;
          
          function initCarousel() {
              for (let i = 0; i < 3; i++) {
                  testimonials.forEach(testimonial => {
                      track.innerHTML += createTestimonialCard(testimonial);
                  });
              }
              
              startAnimation();
              
              container.addEventListener('mouseenter', () => {
                  isPaused = true;
              });
              
              container.addEventListener('mouseleave', () => {
                  isPaused = false;
              });
              
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
          
          if (track) {
              initCarousel();
          }
      });
      
      $(window).on('load', function() {
        setTimeout(function() {
            $('.preloader').addClass('fade-out');
        }, 500);
    });

function isElementInViewport(el) {
    if (!el) return false;
    
    const rect = el.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.85
    );
}

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

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(animateInfoSection, 150);
    
    window.addEventListener('scroll', animateInfoSection, {passive: true});
    
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