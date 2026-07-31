// ============================================================
//  WIDGET CHATBOT DRTPE - VERSIÓN CON MARKDOWN
// ============================================================

(function() {
    const API_BASE = 'http://localhost:8001';
    const SESSION_KEY = 'drtpe_session_id';

    let sessionId = localStorage.getItem(SESSION_KEY);
    if (!sessionId) {
        sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem(SESSION_KEY, sessionId);
    }

    // Cargar marked.js
    function loadMarked() {
        return new Promise((resolve) => {
            if (typeof marked !== 'undefined') {
                resolve();
                return;
            }
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/marked/marked.min.js';
            script.onload = resolve;
            script.onerror = resolve; // Si falla, continuar sin Markdown
            document.head.appendChild(script);
        });
    }

    // Crear widget
    const container = document.createElement('div');
    container.id = 'drtpe-chatbot-widget';
    document.body.appendChild(container);

    if (!document.querySelector('link[href*="widget.css"]')) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'widget.css';
        document.head.appendChild(link);
    }

    container.innerHTML = `
        <button class="drtpe-chat-button" id="drtpe-chat-toggle" aria-label="Abrir chat">
            <span class="chat-icon">💬</span>
        </button>
        <div class="drtpe-chat-panel" id="drtpe-chat-panel">
            <div class="drtpe-chat-header">
                <span class="logo-icon">🏛️</span>
                <div class="title-group">
                    <h3>Asistente DRTPE</h3>
                    <p>Dirección Regional de Trabajo y Promoción del Empleo</p>
                </div>
                <button class="close-btn" id="drtpe-chat-close">✕</button>
            </div>
            <div class="drtpe-chat-body" id="drtpe-chat-body"></div>
            <div class="drtpe-quick-options" id="drtpe-quick-options">
                <button data-msg="¿Cuáles son los requisitos para tramitar la bolsa de trabajo?">
                    <span class="option-icon">📋</span> Requisitos
                </button>
                <button data-msg="¿Cómo puedo inscribirme en la bolsa de empleo?">
                    <span class="option-icon">💼</span> Bolsa de empleo
                </button>
                <button data-msg="¿Qué consultas laborales puedo realizar?">
                    <span class="option-icon">📚</span> Consultas laborales
                </button>
                <button data-msg="¿Qué es el SOVIO y a quién está dirigido?">
                    <span class="option-icon">🎓</span> Orientación vocacional
                </button>
            </div>
            <div class="drtpe-chat-footer">
                <input type="text" id="drtpe-chat-input" placeholder="Escribe tu consulta..." autocomplete="off">
                <button id="drtpe-chat-send">➤</button>
            </div>
        </div>
    `;

    const toggleBtn = document.getElementById('drtpe-chat-toggle');
    const panel = document.getElementById('drtpe-chat-panel');
    const closeBtn = document.getElementById('drtpe-chat-close');
    const body = document.getElementById('drtpe-chat-body');
    const input = document.getElementById('drtpe-chat-input');
    const sendBtn = document.getElementById('drtpe-chat-send');
    const optionsContainer = document.getElementById('drtpe-quick-options');

    let isOpen = false;
    let isWaitingResponse = false;

    // ---------- MARKDOWN RENDER ----------
    function renderMarkdown(text) {
        if (typeof marked !== 'undefined') {
            try {
                marked.setOptions({
                    breaks: true,
                    gfm: true,
                    sanitize: false,
                });
                return marked.parse(text);
            } catch (e) {
                return text;
            }
        }
        return text;
    }

    function renderInlineMarkdown(text) {
        if (typeof marked !== 'undefined') {
            try {
                return marked.parseInline(text);
            } catch (e) {
                return text;
            }
        }
        return text;
    }

    // ---------- FUNCIONES DEL CHAT ----------
    function addMessage(text, sender, sources = null, needsDerivation = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${sender}`;
        
        if (sender === 'bot' && typeof marked !== 'undefined') {
            msgDiv.innerHTML = renderMarkdown(text);
        } else {
            msgDiv.textContent = text;
        }
        body.appendChild(msgDiv);

        if (sender === 'bot' && sources && sources.length > 0 && !needsDerivation) {
            const sourcesDiv = document.createElement('div');
            sourcesDiv.className = 'drtpe-sources';
            const sourcesHtml = sources.map(s => {
                const shortSource = s.length > 120 ? s.substring(0, 120) + '...' : s;
                return `<li>${renderInlineMarkdown(shortSource)}</li>`;
            }).join('');
            sourcesDiv.innerHTML = `<strong>📄 Fuentes:</strong><ul>${sourcesHtml}</ul>`;
            body.appendChild(sourcesDiv);
        }

        if (sender === 'bot' && needsDerivation) {
            showDerivationForm();
        }

        body.scrollTop = body.scrollHeight;
    }

    function showTyping() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'drtpe-typing';
        typingDiv.innerHTML = '<span></span><span></span><span></span>';
        body.appendChild(typingDiv);
        body.scrollTop = body.scrollHeight;
    }

    function hideTyping() {
        const typing = document.getElementById('drtpe-typing');
        if (typing) typing.remove();
    }

    function showDerivationForm() {
        if (document.getElementById('drtpe-derivation-form')) return;
        const formDiv = document.createElement('div');
        formDiv.id = 'drtpe-derivation-form';
        formDiv.className = 'drtpe-derivation-form';
        formDiv.innerHTML = `
            <h4>📩 Déjanos tus datos y te contactaremos</h4>
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
            addMessage(data.answer, 'bot', data.sources, data.needs_derivation);

        } catch (error) {
            hideTyping();
            addMessage('⚠️ Lo siento, tengo problemas de conexión. Por favor, intenta más tarde.', 'bot', null, true);
            console.error('Chat error:', error);
        }

        isWaitingResponse = false;
    }

    // ---------- EVENTOS ----------
    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;
        panel.classList.toggle('open', isOpen);
        toggleBtn.classList.toggle('open', isOpen);
        if (isOpen) {
            input.focus();
            if (body.children.length === 0) {
                addMessage('¡Hola! Soy **BotDRTPE**, tu asistente virtual.\n\n¿En qué puedo ayudarte hoy?', 'bot');
            }
        }
    });

    closeBtn.addEventListener('click', () => {
        isOpen = false;
        panel.classList.remove('open');
        toggleBtn.classList.remove('open');
    });

    sendBtn.addEventListener('click', () => sendMessage(input.value));
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage(input.value);
        }
    });

    optionsContainer.addEventListener('click', (e) => {
        const btn = e.target.closest('button');
        if (btn && btn.dataset.msg) {
            sendMessage(btn.dataset.msg);
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            isOpen = false;
            panel.classList.remove('open');
            toggleBtn.classList.remove('open');
        }
    });

    // Cargar Markdown y luego inicializar
    loadMarked().then(() => {
        console.log('✅ Chatbot DRTPE inicializado con Markdown');
    });

})();