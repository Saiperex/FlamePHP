document.addEventListener("DOMContentLoaded", () => {
  // Intersection Observer para animaciones
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-in")

        // Animación especial para las features
        const features = entry.target.querySelectorAll(".planes_features_list li")
        features.forEach((feature, index) => {
          setTimeout(() => {
            feature.style.opacity = "1"
            feature.style.transform = "translateX(0)"
          }, index * 100)
        })
      }
    })
  }, observerOptions)

  // Observar elementos para animación
  const animateElements = document.querySelectorAll(".planes_card, .planes_header, .planes_benefits, .planes_faq")
  animateElements.forEach((el) => observer.observe(el))

  // Inicializar features ocultas para animación
  const allFeatures = document.querySelectorAll(".planes_features_list li")
  allFeatures.forEach((feature) => {
    feature.style.opacity = "0.7"
    feature.style.transform = "translateX(-10px)"
    feature.style.transition = "all 0.3s ease"
  })

  // Toggle de facturación (preparado para futuro)
  const toggle = document.querySelector(".planes_toggle_switch")
  const slider = document.querySelector(".planes_toggle_slider")
  let isYearly = false

  if (toggle) {
    toggle.addEventListener("click", () => {
      isYearly = !isYearly
      slider.style.transform = isYearly ? "translateX(30px)" : "translateX(0)"
      toggle.style.background = isYearly
        ? "linear-gradient(135deg, var(--color-rosa), var(--color-naranja))"
        : "rgba(26, 14, 42, 0.2)"

      // Aquí puedes agregar lógica para cambiar precios
      updatePricing(isYearly)
    })
  }

  function updatePricing(yearly) {
    // Función preparada para cambio de precios anuales
    const premiumPrice = document.querySelector(".planes_card.premium .planes_price_amount")
    const premiumPeriod = document.querySelector(".planes_card.premium .planes_price_period")

    if (yearly) {
      premiumPrice.textContent = "20.000"
      premiumPeriod.textContent = "/año"
    } else {
      premiumPrice.textContent = "2.000"
      premiumPeriod.textContent = "/mes"
    }
  }

  // Efectos hover mejorados para las cards
  const cards = document.querySelectorAll(".planes_card")

  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      // Efecto en las features
      const features = this.querySelectorAll(".planes_features_list li")
      features.forEach((feature, index) => {
        setTimeout(() => {
          feature.style.transform = "translateX(5px)"
          feature.style.opacity = "1"
        }, index * 50)
      })

      // Efecto en el precio
      const priceAmount = this.querySelector(".planes_price_amount")
      if (priceAmount) {
        priceAmount.style.transform = "scale(1.1)"
        priceAmount.style.color = "var(--color-rosa)"
      }
    })

    card.addEventListener("mouseleave", function () {
      // Restaurar features
      const features = this.querySelectorAll(".planes_features_list li")
      features.forEach((feature) => {
        feature.style.transform = "translateX(0)"
        feature.style.opacity = "0.9"
      })

      // Restaurar precio
      const priceAmount = this.querySelector(".planes_price_amount")
      if (priceAmount) {
        priceAmount.style.transform = "scale(1)"
        priceAmount.style.color = "var(--color-morado-oscuro)"
      }
    })
  })

  // Función para mostrar feedback de planes
  function showPlanFeedback(message, type = "success") {
    const feedback = document.createElement("div")
    feedback.className = `plan-feedback ${type}`
    feedback.innerHTML = `
      <div class="plan-feedback-content">
        <span class="plan-feedback-icon">${type === "success" ? "✓" : "!"}</span>
        <span class="plan-feedback-message">${message}</span>
      </div>
    `

    feedback.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${
        type === "success"
          ? "linear-gradient(135deg, var(--color-rosa), var(--color-naranja))"
          : "linear-gradient(135deg, #ff6b6b, #ffa500)"
      };
      color: white;
      padding: 20px 25px;
      border-radius: 15px;
      font-family: var(--letra-botones);
      font-weight: 600;
      z-index: 1000;
      transform: translateX(100%);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      max-width: 350px;
    `

    document.body.appendChild(feedback)

    setTimeout(() => {
      feedback.style.transform = "translateX(0)"
    }, 100)

    setTimeout(() => {
      feedback.style.transform = "translateX(100%)"
      setTimeout(() => {
        document.body.removeChild(feedback)
      }, 400)
    }, 4000)
  }

  // Animación de contador para el precio
  function animatePrice(element, targetPrice, duration = 1000) {
    const startPrice = 0
    const increment = targetPrice / (duration / 16)
    let currentPrice = startPrice

    function updatePrice() {
      currentPrice += increment
      if (currentPrice < targetPrice) {
        element.textContent = Math.floor(currentPrice).toLocaleString()
        requestAnimationFrame(updatePrice)
      } else {
        element.textContent = targetPrice.toLocaleString()
      }
    }

    updatePrice()
  }

  // Animar precios cuando entran en vista
  const priceElements = document.querySelectorAll(".planes_price_amount")
  const priceObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const priceText = entry.target.textContent.replace(/[.,]/g, "")
        const priceValue = Number.parseInt(priceText)
        if (priceValue > 0) {
          animatePrice(entry.target, priceValue)
        }
        priceObserver.unobserve(entry.target)
      }
    })
  })

  priceElements.forEach((el) => priceObserver.observe(el))

  // FAQ interactivo
  const faqItems = document.querySelectorAll(".planes_faq_item")

  faqItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Efecto de "pulso" al hacer click
      this.style.transform = "scale(0.98)"
      setTimeout(() => {
        this.style.transform = "translateY(-5px)"
      }, 150)
    })
  })
})

// CSS adicional para efectos
const additionalCSSPLanes = `
.ripple {
  position: absolute;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.4);
  transform: scale(0);
  animation: ripple-animation 0.6s linear;
  pointer-events: none;
}

@keyframes ripple-animation {
  to {
    transform: scale(4);
    opacity: 0;
  }
}

.plan-feedback-content {
  display: flex;
  align-items: center;
  gap: 12px;
}

.plan-feedback-icon {
  font-size: 1.2rem;
  font-weight: bold;
}

.planes_price_amount {
  transition: all 0.3s ease;
}

.animate-in {
  animation-play-state: running;
}
`

// Agregar CSS adicional
const stylePlanes = document.createElement("style")
stylePlanes.textContent = additionalCSSPLanes
document.head.appendChild(stylePlanes)
