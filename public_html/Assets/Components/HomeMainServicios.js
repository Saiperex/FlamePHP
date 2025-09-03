document.addEventListener("DOMContentLoaded", () => {
  // Intersection Observer para animaciones
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-in")

        // Animación especial para las features
        const features = entry.target.querySelectorAll(".servicios_card_features li")
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
  const animateElements = document.querySelectorAll(".servicios_card, .servicios_header, .servicios_cta")
  animateElements.forEach((el) => observer.observe(el))

  // Inicializar features ocultas para animación
  const allFeatures = document.querySelectorAll(".servicios_card_features li")
  allFeatures.forEach((feature) => {
    feature.style.opacity = "0"
    feature.style.transform = "translateX(-20px)"
    feature.style.transition = "all 0.3s ease"
  })

  // Efecto hover mejorado para las cards
  const cards = document.querySelectorAll(".servicios_card")

  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      // Efecto en el icono
      const icon = this.querySelector(".servicios_card_icon")
      if (icon) {
        icon.style.transform = "scale(1.1) rotate(5deg)"
      }

      // Efecto en las features
      const features = this.querySelectorAll(".servicios_card_features li")
      features.forEach((feature, index) => {
        setTimeout(() => {
          feature.style.transform = "translateX(5px)"
        }, index * 50)
      })
    })

    card.addEventListener("mouseleave", function () {
      // Restaurar icono
      const icon = this.querySelector(".servicios_card_icon")
      if (icon) {
        icon.style.transform = "scale(1) rotate(0deg)"
      }

      // Restaurar features
      const features = this.querySelectorAll(".servicios_card_features li")
      features.forEach((feature) => {
        feature.style.transform = "translateX(0)"
      })
    })
  })
  // Función para mostrar feedback
  function showFeedback(message) {
    const feedback = document.createElement("div")
    feedback.className = "feedback-message"
    feedback.textContent = message
    feedback.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: linear-gradient(135deg, var(--color-rosa), var(--color-naranja));
      color: white;
      padding: 15px 25px;
      border-radius: 10px;
      font-family: var(--letra-botones);
      font-weight: 600;
      z-index: 1000;
      transform: translateX(100%);
      transition: transform 0.3s ease;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    `

    document.body.appendChild(feedback)

    setTimeout(() => {
      feedback.style.transform = "translateX(0)"
    }, 100)

    setTimeout(() => {
      feedback.style.transform = "translateX(100%)"
      setTimeout(() => {
        document.body.removeChild(feedback)
      }, 300)
    }, 3000)
  }

  // Contador animado para estadísticas (si quieres agregar números)
  function animateCounter(element, target, duration = 2000) {
    let start = 0
    const increment = target / (duration / 16)

    function updateCounter() {
      start += increment
      if (start < target) {
        element.textContent = Math.floor(start)
        requestAnimationFrame(updateCounter)
      } else {
        element.textContent = target
      }
    }

    updateCounter()
  }

  // Detectar si una card está en "coming soon" y agregar efectos especiales
  const comingSoonCards = document.querySelectorAll(".servicios_card.coming_soon")

  comingSoonCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      // Efecto especial para "próximamente"
      this.style.background = "linear-gradient(135deg, var(--color-gris), rgba(255, 92, 138, 0.05))"
    })

    card.addEventListener("mouseleave", function () {
      this.style.background = "linear-gradient(135deg, var(--color-gris), rgba(26, 14, 42, 0.02))"
    })
  })
})

// CSS adicional para efectos
const additionalCSSServicios = `
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

.servicios_card_features li {
  transition: all 0.3s ease;
}

.animate-in {
  animation-play-state: running;
}
`

// Agregar CSS adicional
const styleServicios = document.createElement("style")
styleServicios.textContent = additionalCSSServicios
document.head.appendChild(styleServicios)
