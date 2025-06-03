<div id="contato">
    <section class="hero-section hero-section-ctt">
        <div class="container">
            <h1 class="display-4 fw-bold">Contato</h1>
            <p class="lead">Entre em contato conosco para dúvidas, pedidos ou parcerias</p>
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
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="section-title text-start">Informações de Contato</h2>
                    <div class="contact-info">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5>Endereço</h5>
                                <p class="mb-0">Rua das Flores, 123 - Centro<br>São Paulo - SP, 01234-567</p>
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h5>Telefone</h5>
                                <p class="mb-0">(11) 9999-8888<br>(11) 3333-2222</p>
                            </div>
                        </div>
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h5>E-mail</h5>
                                <p class="mb-0">contato@docescacau.com.br<br>vendas@docescacau.com.br</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 class="section-title text-start">Envie sua Mensagem</h2>
                    <div class="contact-form">
                        <form id="contactForm" action="https://formsubmit.co/pascs0703@gmail.com" method="POST">
                            <input type="hidden" name="_captcha" value="false">
                            <input type="hidden" name="_subject" value="Nova mensagem do site Doces Cacau!">
                            <input type="hidden" name="_template" value="table">
                            <input type="text" name="_honey" style="display:none">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Assunto</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="message" name="message" rows="5"
                                    required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>