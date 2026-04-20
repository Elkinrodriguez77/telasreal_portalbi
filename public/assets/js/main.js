(function() {
	const navToggle = document.querySelector('.nav-toggle');
	const nav = document.querySelector('.site-nav ul');
	if (navToggle && nav) {
		navToggle.addEventListener('click', () => {
			const expanded = navToggle.getAttribute('aria-expanded') === 'true';
			navToggle.setAttribute('aria-expanded', (!expanded).toString());
			nav.style.display = expanded ? 'none' : 'flex';
			nav.style.flexDirection = 'column';
			nav.style.gap = '6px';
		});
	}
	const yearSpan = document.getElementById('year');
	if (yearSpan) yearSpan.textContent = new Date().getFullYear().toString();

	// Ajuste de iframes: centrados y responsivos respetando el ancho base
	function adjustIframes() {
		const frames = document.querySelectorAll('.dashboard-full iframe');
		frames.forEach((frame) => {
			const attrWidth = frame.getAttribute('width');
			const baseWidth = attrWidth ? parseInt(attrWidth, 10) : null;
			frame.style.width = '100%';
			if (baseWidth && !Number.isNaN(baseWidth)) {
				frame.style.maxWidth = baseWidth + 'px';
			} else {
				frame.style.maxWidth = '100%';
			}
		});
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', adjustIframes);
	} else {
		adjustIframes();
	}
	window.addEventListener('resize', adjustIframes);

	// Estado de sesión para alternar navegación
	async function syncAuthLinks() {
		try {
			const res = await fetch('./api/session.php', { credentials: 'include' });
			const data = await res.json();
			const list = document.querySelector('.site-nav ul');
			if (!list) return;
			const loginItem = list.querySelector('a[href$="login.php"]')?.parentElement;
			const registerItem = list.querySelector('a[href$="register.php"]')?.parentElement;
			const logoutLink = list.querySelector('a[href$="logout.php"]');
			if (data && data.authenticated) {
				if (loginItem) loginItem.style.display = 'none';
				if (registerItem) registerItem.style.display = 'none';
				if (!logoutLink) {
					const li = document.createElement('li');
					const a = document.createElement('a');
					a.href = './logout.php';
					a.textContent = 'Salir';
					li.appendChild(a);
					list.appendChild(li);
				}
			} else {
				if (loginItem) loginItem.style.display = '';
				if (registerItem) registerItem.style.display = '';
				if (logoutLink) logoutLink.parentElement.remove();
			}
		} catch (e) {
			// silencio
		}
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', syncAuthLinks);
	} else {
		syncAuthLinks();
	}
})();
