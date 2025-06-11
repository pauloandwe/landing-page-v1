// Sistema de Favoritos - favorites.js
class FavoritesManager {
  constructor() {
    // Configuração da API (usando JSONBin.io como exemplo)
    this.apiUrl = "https://api.jsonbin.io/v3/b/6848cb2a8a456b7966ac074d"; // Substitua por seu BIN ID
    this.apiKey =
      "$2a$10$i8EKBSMB86qPhLqMqDFgcee36x5SH366SPoeOR.ZExT2xbzAUHS0C"; // Substitua por sua API Key

    // Fallback para armazenamento local
    this.localStorageKey = "brownies_favorites";
    this.countersKey = "brownies_counters";

    this.init();
  }

  async init() {
    await this.loadCounters();
    this.setupEventListeners();
    this.updateUI();
  }

  // Carrega contadores da nuvem
  async loadCounters() {
    try {
      // Primeiro tenta carregar da nuvem
      const response = await fetch(this.apiUrl, {
        method: "GET",
        headers: {
          "X-Master-Key": this.apiKey,
          "Content-Type": "application/json",
        },
      });

      if (response.ok) {
        const data = await response.json();
        this.counters = data.record || {};

        // Salva localmente como backup
        localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
      } else {
        throw new Error("Falha ao carregar da nuvem");
      }
    } catch (error) {
      console.log("Carregando contadores do armazenamento local...");
      // Fallback para localStorage
      const localCounters = localStorage.getItem(this.countersKey);
      this.counters = localCounters ? JSON.parse(localCounters) : {};
    }

    // Inicializa contadores para produtos que não existem
    products.forEach((product) => {
      if (!this.counters[product.id]) {
        this.counters[product.id] = 0;
      }
    });
  }

  // Salva contadores na nuvem
  async saveCounters() {
    try {
      const response = await fetch(this.apiUrl, {
        method: "PUT",
        headers: {
          "X-Master-Key": this.apiKey,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.counters),
      });

      if (response.ok) {
        console.log("Contadores salvos na nuvem com sucesso!");
        // Salva localmente como backup
        localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
        return true;
      } else {
        throw new Error("Falha ao salvar na nuvem");
      }
    } catch (error) {
      console.error("Erro ao salvar na nuvem:", error);
      // Salva apenas localmente se falhar
      localStorage.setItem(this.countersKey, JSON.stringify(this.counters));
      return false;
    }
  }

  // Gerencia favoritos do usuário atual
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

    if (isFavorited) {
      // Remove do favoritos
      const index = userFavorites.indexOf(productId);
      userFavorites.splice(index, 1);
      this.counters[productId] = Math.max(0, this.counters[productId] - 1);
    } else {
      // Adiciona aos favoritos
      userFavorites.push(productId);
      this.counters[productId] = (this.counters[productId] || 0) + 1;
    }

    // Salva localmente
    this.saveUserFavorites(userFavorites);

    // Salva na nuvem
    await this.saveCounters();

    // Atualiza interface
    this.updateUI();

    // Mostra feedback visual
    this.showFeedback(productId, !isFavorited);

