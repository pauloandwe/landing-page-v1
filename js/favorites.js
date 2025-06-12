// Sistema de Favoritos com Firebase - favorites.js
class FavoritesManager {
  constructor() {
    // Configuração do Firebase

    this.firebaseConfig = {
      apiKey: "AIzaSyAsvcrsyOlWproBg9z24ea-5Yv2uKHRkuM",
      authDomain: "brownies-geo.firebaseapp.com",
      projectId: "brownies-geo",
      storageBucket: "brownies-geo.firebasestorage.app",
      messagingSenderId: "395790842670",
      appId: "1:395790842670:web:694ce281e0220c16c8d8bf",
      measurementId: "G-CJJ3B8C247",
    };

    this.localStorageKey = "brownies_favorites";
    this.countersKey = "brownies_counters";

    // Referências do Firebase
    this.db = null;
    this.countersRef = null;

    this.init();
  }

  async init() {
    try {
      await this.initFirebase();
      await this.loadCounters();
      this.setupEventListeners();
      this.updateUI();
    } catch (error) {
      console.error("Erro ao inicializar sistema de favoritos:", error);
      // Fallback para localStorage apenas
      this.loadCountersLocal();
      this.setupEventListeners();
      this.updateUI();
    }
  }

  // Inicializa Firebase
  async initFirebase() {
    try {
      // Verifica se Firebase está disponível
      if (typeof firebase === "undefined") {
        throw new Error("Firebase SDK não carregado");
      }

      // Inicializa Firebase se ainda não foi inicializado
      if (!firebase.apps.length) {
        firebase.initializeApp(this.firebaseConfig);
      }

      // Inicializa Firestore
      this.db = firebase.firestore();

      // Referência para o documento de contadores
      this.countersRef = this.db
        .collection("brownies")
        .doc("favorites_counters");

      console.log("Firebase inicializado com sucesso!");
      return true;
    } catch (error) {
      console.warn("Erro ao inicializar Firebase:", error);
      throw error;
    }
  }

  // Carrega contadores do Firebase
  async loadCounters() {
    try {
      if (!this.countersRef) {
        throw new Error("Firebase não inicializado");
      }

      const doc = await this.countersRef.get();

      if (doc.exists) {
        this.counters = doc.data() || {};
        console.log("Contadores carregados do Firebase:", this.counters);
      } else {
        // Cria documento inicial se não existir
        this.counters = {};
        await this.initializeCounters();
      }

      // Salva localmente como backup
      localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
    } catch (error) {
      console.warn("Erro ao carregar do Firebase, usando localStorage:", error);
      this.loadCountersLocal();
    }

    // Garante que todos os produtos tenham contadores
    this.ensureAllProductCounters();
  }

  // Carrega contadores do localStorage (fallback)
  loadCountersLocal() {
    const localCounters = localStorage.getItem(this.countersKey);
    this.counters = localCounters ? JSON.parse(localCounters) : {};
    this.ensureAllProductCounters();
  }

  // Garante que todos os produtos tenham contadores inicializados
  ensureAllProductCounters() {
    if (typeof products !== "undefined") {
      products.forEach((product) => {
        if (!this.counters.hasOwnProperty(product.id)) {
          this.counters[product.id] = 0;
        }
      });
    }
  }

  // Inicializa contadores no Firebase para produtos que não existem
  async initializeCounters() {
    try {
      if (typeof products !== "undefined") {
        const initialCounters = {};
        products.forEach((product) => {
          initialCounters[product.id] = 0;
        });

        await this.countersRef.set(initialCounters);
        this.counters = initialCounters;
        console.log("Contadores inicializados no Firebase");
      }
    } catch (error) {
      console.error("Erro ao inicializar contadores:", error);
    }
  }

  // Salva contadores no Firebase
  async saveCounters() {
    try {
      if (this.countersRef) {
        await this.countersRef.set(this.counters);
        console.log("Contadores salvos no Firebase com sucesso!");

        // Salva localmente como backup
        localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
        return true;
      } else {
        throw new Error("Firebase não disponível");
      }
    } catch (error) {
      console.warn(
        "Erro ao salvar no Firebase, salvando apenas localmente:",
        error
      );
      // Salva apenas localmente se Firebase falhar
      localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
      return false;
    }
  }

