<?php
declare(strict_types=1);
$cfg = require dirname(__DIR__) . '/backend/config.php';
$recaptchaSiteKey = (string)($cfg['recaptcha_site_key'] ?? '');
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro | Telas Real</title>
  <link rel="icon" type="image/png" href="./assets/Imagenes/logo_tr.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  
  <script src="https://www.google.com/recaptcha/api.js?render=<?= htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8') ?>"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            heading: ['Montserrat', 'sans-serif'],
          },
          colors: {
            'core-blue': '#7c3aed',
            'deep-bg': '#070510',
            'navy-surface': '#100818',
            'data-cyan': '#2dd4bf',
            'data-amber': '#fbbf24',
            'telas-rose': '#f43f5e',
            'telas-fuchsia': '#e879f9',
            'telas-gold': '#facc15',
            'glass': 'rgba(16, 8, 28, 0.72)',
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            'hero-glow': 'conic-gradient(from 145deg at 50% 45%, #4c0519 0%, #701a75 28%, #0f766e 58%, #a16207 88%, #3b0764 100%)',
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="./assets/css/telas-brand.css">
</head>
<body class="bg-deep-bg text-slate-300 font-sans antialiased overflow-x-hidden selection:bg-core-blue selection:text-white" data-recaptcha-site-key="<?= htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8') ?>">

  <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
    <div class="absolute inset-0 bg-gradient-to-br from-[#06030a] via-[#14081c] to-[#061018]"></div>
    <div class="absolute top-[-15%] left-[-15%] w-[720px] h-[720px] max-w-[90vw] rounded-full bg-gradient-to-br from-rose-600/35 via-fuchsia-600/25 to-transparent blur-[100px] mix-blend-screen animate-pulse"></div>
    <div class="absolute bottom-[-12%] right-[-12%] w-[640px] h-[640px] max-w-[88vw] rounded-full bg-gradient-to-tl from-amber-400/30 via-teal-500/25 to-violet-600/20 blur-[110px] mix-blend-screen"></div>
    <div class="absolute top-[30%] right-[5%] w-[380px] h-[380px] rounded-full bg-gradient-to-br from-purple-600/25 to-cyan-400/15 blur-[90px]"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.035]"></div>
  </div>

  <!-- Header -->
  <header class="fixed inset-x-0 top-0 z-50 bg-deep-bg/80 backdrop-blur-md border-b border-white/5 transition-all duration-300">
    <nav class="flex items-center justify-between p-6 lg:px-8 max-w-7xl mx-auto" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="./index.php" class="-m-1.5 p-1.5 flex items-center gap-3 group">
          <img src="./assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-10 w-auto max-h-11 object-contain object-left logo-tr-white opacity-95 group-hover:opacity-100 transition-opacity">
        </a>
      </div>
      
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
          <span class="sr-only">Menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        </button>
      </div>
      
      <div class="hidden lg:flex lg:gap-x-10 items-center">
        <a href="./index.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Home</a>
        <a href="./resources.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Recursos</a>
        <a href="./dashboards.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Dashboards</a>
        
        <div class="flex items-center gap-4 ml-4 pl-4 border-l border-white/10">
            <a href="./register.php" class="text-sm font-medium leading-6 text-core-blue border-b-2 border-core-blue pb-1">Registro</a>
            <a href="./login.php" class="rounded-full bg-core-blue/10 px-4 py-2 text-sm font-bold text-core-blue hover:bg-core-blue hover:text-white transition-all border border-core-blue/30">Acceso</a>
        </div>
      </div>
    </nav>
    
  </header>

  <!-- Mobile menu -->
  <div class="hidden lg:hidden relative z-[100]" id="mobile-menu">
    <div class="fixed inset-0 bg-deep-bg/95 backdrop-blur-xl"></div>
    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto px-6 py-6">
      <div class="flex items-center justify-between mb-8">
        <a href="#" class="-m-1.5 p-1.5">
          <img src="./assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-8 w-auto object-contain logo-tr-white">
        </a>
        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-200" onclick="document.getElementById('mobile-menu').classList.add('hidden')">
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <div class="space-y-4">
          <a href="./index.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Home</a>
          <a href="./resources.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Recursos</a>
          <a href="./dashboards.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Dashboards</a>
          <div class="border-t border-white/10 pt-4 mt-4">
              <a href="./register.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-core-blue">Registro</a>
              <a href="./login.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-white">Iniciar Sesión</a>
          </div>
      </div>
    </div>
  </div>

  <main class="relative z-10 pt-32 pb-24">
    <div class="mx-auto max-w-2xl px-6 lg:px-8">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-heading font-bold text-white">Solicitud de Acceso</h1>
            <p class="mt-2 text-slate-400">Completa tus datos. Validaremos tu información y te daremos acceso según políticas de Telas Real.</p>
        </div>

        <div id="formAlert" class="hidden mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm"></div>

        <div class="glass-card p-8 rounded-2xl border-t border-white/10">
            <form id="registerForm" class="space-y-6" novalidate>
                
                <div>
                    <label for="full_name" class="block text-sm font-medium text-slate-300 mb-2">Nombre completo</label>
                    <input id="full_name" name="full_name" type="text" autocomplete="name" required 
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Correo corporativo</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                    <p class="mt-1 text-xs text-slate-500">Usa tu correo de empresa para validación automática.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Contraseña</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                            class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                        <p class="mt-1 text-xs text-slate-500">Mínimo 8 caracteres.</p>
                    </div>
                    <div>
                        <label for="password_confirm" class="block text-sm font-medium text-slate-300 mb-2">Confirmar contraseña</label>
                        <input id="password_confirm" name="password_confirm" type="password" autocomplete="new-password" required 
                            class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                    </div>
                </div>

                <!-- Preguntas de Seguridad -->
                <div class="border-t border-white/10 pt-6 mt-6">
                    <h3 class="text-sm font-bold text-white mb-4">Seguridad Adicional</h3>
                    
                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <div>
                            <label for="sq1" class="block text-sm font-medium text-slate-300 mb-2">Pregunta 1</label>
                            <select id="sq1" name="sq1" class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-core-blue">
                                <option value="">Selecciona una pregunta...</option>
                                <option value="mascota">¿Cuál es el nombre de tu primera mascota?</option>
                                <option value="ciudad">¿En qué ciudad nacieron tus padres?</option>
                                <option value="comida">¿Cuál es tu comida favorita?</option>
                            </select>
                            <input id="sa1" name="sa1" type="text" placeholder="Respuesta" class="mt-2 w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue">
                        </div>

                        <div>
                            <label for="sq2" class="block text-sm font-medium text-slate-300 mb-2">Pregunta 2</label>
                            <select id="sq2" name="sq2" class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-core-blue">
                                <option value="">Selecciona una pregunta...</option>
                                <option value="padre">¿Cuál es el segundo nombre de tu padre?</option>
                                <option value="trabajo">¿Cuál fue tu primer trabajo?</option>
                                <option value="colegio">¿Cómo se llamaba tu colegio de primaria?</option>
                            </select>
                            <input id="sa2" name="sa2" type="text" placeholder="Respuesta" class="mt-2 w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-slate-300 mb-2">Área / Departamento (opcional)</label>
                    <input id="department" name="department" type="text" 
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-slate-300 mb-2">Motivo de acceso (opcional)</label>
                    <textarea id="reason" name="reason" rows="3" 
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all"></textarea>
                </div>

                <!-- Honeypot hidden field -->
                <div class="hidden">
                    <label for="hp_website">No llenar</label>
                    <input id="hp_website" name="hp_website" type="text" autocomplete="off">
                </div>

                <!-- Botón de envío -->
                <div class="pt-2">
                    <button id="submitBtn" type="submit" 
                        class="w-full rounded-full bg-core-blue px-4 py-3 text-sm font-bold text-white shadow-lg shadow-core-blue/20 hover:bg-blue-600 hover:shadow-core-blue/40 transition-all duration-300 transform hover:-translate-y-0.5">
                        Enviar Solicitud
                    </button>
                    <p class="mt-3 text-center text-xs text-gray-500">
                      Protegido por reCAPTCHA Enterprise.
                      <a href="https://policies.google.com/privacy" target="_blank" class="text-gray-400 hover:text-white">Privacidad</a> y 
                      <a href="https://policies.google.com/terms" target="_blank" class="text-gray-400 hover:text-white">Términos</a>.
                    </p>
                </div>
            </form>
        </div>
        
    </div>
  </main>

  <footer class="bg-black py-12 border-t border-white/10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-3">
             <img src="./assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-8 w-auto object-contain logo-tr-white opacity-55 hover:opacity-100 transition-opacity">
             <span class="text-xs text-gray-500">| Portal Centralizado</span>
        </div>
        <p class="text-xs text-gray-600">
            &copy; 2026 diseñado con 💗 por <a href="https://www.dataworld.com.co/" target="_blank" class="text-core-blue hover:text-white transition-colors">Data World</a>. Todos los derechos reservados.
        </p>
    </div>
  </footer>

  <script src="./assets/js/register.js?v=2.4"></script>
</body>
</html>
