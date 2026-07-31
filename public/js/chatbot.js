// ============================================================
//  WIDGET CHATBOT DRTPE – DROPDOWN CORREGIDO (hacia abajo)
// ============================================================

(function() {
    const API_BASE = 'http://localhost:8001';
    const SESSION_KEY = 'drtpe_session_id';

    let sessionId = localStorage.getItem(SESSION_KEY);
    if (!sessionId) {
        sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem(SESSION_KEY, sessionId);
    }

    function loadMarked() {
        return new Promise((resolve) => {
            if (typeof marked !== 'undefined') {
                configureMarked();
                resolve();
                return;
            }
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/marked/marked.min.js';
            script.onload = () => {
                configureMarked();
                resolve();
            };
            script.onerror = resolve;
            document.head.appendChild(script);
        });
    }

    function configureMarked() {
        if (typeof marked === 'undefined') return;
        const renderer = new marked.Renderer();
        renderer.link = function(href, title, text) {
            return `<a href="${href}" target="_blank" rel="noopener noreferrer" title="${title || ''}">${text}</a>`;
        };
        marked.setOptions({
            breaks: true,
            gfm: true,
            renderer: renderer
        });
    }

    // ---- Crear el widget ----
    const container = document.createElement('div');
    container.id = 'drtpe-chatbot-widget';
    document.body.appendChild(container);

    if (!document.querySelector('link[href*="chatbot.css"]')) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '/css/chatbot.css';
        document.head.appendChild(link);
    }

    // ---- HTML ----
    container.innerHTML = `
        <button class="drtpe-chat-button" id="drtpe-chat-toggle" aria-label="Abrir chat">
            <img src="/images/chatbot.png" alt="Chat" class="chat-icon-img">
        </button>
        <div class="drtpe-chat-panel" id="drtpe-chat-panel">
            <div class="drtpe-chat-header">
                <div class="header-left">
                    <img src="/images/chatbot.png" alt="Bot" class="header-avatar">
                    <div class="title-group">
                        <h3>EmpleaBot DRTPE Puno</h3>
                        <p>Dirección Regional de Trabajo y Promoción del Empleo</p>
                    </div>
                </div>
                <button class="close-btn" id="drtpe-chat-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="drtpe-chat-body" id="drtpe-chat-body"></div>
            <div class="drtpe-quick-options" id="drtpe-quick-options">
                <!-- CHIPS -->
                <button class="chip" data-msg="¿Cuáles son los requisitos para tramitar la bolsa de trabajo?">
                    <i class="fas fa-clipboard-list"></i> Requisitos
                </button>
                <button class="chip" data-msg="¿Cómo puedo inscribirme en la bolsa de empleo?">
                    <i class="fas fa-briefcase"></i> Bolsa de empleo
                </button>
                <button class="chip" data-msg="¿Qué consultas laborales puedo realizar?">
                    <i class="fas fa-scale-balanced"></i> Consultas laborales
                </button>

                <!-- DROPDOWN -->
                <div class="dropdown-container">
                    <button class="dropdown-toggle" id="dropdown-toggle">
                        <i class="fas fa-ellipsis-h"></i> Más
                    </button>
                    <ul class="dropdown-menu" id="dropdown-menu">
                        <li data-msg="¿Qué es el SOVIO y a quién está dirigido?">
                            <i class="fas fa-graduation-cap"></i> Orientación vocacional
                        </li>
                        <li data-msg="¿Cómo puedo obtener mi Certificado Único Laboral (CUL)?">
                            <i class="fas fa-id-card"></i> Certificado Único Laboral
                        </li>
                        <li data-msg="¿Qué es el REMYPE y cómo registro mi empresa?">
                            <i class="fas fa-building"></i> Registro REMYPE
                        </li>
                        <li data-msg="¿Cuáles son los beneficios de formalizar mi negocio?">
                            <i class="fas fa-chart-line"></i> Beneficios de formalización
                        </li>
                        <li data-msg="¿Cómo puedo acceder a capacitaciones laborales?">
                            <i class="fas fa-chalkboard-user"></i> Capacitaciones
                        </li>
                        <li data-msg="¿Qué hago si tengo una denuncia laboral?">
                            <i class="fas fa-gavel"></i> Denuncias laborales
                        </li>
                        <li data-msg="¿Dónde quedan las oficinas de la DRTPE en Puno?">
                            <i class="fas fa-map-pin"></i> Ubicación oficinas
                        </li>
                        <li data-msg="¿Cuál es el horario de atención al público?">
                            <i class="fas fa-clock"></i> Horario de atención
                        </li>
                        <li data-msg="¿Cómo puedo contactar a un asesor?">
                            <i class="fas fa-phone"></i> Contactar asesor
                        </li>
                        <li data-msg="¿Qué documentos necesito para inscribirme en la bolsa de trabajo?">
                            <i class="fas fa-file-lines"></i> Documentos bolsa de trabajo
                        </li>
                        <li data-msg="¿Qué es el RETCC y cómo me registro?">
                            <i class="fas fa-helmet-safety"></i> Registro RETCC
                        </li>
                        <li data-msg="¿Cómo puedo mejorar mi currículum vitae?">
                            <i class="fas fa-pen-fancy"></i> Mejorar CV
                        </li>
                    </ul>
                </div>
            </div>
            <div class="drtpe-chat-footer">
                <input type="text" id="drtpe-chat-input" placeholder="Escribe tu consulta..." autocomplete="off">
                <button id="drtpe-chat-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    `;

    // ---- REFERENCIAS ----
    const toggleBtn = document.getElementById('drtpe-chat-toggle');
    const panel = document.getElementById('drtpe-chat-panel');
    const closeBtn = document.getElementById('drtpe-chat-close');
    const body = document.getElementById('drtpe-chat-body');
    const input = document.getElementById('drtpe-chat-input');
    const sendBtn = document.getElementById('drtpe-chat-send');
    const optionsContainer = document.getElementById('drtpe-quick-options');
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');

    let isOpen = false;
    let isWaitingResponse = false;
    let dropdownOpen = false;

    // ---- MARKDOWN ----
    function renderMarkdown(text) {
        if (typeof marked !== 'undefined') {
            try {
                return marked.parse(text);
            } catch (e) {
                return text;
            }
        }
        return text;
    }

    // ---- AÑADIR MENSAJE ----
    function addMessageWithWrapper(text, sender, sources = null, needsDerivation = false) {
        const wrapper = document.createElement('div');
        wrapper.className = `message-wrapper ${sender}`;

        if (sender === 'bot') {
            const avatar = document.createElement('img');
            avatar.className = 'avatar';
            avatar.src = '/images/chatbot.png';
            avatar.alt = 'Bot';
            avatar.loading = 'lazy';
            wrapper.appendChild(avatar);
        }

        const msgDiv = document.createElement('div');
        msgDiv.className = sender === 'bot' ? 'message-content bot' : 'message-content';

        if (sender === 'user') {
            msgDiv.textContent = text;
            wrapper.appendChild(msgDiv);
            body.appendChild(wrapper);
            body.scrollTop = body.scrollHeight;
            return;
        }

        const fullText = text;
        const words = fullText.match(/\S+\s*/g) || [];
        let idx = 0;

        wrapper.appendChild(msgDiv);
        body.appendChild(wrapper);

        function addNextWord() {
            if (idx < words.length) {
                msgDiv.textContent += words[idx];
                idx++;
                body.scrollTop = body.scrollHeight;
                setTimeout(addNextWord, 35);
            } else {
                if (typeof marked !== 'undefined') {
                    try {
                        msgDiv.innerHTML = renderMarkdown(fullText);
                    } catch (e) {
                        msgDiv.textContent = fullText;
                    }
                } else {
                    msgDiv.textContent = fullText;
                }
                if (needsDerivation) {
                    showDerivationForm();
                }
                body.scrollTop = body.scrollHeight;
            }
        }

        addNextWord();
    }

    function addMessage(text, sender, sources = null, needsDerivation = false) {
        addMessageWithWrapper(text, sender, sources, needsDerivation);
    }

    // ---- ENLACES ----
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href) {
            const msgContent = link.closest('.message-content.bot');
            if (msgContent) {
                e.preventDefault();
                window.open(link.href, '_blank', 'noopener,noreferrer');
            }
        }
    });

    // ---- DROPDOWN ----
    dropdownToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownOpen = !dropdownOpen;
        dropdownMenu.style.display = dropdownOpen ? 'block' : 'none';
        console.log('Dropdown toggled:', dropdownOpen);
    });

    // Cerrar al hacer clic fuera
    document.addEventListener('click', function(e) {
        const isInside = e.target.closest('.dropdown-container');
        if (!isInside && dropdownOpen) {
            dropdownOpen = false;
            dropdownMenu.style.display = 'none';
        }
    });

    // Opciones del dropdown
    dropdownMenu.querySelectorAll('li').forEach(function(item) {
        item.addEventListener('click', function(e) {
            const msg = this.dataset.msg;
            if (msg) {
                sendMessage(msg);
                dropdownOpen = false;
                dropdownMenu.style.display = 'none';
            }
        });
    });

    // ---- FUNCIONES AUXILIARES ----
    function showTyping() {
        const wrapper = document.createElement('div');
        wrapper.className = 'typing-wrapper';

        const avatar = document.createElement('img');
        avatar.className = 'avatar';
        avatar.src = '/images/chatbot.png';
        avatar.alt = 'Bot';
        avatar.loading = 'lazy';
        wrapper.appendChild(avatar);

        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'drtpe-typing';
        typingDiv.innerHTML = '<span></span><span></span><span></span>';

        wrapper.appendChild(typingDiv);
        body.appendChild(wrapper);
        body.scrollTop = body.scrollHeight;
    }

    function hideTyping() {
        const typing = document.getElementById('drtpe-typing');
        if (typing) {
            const wrapper = typing.closest('.typing-wrapper');
            if (wrapper) wrapper.remove();
        }
    }

    function showDerivationForm() {
        if (document.getElementById('drtpe-derivation-form')) return;
        const formDiv = document.createElement('div');
        formDiv.id = 'drtpe-derivation-form';
        formDiv.className = 'drtpe-derivation-form';
        formDiv.innerHTML = `
            <h4><i class="fas fa-paper-plane"></i> Déjanos tus datos</h4>
            <input type="text" id="drtpe-df-name" placeholder="Nombre completo" required>
            <input type="email" id="drtpe-df-email" placeholder="Correo electrónico" required>
            <input type="tel" id="drtpe-df-phone" placeholder="Teléfono">
            <textarea id="drtpe-df-message" placeholder="Cuéntanos tu consulta..."></textarea>
            <button class="btn-submit" id="drtpe-df-submit">Enviar solicitud</button>
        `;
        body.appendChild(formDiv);
        body.scrollTop = body.scrollHeight;

        document.getElementById('drtpe-df-submit').addEventListener('click', async function() {
            const name = document.getElementById('drtpe-df-name').value.trim();
            const email = document.getElementById('drtpe-df-email').value.trim();
            const phone = document.getElementById('drtpe-df-phone').value.trim();
            const message = document.getElementById('drtpe-df-message').value.trim();

            if (!name || !email) {
                alert('Por favor, completa al menos nombre y correo.');
                return;
            }

            try {
                const resp = await fetch(`${API_BASE}/contact`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, phone, message })
                });
                if (resp.ok) {
                    addMessage('✅ Datos enviados correctamente. Un asesor te contactará pronto.', 'bot');
                    formDiv.remove();
                } else {
                    alert('Error al enviar. Intenta más tarde.');
                }
            } catch (e) {
                alert('Error de conexión. Verifica tu red.');
            }
        });
    }

    async function sendMessage(text) {
        const userText = text.trim();
        if (!userText || isWaitingResponse) return;

        addMessage(userText, 'user');
        input.value = '';
        isWaitingResponse = true;
        showTyping();

        try {
            const response = await fetch(`${API_BASE}/chat`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: userText, session_id: sessionId })
            });

            if (!response.ok) throw new Error('Error en el servidor');

            const data = await response.json();
            hideTyping();
            setTimeout(() => {
                addMessage(data.answer, 'bot', data.sources, data.needs_derivation);
            }, 400);
        } catch (error) {
            hideTyping();
            addMessage('⚠️ Lo siento, tengo problemas de conexión. Por favor, intenta más tarde.', 'bot', null, true);
            console.error('Chat error:', error);
        }

        isWaitingResponse = false;
    }

    // ---- EVENTOS DEL CHAT ----
    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;
        panel.classList.toggle('open', isOpen);
        toggleBtn.classList.toggle('open', isOpen);
        if (isOpen) {
            input.focus();
            if (body.children.length === 0) {
                addMessage(
                    '¡Hola! Soy **EmpleaBot DRTPE**, tu asistente virtual de la Dirección Regional de Trabajo y Promoción del Empleo.\n\n' +
                    'Puedo ayudarte con información sobre:\n' +
                    '• Bolsa de trabajo y empleabilidad\n' +
                    '• Programas de orientación vocacional (SOVIO)\n' +
                    '• Trámites y servicios (RETCC, REMYPE, CUL)\n' +
                    '• Consultas laborales y derechos del trabajador\n' +
                    '• Otras consultas relacionadas a los servicios de la DRTPE \n\n' +
                    'Escribe tu pregunta o selecciona una opción rápida.',
                    'bot'
                );
            }
        }
    });

    closeBtn.addEventListener('click', () => {
        isOpen = false;
        panel.classList.remove('open');
        toggleBtn.classList.remove('open');
        dropdownOpen = false;
        dropdownMenu.style.display = 'none';
    });

    sendBtn.addEventListener('click', () => sendMessage(input.value));
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage(input.value);
        }
    });

    optionsContainer.addEventListener('click', function(e) {
        const chip = e.target.closest('.chip');
        if (chip && chip.dataset.msg) {
            sendMessage(chip.dataset.msg);
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            isOpen = false;
            panel.classList.remove('open');
            toggleBtn.classList.remove('open');
            dropdownOpen = false;
            dropdownMenu.style.display = 'none';
        }
    });

    loadMarked().then(() => {
        console.log('✅ Chatbot DRTPE Puno – Dropdown corregido (hacia abajo)');
    });

})();