  // Atualiza contador específico no Firebase usando transação
  async updateCounterInFirebase(productId, increment) {
    try {
      if (!this.countersRef) {
        throw new Error("Firebase não disponível");
      }

      await this.db.runTransaction(async (transaction) => {
        const doc = await transaction.get(this.countersRef);

        if (!doc.exists) {
          // Cria documento se não existir
          const initialData = {};
          if (typeof products !== "undefined") {
            products.forEach((product) => {
              initialData[product.id] = 0;
            });
          }
          transaction.set(this.countersRef, initialData);
          return;
        }

        const data = doc.data();
        const currentCount = data[productId] || 0;
        const newCount = Math.max(0, currentCount + increment);

        transaction.update(this.countersRef, {
          [productId]: newCount,
        });
      });

      console.log(`Contador do produto ${productId} atualizado no Firebase`);
      return true;
    } catch (error) {
      console.error("Erro ao atualizar contador no Firebase:", error);
      return false;
    }
  }

  // Gerencia favoritos do usuário atual (localStorage)
  getUserFavorites() {
    const favorites = localStorage.getItem(this.localStorageKey);
    return favorites ? JSON.parse(favorites) : [];
  }

  saveUserFavorites(favorites) {
    localStorage.setItem(this.localStorageKey, JSON.stringify(favorites));
  }

  // Adiciona/remove favorito
  async toggleFavorite(productId) {
    const userFavorites = this.getUserFavorites();
    const isFavorited = userFavorites.includes(productId);
    const increment = isFavorited ? -1 : 1;

    // Atualiza favoritos do usuário
    if (isFavorited) {
      const index = userFavorites.indexOf(productId);
      userFavorites.splice(index, 1);
    } else {
      userFavorites.push(productId);
    }

    // Atualiza contador local imediatamente para UI responsiva
    this.counters[productId] = Math.max(
      0,
      (this.counters[productId] || 0) + increment
    );

    // Salva favoritos do usuário
    this.saveUserFavorites(userFavorites);

    // Atualiza UI imediatamente
    this.updateUI();

    // Mostra feedback visual
    this.showFeedback(productId, !isFavorited);

    // Tenta atualizar no Firebase em background
    try {
      const success = await this.updateCounterInFirebase(productId, increment);
      if (!success) {
        // Se falhou, usa método de backup
        await this.saveCounters();
      }
    } catch (error) {
      console.warn("Erro ao sincronizar com Firebase:", error);
      // Salva localmente como fallback
      localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
    }

    return !isFavorited;
  }

  // Sincroniza dados com Firebase (chamada manual se necessário)
  async syncWithFirebase() {
    try {
      // Recarrega contadores do Firebase
      await this.loadCounters();
      this.updateUI();
      console.log("Sincronização com Firebase concluída");
      return true;
    } catch (error) {
      console.error("Erro na sincronização:", error);
      return false;
    }
  }

  // Atualiza a interface
  updateUI() {
    const userFavorites = this.getUserFavorites();

    // Atualiza todos os botões de favorito
    document.querySelectorAll(".btn-wishlist").forEach((btn) => {
      const productId = parseInt(btn.getAttribute("data-product-id"));
      const isFavorited = userFavorites.includes(productId);

      // Atualiza aparência do botão
      const icon = btn.querySelector("i");
      if (icon) {
        if (isFavorited) {
          icon.className = "fas fa-heart";
          btn.style.backgroundColor = "#ffedee";
          btn.style.color = "#ff5c6c";
          btn.classList.add("favorited");
        } else {
          icon.className = "far fa-heart";
          btn.style.backgroundColor = "#f5f5f5";
          btn.style.color = "#777";
          btn.classList.remove("favorited");
        }
      }
    });

    // Atualiza contadores nos produtos
    document.querySelectorAll(".favorite-counter").forEach((counter) => {
      const productId = parseInt(counter.getAttribute("data-product-id"));
      const count = this.counters[productId] || 0;
      counter.textContent = count;

      // Mostra/esconde o contador baseado na quantidade
      counter.style.display = count > 0 ? "flex" : "none";

      // Adiciona animação se contador mudou
      if (parseInt(counter.dataset.lastCount || 0) !== count) {
        counter.classList.add("new");
        setTimeout(() => counter.classList.remove("new"), 500);
        counter.dataset.lastCount = count;
      }
    });
  }

