// FlameReactive.js (versión ES6)

const typeHandlers = {
  render: handleRender,
  form: handleForm,
  conditional: handleConditional,
};

function init() {

  document.addEventListener('submit', (event) => {
    event.preventDefault();
  });
  const events = ['click', 'input', 'change', 'submit', 'keydown', 'focus', 'blur'];

  events.forEach(eventType => {
    document.addEventListener(eventType, async (event) => {
      const el = event.target.closest('[data-name][data-type][data-event]');
      if (!el) return;

      const expectedEvent = el.dataset.event;
      if (expectedEvent !== event.type) return;

      event.preventDefault(); // 👈 Evita recargas, submits, etc.

      const type = el.dataset.type;
      const name = el.dataset.name;
      const handler = typeHandlers[type];

      if (!handler) return;

      try {
        const formData = handler(name, el);
        formData.append('data-name', name);
        formData.append('data-type', type);

        const response = await sendRequest(formData);
        processResponse(response);
      } catch (err) {
        console.error(err);
      }
    });
  });
}


function handleRender(name, el) {
  const formData = new FormData();

  // Solo si el ejecutador tiene nombre y valor
  if (el.name && typeof el.value !== 'undefined' && el.value !== '') {
    formData.append(el.name, el.value);
  }

  return formData;
}

function handleForm(name) {
  const form = document.querySelector(`form[data-name="${name}"]`);
  if (!form) throw new Error(`Formulario con data-name="${name}" no encontrado`);
  return new FormData(form);
}

function handleConditional(name) {
  const elements = document.querySelectorAll(`[data-name="${name}"][data-type="conditional"]`);
  const formData = new FormData();

  elements.forEach(el => {
    if (el.name) formData.append(el.name, el.value ?? '');
    if (el.type === 'file') {
      [...el.files].forEach((file, i) => {
        formData.append(`${el.name}[${i}]`, file);
      });
    }
  });

  return formData;
}

async function sendRequest(formData) {
  const response = await fetch('Reactions.php', {
    method: 'POST',
    body: formData,
  });

  if (!response.ok) throw new Error('Error HTTP');

  return await response.json();
}

function processResponse(response) {
  const {
    target = '#app',
    html,
    htmlActionType = null,
    actions = null,
    redirect = null,
  } = response;

  const elements = document.querySelectorAll(target);
  if (elements.length === 0) return;

  // Manejo de contenido HTML
  if (html && htmlActionType) {
    elements.forEach(el => {
      if (htmlActionType === 'replaceHtml') {
        el.innerHTML = html;
      } else if (htmlActionType === 'addHtml') {
        el.insertAdjacentHTML('beforeend', html);
      }
    });
  }

  // Manejo de acciones (clases, atributos)
  if (actions && Array.isArray(actions)) {
    elements.forEach(el => {
      actions.forEach(action => {
        switch (action.type) {
          case 'addClass':
            if (action.className) el.classList.add(action.className);
            break;
          case 'removeClass':
            if (action.className) el.classList.remove(action.className);
            break;
          case 'setAttribute':
            if (action.attribute) el.setAttribute(action.attribute, action.value || '');
            break;
          case 'removeAttribute':
            if (action.attribute) el.removeAttribute(action.attribute);
            break;
          default:
            console.warn('Acción no soportada:', action.type);
        }
      });
    });
  }

  // Manejo de redirección
  if (redirect) {
    redirectWithDelay(redirect);
  }
}

function redirectWithDelay(url, delay = 3000) {
  setTimeout(() => {
    window.location.href = url;
  }, delay);
}

// Exportar el módulo
export default {
  init,
  setHandler: (type, fn) => typeHandlers[type] = fn,
  removeHandler: (type) => delete typeHandlers[type],
};