    return !isFavorited;
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
      if (isFavorited) {
        icon.className = "fas fa-heart";
        btn.style.backgroundColor = "#ffedee";
        btn.style.color = "#ff5c6c";
      } else {
        icon.className = "far fa-heart";
        btn.style.backgroundColor = "#f5f5f5";
        btn.style.color = "#777";
      }
    });

    // Atualiza contadores nos produtos
    document.querySelectorAll(".favorite-counter").forEach((counter) => {
      const productId = parseInt(counter.getAttribute("data-product-id"));
      const count = this.counters[productId] || 0;
      counter.textContent = count;

      // Mostra/esconde o contador baseado na quantidade
      counter.style.display = count > 0 ? "inline-block" : "none";
    });
  }

  // Mostra feedback visual
  showFeedback(productId, isFavorited) {
    const btn = document.querySelector(
      `.btn-wishlist[data-product-id="${productId}"]`
    );

    if (btn) {
      // Animação de feedback
      btn.style.transform = "scale(1.2)";
      btn.style.transition = "transform 0.2s ease";

      setTimeout(() => {
        btn.style.transform = "scale(1)";
      }, 200);

      // Tooltip de feedback
      const message = isFavorited
        ? "Adicionado aos favoritos!"
        : "Removido dos favoritos!";
      this.showTooltip(btn, message);
    }
  }

  // Mostra tooltip temporário
  showTooltip(element, message) {
    const tooltip = document.createElement("div");
    tooltip.className = "favorite-tooltip";
    tooltip.textContent = message;
    tooltip.style.cssText = `
            position: absolute;
            background: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 1000;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        `;

    element.style.position = "relative";
    element.appendChild(tooltip);

    // Anima entrada
    setTimeout(() => (tooltip.style.opacity = "1"), 10);

    // Remove após 2 segundos
    setTimeout(() => {
      tooltip.style.opacity = "0";
      setTimeout(() => {
        if (tooltip.parentNode) {
          tooltip.parentNode.removeChild(tooltip);
        }
      }, 300);
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

        if (productId) {
          this.toggleFavorite(productId);
        }
      }
    });
  }

  // Obtém produtos mais favoritados
  getMostFavorited(limit = 5) {
    return Object.entries(this.counters)
      .sort(([, a], [, b]) => b - a)
      .slice(0, limit)
      .map(([id, count]) => ({
        product: products.find((p) => p.id === parseInt(id)),
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
}

// Alternativa usando Firebase (comentado)
/*
class FirebaseFavoritesManager extends FavoritesManager {
    constructor() {
        super();
        // Configuração do Firebase
        this.firebaseConfig = {
            apiKey: "your-api-key",
            authDomain: "your-project.firebaseapp.com",
            databaseURL: "https://your-project.firebaseio.com",
            projectId: "your-project-id"
        };
        this.initFirebase();
    }

    async initFirebase() {
        // Inicializa Firebase
        if (typeof firebase !== 'undefined') {
            firebase.initializeApp(this.firebaseConfig);
            this.database = firebase.database();
        }
    }

    async loadCounters() {
        try {
            if (this.database) {
                const snapshot = await this.database.ref('favorites').once('value');
                this.counters = snapshot.val() || {};
            } else {
                throw new Error('Firebase não disponível');
            }
        } catch (error) {
            await super.loadCounters(); // Fallback para localStorage
        }
    }

    async saveCounters() {
        try {
            if (this.database) {
                await this.database.ref('favorites').set(this.counters);
                return true;
            } else {
                throw new Error('Firebase não disponível');
            }
        } catch (error) {
            return await super.saveCounters(); // Fallback para localStorage
        }
    }
}
*/

// Inicialização
let favoritesManager;

document.addEventListener("DOMContentLoaded", function () {
  // Inicializa o gerenciador de favoritos
  favoritesManager = new FavoritesManager();

  // Adiciona contadores aos produtos existentes
  addFavoriteCountersToProducts();
});

// Adiciona contadores visuais aos produtos
function addFavoriteCountersToProducts() {
  // Adiciona contadores nos cards de produto
  document
    .querySelectorAll(".product-card, .product-card-enhanced")
    .forEach((card) => {
      const productTitle = card.querySelector(".product-title");
      if (productTitle) {
        const productName = productTitle.textContent.trim();
        const product = products.find((p) => p.name === productName);

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

  // Adiciona contadores nos brownies da home
  document.querySelectorAll(".brownie-item").forEach((item) => {
    const titleElement = item.querySelector("h4");
    if (titleElement) {
      const title = titleElement.textContent.trim();
      const product = products.find(
        (p) =>
          p.name === title || title.includes(p.name) || p.name.includes(title)
      );

      if (product) {
        const counter = document.createElement("span");
        counter.className = "favorite-counter";
        counter.setAttribute("data-product-id", product.id);
        counter.style.cssText = `
                    position: absolute;
                    top: 15px;
                    left: 15px;
                    background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
                    color: white;
                    border-radius: 50%;
                    width: 30px;
                    height: 30px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 12px;
                    font-weight: bold;
                    box-shadow: 0 3px 10px rgba(255, 107, 107, 0.4);
                    z-index: 10;
                `;

        const imageContainer = item.querySelector(".brownie-image");
        if (imageContainer) {
          imageContainer.appendChild(counter);
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