  // Mostra feedback visual
  showFeedback(productId, isFavorited) {
    const btn = document.querySelector(
      `.btn-wishlist[data-product-id="${productId}"]`
    );

    if (btn) {
      // Animação de feedback no botão
      btn.style.transform = "scale(1.2)";
      btn.style.transition = "transform 0.2s ease";

      setTimeout(() => {
        btn.style.transform = "scale(1)";
      }, 200);

      // Tooltip de feedback
      const message = isFavorited
        ? "❤️ Adicionado aos favoritos!"
        : "💔 Removido dos favoritos!";
      this.showTooltip(btn, message);

      // Efeito de partículas
      if (isFavorited) {
        this.createHeartParticles(btn);
      }
    }
  }

  // Cria efeito de partículas de coração
  createHeartParticles(element) {
    const rect = element.getBoundingClientRect();
    const particles = 5;

    for (let i = 0; i < particles; i++) {
      const particle = document.createElement("div");
      particle.innerHTML = "❤️";
      particle.className = "heart-particle";

      // Calcula posição central do botão
      const centerX = rect.left + rect.width / 2;
      const centerY = rect.top + rect.height / 2;

      // Tamanho do emoji
      const fontSize = 12 + Math.random() * 8;

      // Movimento aleatório
      const angle = (Math.PI * 2 * i) / particles;
      const distance = 30 + Math.random() * 20;
      const deltaX = Math.cos(angle) * distance;
      const deltaY = Math.sin(angle) * distance;

      particle.style.cssText = `
        position: fixed;
        left: ${centerX - fontSize / 2}px;
        top: ${centerY - fontSize / 2}px;
        font-size: ${fontSize}px;
        pointer-events: none;
        z-index: 9999;
        transform-origin: center center;
        animation: heartParticle 1s ease-out forwards;
        animation-delay: ${i * 0.1}s;
        --dx: ${deltaX}px;
        --dy: ${deltaY}px;
      `;

      document.body.appendChild(particle);

      setTimeout(() => {
        if (particle.parentNode) {
          particle.parentNode.removeChild(particle);
        }
      }, 1000 + i * 100);
    }
  }

  // Mostra tooltip temporário
  showTooltip(element, message) {
    // Remove tooltip anterior se existir
    const existingTooltip = element.querySelector(".favorite-tooltip");
    if (existingTooltip) {
      existingTooltip.remove();
    }

    const tooltip = document.createElement("div");
    tooltip.className = "favorite-tooltip";
    tooltip.textContent = message;

    element.style.position = "relative";
    element.appendChild(tooltip);

    // Anima entrada
    setTimeout(() => (tooltip.style.opacity = "1"), 10);

    // Remove após 2 segundos
    setTimeout(() => {
      if (tooltip.parentNode) {
        tooltip.style.opacity = "0";
        setTimeout(() => {
          if (tooltip.parentNode) {
            tooltip.parentNode.removeChild(tooltip);
          }
        }, 300);
      }
    }, 2000);
  }

  // Configura event listeners
  setupEventListeners() {
    document.addEventListener("click", (e) => {
      if (e.target.closest(".btn-wishlist")) {
        e.preventDefault();
        e.stopPropagation();

        const btn = e.target.closest(".btn-wishlist");
        const productId = parseInt(btn.getAttribute("data-product-id"));

        if (productId && !btn.classList.contains("processing")) {
          btn.classList.add("processing");

          this.toggleFavorite(productId).finally(() => {
            btn.classList.remove("processing");
          });
        }
      }
    });

    // Listener para sincronização quando janela ganha foco
    window.addEventListener("focus", () => {
      this.syncWithFirebase();
    });

    // Listener para atualização em tempo real do Firebase (opcional)
    if (this.countersRef) {
      this.countersRef.onSnapshot((doc) => {
        if (doc.exists) {
          const newCounters = doc.data();
          const hasChanges =
            JSON.stringify(this.counters) !== JSON.stringify(newCounters);

          if (hasChanges) {
            this.counters = newCounters;
            localStorage.setItem(
              this.countersKey,
              JSON.stringify(this.counters)
            );
            this.updateUI();
            console.log("Contadores atualizados em tempo real");
          }
        }
      });
    }
  }

