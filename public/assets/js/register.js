(function() {
	const form = document.getElementById('registerForm');
	const submitBtn = document.getElementById('submitBtn');
	const alertBox = document.getElementById('formAlert');
	const ALLOWED_DOMAIN = 'asesorgroup.com.co';
	const SITE_KEY = (document.body && document.body.dataset.recaptchaSiteKey) || '';

	function showAlert(message, ok) {
		alertBox.textContent = message;
		alertBox.classList.remove('hidden');
        alertBox.className = ok 
            ? 'mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 text-sm'
            : 'mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm';
	}

	function clearAlert() {
		alertBox.textContent = '';
		alertBox.classList.add('hidden');
	}

	function serialize(recaptchaToken) {
		return {
			full_name: (document.getElementById('full_name').value || '').trim(),
			email: (document.getElementById('email').value || '').trim(),
			password: (document.getElementById('password').value || ''),
			password_confirm: (document.getElementById('password_confirm').value || ''),
			department: (document.getElementById('department').value || '').trim(),
			reason: (document.getElementById('reason').value || '').trim(),
            // Nuevos campos
            sq1: (document.getElementById('sq1').value || ''),
            sa1: (document.getElementById('sa1').value || '').trim(),
            sq2: (document.getElementById('sq2').value || ''),
            sa2: (document.getElementById('sa2').value || '').trim(),
			hp_website: (document.getElementById('hp_website').value || '').trim(),
			recaptcha: recaptchaToken
		};
	}

	function validate(payload) {
		if (!payload.full_name || payload.full_name.length < 3) return 'Nombre inválido';
		if (!payload.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(payload.email)) return 'Correo inválido';
		const domain = (payload.email.split('@')[1] || '').toLowerCase();
		if (domain !== ALLOWED_DOMAIN) return 'Solo se permiten correos @' + ALLOWED_DOMAIN;
		if (!payload.password || payload.password.length < 8) return 'Contraseña muy corta (mínimo 8)';
		if (payload.password !== payload.password_confirm) return 'Las contraseñas no coinciden';
        
        // Validación de preguntas
        if (!payload.sq1 || !payload.sa1) return 'Debes responder la Pregunta de Seguridad 1';
        if (!payload.sq2 || !payload.sa2) return 'Debes responder la Pregunta de Seguridad 2';
        
		if (!SITE_KEY) return 'reCAPTCHA no está configurado en el servidor.';
		if (!payload.recaptcha) return 'Error interno: Token de seguridad vacío.';
		return '';
	}

	if (form) {
		form.addEventListener('submit', async (e) => {
			e.preventDefault();
			clearAlert();
            
            const prePayload = {
                full_name: document.getElementById('full_name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirm: document.getElementById('password_confirm').value
            };
            
            if (!prePayload.full_name || !prePayload.email || !prePayload.password) {
                showAlert('Por favor completa todos los campos obligatorios.', false);
                return;
            }

			try {
				submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                submitBtn.textContent = 'Procesando...';

				if (!SITE_KEY) {
					throw new Error('reCAPTCHA no está configurado. Contacta al administrador.');
				}
                const token = await new Promise((resolve, reject) => {
                    if (typeof grecaptcha === 'undefined') {
                        reject(new Error('Google reCAPTCHA no cargó. Revisa tu bloqueador de anuncios.'));
                        return;
                    }
                    grecaptcha.ready(async () => {
                        try {
                            const t = await grecaptcha.execute(SITE_KEY, {action: 'REGISTER'});
                            resolve(t);
                        } catch (err) {
                            reject(err);
                        }
                    });
                });

				const payload = serialize(token);
				const error = validate(payload);
				if (error) { throw new Error(error); }

				const res = await fetch('./api/register.php', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify(payload)
				});
				const data = await res.json();
                
				if (data && data.ok) {
					showAlert('¡Registro enviado con éxito! Espera tu aprobación.', true);
					form.reset();
				} else {
					throw new Error((data && data.message) || 'Error desconocido del servidor.');
				}
			} catch (err) {
                console.error('Error registro:', err);
				showAlert(err.message || 'Error de conexión. Intenta de nuevo.', false);
			} finally {
				submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                submitBtn.textContent = 'Enviar Solicitud';
			}
		});
	}
})();
