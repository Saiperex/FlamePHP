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
      }
    })
  }, observerOptions)

  // Observar elementos para animación
  const animateElements = document.querySelectorAll(
    ".argentina_card, .argentina_header, .argentina_contact, .argentina_stats, .argentina_testimonials, .argentina_cta",
  )
  animateElements.forEach((el) => observer.observe(el))

  // Animación de números en las estadísticas
  function animateCounter(element, target, duration = 2000) {
    let start = 0
    const increment = target / (duration / 16)

    function updateCounter() {
      start += increment
      if (start < target) {
        element.textContent = Math.floor(start).toLocaleString() + (element.textContent.includes("+") ? "+" : "")
        requestAnimationFrame(updateCounter)
      } else {
        element.textContent = target.toLocaleString() + (element.textContent.includes("+") ? "+" : "")
      }
    }

    updateCounter()
  }

  // Animar estadísticas cuando entran en vista
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const numberElement = entry.target.querySelector(".argentina_stat_number")
        const text = numberElement.textContent

        if (text.includes("2.500")) {
          animateCounter(numberElement, 2500)
        } else if (text.includes("24")) {
          animateCounter(numberElement, 24, 1000)
        } else if (text.includes("100")) {
          animateCounter(numberElement, 100, 1500)
        } else if (text.includes("0")) {
          // Para el "0 dólares", hacer una animación especial
          numberElement.style.color = "#00b894"
          numberElement.style.fontSize = "3.5rem"
        }

        statsObserver.unobserve(entry.target)
      }
    })
  })

  const statElements = document.querySelectorAll(".argentina_stat")
  statElements.forEach((el) => statsObserver.observe(el))

  // Efectos hover mejorados para las cards
  const cards = document.querySelectorAll(".argentina_card")

  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      const icon = this.querySelector(".argentina_card_icon")
      if (icon) {
        icon.style.transform = "scale(1.2) rotate(10deg)"
        icon.style.transition = "transform 0.3s ease"
      }

      const highlight = this.querySelector(".argentina_card_highlight")
      if (highlight) {
        highlight.style.transform = "scale(1.05)"
        highlight.style.boxShadow = "0 12px 30px rgba(116, 185, 255, 0.4)"
      }
    })

    card.addEventListener("mouseleave", function () {
      const icon = this.querySelector(".argentina_card_icon")
      if (icon) {
        icon.style.transform = "scale(1) rotate(0deg)"
      }

      const highlight = this.querySelector(".argentina_card_highlight")
      if (highlight) {
        highlight.style.transform = "scale(1)"
        highlight.style.boxShadow = "0 8px 20px rgba(116, 185, 255, 0.3)"
      }
    })
  })

  // Función para mostrar feedback argentino
  function showArgentinaFeedback(message, type = "success") {
    const feedback = document.createElement("div")
    feedback.className = `argentina-feedback ${type}`
    feedback.innerHTML = `
      <div class="argentina-feedback-content">
        <span class="argentina-feedback-icon">${type === "success" ? "🇦🇷" : "⚠️"}</span>
        <span class="argentina-feedback-message">${message}</span>
      </div>
    `

    feedback.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${
        type === "success" ? "linear-gradient(135deg, #74b9ff, #0984e3)" : "linear-gradient(135deg, #ff7675, #fd79a8)"
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
      max-width: 400px;
      border: 2px solid rgba(255, 255, 255, 0.2);
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
    }, 5000)
  }
  // Efecto especial para testimonios
  const testimonials = document.querySelectorAll(".argentina_testimonial")

  testimonials.forEach((testimonial, index) => {
    testimonial.addEventListener("mouseenter", function () {
      // Efecto de "lectura" - resaltar el texto
      const text = this.querySelector(".argentina_testimonial_text")
      text.style.color = "#0984e3"
      text.style.fontWeight = "500"
    })

    testimonial.addEventListener("mouseleave", function () {
      const text = this.querySelector(".argentina_testimonial_text")
      text.style.color = "var(--color-morado-oscuro)"
      text.style.fontWeight = "normal"
    })
  })

  // Easter egg: doble click en la bandera
  const flag = document.querySelector(".argentina_flag")
  if (flag) {
    let clickCount = 0
    flag.addEventListener("click", function () {
      clickCount++
      if (clickCount === 2) {
        this.textContent = "⚽"
        showArgentinaFeedback("¡GOOOOOL! Como Messi en el Mundial 🏆", "success")
        setTimeout(() => {
          this.textContent = "🇦🇷"
          clickCount = 0
        }, 3000)
      }
      setTimeout(() => {
        if (clickCount === 1) clickCount = 0
      }, 500)
    })
  }

  // Frases argentinas aleatorias para el hover de la bandera
  const frasesArgentinas = [
    "¡Aguante Argentina!",
    "Che, qué bueno que es esto",
    "Dale que vamos bien",
    "¡Vamos Argentina carajo!",
    "Esto está bárbaro",
    "¡Dale campeón!",
  ]

  if (flag) {
    flag.addEventListener("mouseenter", function () {
      const fraseRandom = frasesArgentinas[Math.floor(Math.random() * frasesArgentinas.length)]
      this.title = fraseRandom
    })
  }
})

// CSS adicional para efectos
const additionalCSS = `
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

.argentina-feedback-content {
  display: flex;
  align-items: center;
  gap: 12px;
}

.argentina-feedback-icon {
  font-size: 1.5rem;
}

.argentina_card_icon {
  transition: transform 0.3s ease;
}

.argentina_card_highlight {
  transition: all 0.3s ease;
}

.animate-in {
  animation-play-state: running;
}

.argentina_flag {
  cursor: pointer;
  transition: transform 0.3s ease;
}

.argentina_flag:hover {
  transform: scale(1.1);
}
`

// Agregar CSS adicional
const style = document.createElement("style")
style.textContent = additionalCSS
document.head.appendChild(style)