  // Obtém produtos mais favoritados
  getMostFavorited(limit = 5) {
    return Object.entries(this.counters)
      .sort(([, a], [, b]) => b - a)
      .slice(0, limit)
      .map(([id, count]) => ({
        product:
          typeof products !== "undefined"
            ? products.find((p) => p.id === parseInt(id))
            : null,
        count,
      }))
      .filter((item) => item.product);
  }

  // Obtém total de favoritos de um produto
  getFavoriteCount(productId) {
    return this.counters[productId] || 0;
  }

  // Verifica se um produto é favorito do usuário atual
  isFavorited(productId) {
    const userFavorites = this.getUserFavorites();
    return userFavorites.includes(productId);
  }

  // Método para debug/administração
  async resetAllCounters() {
    try {
      if (this.countersRef) {
        const resetCounters = {};
        if (typeof products !== "undefined") {
          products.forEach((product) => {
            resetCounters[product.id] = 0;
          });
        }

        await this.countersRef.set(resetCounters);
        this.counters = resetCounters;
        this.updateUI();
        console.log("Todos os contadores foram resetados");
        return true;
      }
    } catch (error) {
      console.error("Erro ao resetar contadores:", error);
      return false;
    }
  }

  // Obtém estatísticas
  getStats() {
    const userFavorites = this.getUserFavorites();
    const totalFavorites = Object.values(this.counters).reduce(
      (sum, count) => sum + count,
      0
    );
    const totalProducts = Object.keys(this.counters).length;

    return {
      userFavoritesCount: userFavorites.length,
      totalFavorites,
      totalProducts,
      averageFavoritesPerProduct:
        totalProducts > 0 ? (totalFavorites / totalProducts).toFixed(2) : 0,
      mostFavorited: this.getMostFavorited(1)[0] || null,
    };
  }
}

// Inicialização
let favoritesManager;

document.addEventListener("DOMContentLoaded", function () {
  // Inicializa o gerenciador de favoritos
  favoritesManager = new FavoritesManager();

  // Adiciona contadores aos produtos existentes
  addFavoriteCountersToProducts();
});

// Adiciona contadores visuais aos produtos (mesmo código anterior)
function addFavoriteCountersToProducts() {
  // Adiciona contadores nos cards de produto
  document
    .querySelectorAll(".product-card, .product-card-enhanced")
    .forEach((card) => {
      const productTitle = card.querySelector(".product-title");
      if (productTitle) {
        const productName = productTitle.textContent.trim();
        const product =
          typeof products !== "undefined"
            ? products.find((p) => p.name === productName)
            : null;

        if (product) {
          // Adiciona data-product-id aos botões de favorito
          const wishlistBtn = card.querySelector(".btn-wishlist");
          if (wishlistBtn) {
            wishlistBtn.setAttribute("data-product-id", product.id);
          }

          // Adiciona contador visual
          const counter = document.createElement("span");
          counter.className = "favorite-counter";
          counter.setAttribute("data-product-id", product.id);
          counter.style.cssText = `
            position: absolute;
            top: 10px;
            left: 10px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
            z-index: 5;
          `;

          // Adiciona o contador ao card
          const productImage = card.querySelector(".product-image");
          if (productImage) {
            productImage.style.position = "relative";
            productImage.appendChild(counter);
          }
        }
      }
    });
}

// Função para mostrar produtos mais favoritados
function showMostFavorited() {
  if (favoritesManager) {
    const mostFavorited = favoritesManager.getMostFavorited(3);
    console.log("Produtos mais favoritados:", mostFavorited);
    return mostFavorited;
  }
  return [];
}

// Exporta para uso global
window.favoritesManager = favoritesManager;
