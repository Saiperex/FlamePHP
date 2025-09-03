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
    ".contacto_method, .contacto_header, .contacto_form_section, .contacto_info_extra, .contacto_cta",
  )
  animateElements.forEach((el) => observer.observe(el))

  // Efectos hover mejorados para métodos de contacto
  const methods = document.querySelectorAll(".contacto_method")

  methods.forEach((method) => {
    method.addEventListener("mouseenter", function () {
      const icon = this.querySelector(".contacto_icon_symbol")
      const bg = this.querySelector(".contacto_icon_bg")

      if (icon) {
        icon.style.transform = "scale(1.2) rotate(10deg)"
      }
      if (bg) {
        bg.style.transform = "scale(1.2)"
        bg.style.opacity = "0.3"
      }

      // Efecto especial por plataforma
      if (this.classList.contains("whatsapp")) {
        this.style.borderColor = "#25d366"
        this.style.boxShadow = "0 25px 60px rgba(37, 211, 102, 0.2)"
      } else if (this.classList.contains("instagram")) {
        this.style.borderColor = "#e4405f"
        this.style.boxShadow = "0 25px 60px rgba(228, 64, 95, 0.2)"
      } else if (this.classList.contains("tiktok")) {
        this.style.borderColor = "#000000"
        this.style.boxShadow = "0 25px 60px rgba(0, 0, 0, 0.2)"
      }
    })

    method.addEventListener("mouseleave", function () {
      const icon = this.querySelector(".contacto_icon_symbol")
      const bg = this.querySelector(".contacto_icon_bg")

      if (icon) {
        icon.style.transform = "scale(1) rotate(0deg)"
      }
      if (bg) {
        bg.style.transform = "scale(1)"
        bg.style.opacity = "0.1"
      }

      this.style.borderColor = "transparent"
      this.style.boxShadow = "0 15px 40px rgba(26, 14, 42, 0.08)"
    })
  })
  
  // Botón CTA final
  const ctaButton = document.querySelector(".contacto_cta_button")

  if (ctaButton) {
    ctaButton.addEventListener("click", () => {
      showContactoFeedback("¡Dale! Te llevamos a crear tu AppSite gratis 🚀", "success")

      setTimeout(() => {
        // Aquí redirigirías al registro
         window.location.href = 'crear';
        console.log("Redirigiendo al Builder...")
      }, 1500)
    })
  }

  // Función para mostrar feedback de contacto
  function showContactoFeedback(message, type = "success") {
    const feedback = document.createElement("div")
    feedback.className = `contacto-feedback ${type}`

    let bgColor = "linear-gradient(135deg, var(--color-rosa), var(--color-naranja))"
    let icon = "✓"

    switch (type) {
      case "whatsapp":
        bgColor = "linear-gradient(135deg, #25d366, #128c7e)"
        icon = "💬"
        break
      case "instagram":
        bgColor = "linear-gradient(135deg, #f09433, #e4405f)"
        icon = "📸"
        break
      case "tiktok":
        bgColor = "linear-gradient(135deg, #000000, #333333)"
        icon = "🎵"
        break
    }

    feedback.innerHTML = `
      <div class="contacto-feedback-content">
        <span class="contacto-feedback-icon">${icon}</span>
        <span class="contacto-feedback-message">${message}</span>
      </div>
    `

    feedback.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${bgColor};
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
    }, 4000)
  }
  // Animación de escritura para los placeholders
  function typewriterEffect(element, text, speed = 100) {
    let i = 0
    element.placeholder = ""

    function type() {
      if (i < text.length) {
        element.placeholder += text.charAt(i)
        i++
        setTimeout(type, speed)
      }
    }

    type()
  }

  // Aplicar efecto de escritura a algunos inputs
  const messageTextarea = document.querySelector("#mensaje")
  if (messageTextarea) {
    setTimeout(() => {
      typewriterEffect(messageTextarea, "Contanos tu consulta, idea o lo que necesites...", 50)
    }, 2000)
  }
})

// CSS adicional para efectos
const additionalCSSContacto = `
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

.contacto-feedback-content {
  display: flex;
  align-items: center;
  gap: 12px;
}

.contacto-feedback-icon {
  font-size: 1.3rem;
}

.contacto_form_input.error,
.contacto_form_textarea.error {
  border-color: #ff6b6b;
  background: rgba(255, 107, 107, 0.05);
}

.error-message {
  color: #ff6b6b;
  font-size: 0.85rem;
  font-family: var(--letra-texto);
  margin-top: 5px;
  font-weight: 500;
}

.animate-in {
  animation-play-state: running;
}

.contacto_method_button {
  position: relative;
  overflow: hidden;
}
`

// Agregar CSS adicional
const styleContacto = document.createElement("style")
styleContacto.textContent = additionalCSSContacto
document.head.appendChild(styleContacto)
