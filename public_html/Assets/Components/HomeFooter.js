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
  const animateElements = document.querySelectorAll(".footer_column, .footer_info, .footer_bottom")
  animateElements.forEach((el) => observer.observe(el))

  // Manejo del formulario de newsletter
  const newsletterForm = document.querySelector(".footer_newsletter_form")

  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      e.preventDefault()

      const emailInput = this.querySelector(".footer_newsletter_input")
      const submitButton = this.querySelector(".footer_newsletter_button")
      const email = emailInput.value.trim()

      // Validación básica
      if (!email || !isValidEmail(email)) {
        showFooterFeedback("Por favor, ingresá un email válido", "error")
        emailInput.focus()
        return
      }

      // Mostrar loading
      const originalText = submitButton.textContent
      submitButton.textContent = "Suscribiendo..."
      submitButton.disabled = true

      // Simular suscripción
      setTimeout(() => {
        showFooterFeedback("¡Genial! Ya estás suscripto a nuestras novedades 🎉", "success")

        // Limpiar formulario
        emailInput.value = ""

        // Restaurar botón
        submitButton.textContent = originalText
        submitButton.disabled = false

        // Efecto especial en el input
        emailInput.placeholder = "¡Gracias por suscribirte!"
        setTimeout(() => {
          emailInput.placeholder = "tu@email.com"
        }, 3000)
      }, 1500)
    })
  }

  // Validación de email
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailRegex.test(email)
  }

  // Efectos hover para redes sociales
  const socialLinks = document.querySelectorAll(".footer_social_link")

  socialLinks.forEach((link) => {
    link.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) scale(1.15) rotate(5deg)"
    })

    link.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1) rotate(0deg)"
    })

    // Efecto click con feedback
    link.addEventListener("click", function (e) {
      const platform = this.classList.contains("whatsapp")
        ? "WhatsApp"
        : this.classList.contains("instagram")
          ? "Instagram"
          : this.classList.contains("tiktok")
            ? "TikTok"
            : "Twitter"

      showFooterFeedback(`¡Dale! Te llevamos a nuestro ${platform} 🚀`, "social")
    })
  })

  // Efecto hover para enlaces del footer
  const footerLinks = document.querySelectorAll(".footer_link")

  footerLinks.forEach((link) => {
    link.addEventListener("mouseenter", function () {
      this.style.transform = "translateX(8px)"
    })

    link.addEventListener("mouseleave", function () {
      this.style.transform = "translateX(0)"
    })
  })

  // Animación de contador para badges (si quisieras agregar números)
  function animateNumber(element, target, duration = 2000) {
    let start = 0
    const increment = target / (duration / 16)

    function update() {
      start += increment
      if (start < target) {
        element.textContent = Math.floor(start)
        requestAnimationFrame(update)
      } else {
        element.textContent = target
      }
    }

    update()
  }

  // Efecto especial para el logo
  const logo = document.querySelector(".footer_logo")
  if (logo) {
    logo.addEventListener("click", function () {
      const flag = this.querySelector(".footer_logo_flag")
      flag.style.animation = "none"
      setTimeout(() => {
        flag.style.animation = "wave 1s ease-in-out 3"
      }, 10)

      showFooterFeedback("¡Aguante Argentina! 🇦🇷", "success")
    })
  }

  

  // Función para mostrar feedback del footer
  function showFooterFeedback(message, type = "success") {
    const feedback = document.createElement("div")
    feedback.className = `footer-feedback ${type}`

    let bgColor = "linear-gradient(135deg, var(--color-rosa), var(--color-naranja))"
    let icon = "✓"

    switch (type) {
      case "error":
        bgColor = "linear-gradient(135deg, #ff6b6b, #ffa500)"
        icon = "⚠️"
        break
      case "social":
        bgColor = "linear-gradient(135deg, #74b9ff, #0984e3)"
        icon = "🚀"
        break
    }

    feedback.innerHTML = `
      <div class="footer-feedback-content">
        <span class="footer-feedback-icon">${icon}</span>
        <span class="footer-feedback-message">${message}</span>
      </div>
    `

    feedback.style.cssText = `
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: ${bgColor};
      color: white;
      padding: 15px 20px;
      border-radius: 12px;
      font-family: var(--letra-botones);
      font-weight: 600;
      font-size: 0.9rem;
      z-index: 1000;
      transform: translateY(100px);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      max-width: 350px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    `

    document.body.appendChild(feedback)

    setTimeout(() => {
      feedback.style.transform = "translateY(0)"
    }, 100)

    setTimeout(() => {
      feedback.style.transform = "translateY(100px)"
      setTimeout(() => {
        document.body.removeChild(feedback)
      }, 400)
    }, 3000)
  }

  // Easter egg: Konami code
  const konamiCode = []
  const konamiSequence = [
    "ArrowUp",
    "ArrowUp",
    "ArrowDown",
    "ArrowDown",
    "ArrowLeft",
    "ArrowRight",
    "ArrowLeft",
    "ArrowRight",
    "KeyB",
    "KeyA",
  ]

  document.addEventListener("keydown", (e) => {
    konamiCode.push(e.code)
    if (konamiCode.length > konamiSequence.length) {
      konamiCode.shift()
    }

    if (JSON.stringify(konamiCode) === JSON.stringify(konamiSequence)) {
      showFooterFeedback("¡Código Konami activado! Sos un crack 🎮", "success")
      // Aquí podrías agregar algún efecto especial
      document.body.style.animation = "rainbow 2s ease-in-out"
      setTimeout(() => {
        document.body.style.animation = ""
      }, 2000)
    }
  })

  // Efecto de typing en el placeholder del newsletter
  const newsletterInput = document.querySelector(".footer_newsletter_input")
  if (newsletterInput) {
    const originalPlaceholder = newsletterInput.placeholder
    let typingTimeout

    newsletterInput.addEventListener("focus", function () {
      if (this.value === "") {
        clearTimeout(typingTimeout)
        this.placeholder = ""
        typeText(this, originalPlaceholder, 100)
      }
    })

    newsletterInput.addEventListener("blur", function () {
      clearTimeout(typingTimeout)
      this.placeholder = originalPlaceholder
    })

    function typeText(element, text, speed) {
      let i = 0
      function type() {
        if (i < text.length) {
          element.placeholder += text.charAt(i)
          i++
          typingTimeout = setTimeout(type, speed)
        }
      }
      type()
    }
  }
})

// CSS adicional para efectos
const additionalCSSFooter = `
.footer-feedback-content {
  display: flex;
  align-items: center;
  gap: 10px;
}

.footer-feedback-icon {
  font-size: 1.1rem;
}

.animate-in {
  animation-play-state: running;
}

@keyframes rainbow {
  0% { filter: hue-rotate(0deg); }
  100% { filter: hue-rotate(360deg); }
}

.footer_newsletter_input:focus {
  transform: scale(1.02);
}

.footer_social_link {
  position: relative;
  overflow: hidden;
}

.footer_social_link::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.3s ease;
}

.footer_social_link:hover::after {
  width: 100%;
  height: 100%;
}
`

// Agregar CSS adicional
const styleFooter = document.createElement("style")
styleFooter.textContent = additionalCSSFooter
document.head.appendChild(styleFooter)
