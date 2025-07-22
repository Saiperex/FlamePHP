// FlameReactive.js (versión ES6)

const typeHandlers = {
  render: handleRender,
  form: handleForm,
  conditional: handleConditional,
};

function init() {
  const events = ['click', 'input', 'change', 'submit', 'keydown', 'focus', 'blur'];

  events.forEach(eventType => {
    document.addEventListener(eventType, async (event) => {
      const el = event.target.closest('[data-name][data-type][data-event]');
      if (!el) return;

      const expectedEvent = el.dataset.event;
      if (expectedEvent !== event.type) return;

      const type = el.dataset.type;
      const name = el.dataset.name;
      const handler = typeHandlers[type];

      if (!handler) return;

      try {
        const formData = handler(name);
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

function handleRender(name) {
  const formData = new FormData();
  formData.append('data-name', name);
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
  const { html, target = '#app' } = response;
  const container = document.querySelector(target);
  if (container) container.innerHTML = html;
}

// Exportar el módulo
export default {
  init,
  setHandler: (type, fn) => typeHandlers[type] = fn,
  removeHandler: (type) => delete typeHandlers[type],
};
