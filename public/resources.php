<?php
require_once __DIR__ . '/auth.php';
$isLoggedIn = true;
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recursos | Telas Real</title>
  <link rel="icon" type="image/png" href="./assets/Imagenes/Isologo_dw.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
  <style>
    /* Modal transitions */
    .modal-enter {
        opacity: 0;
        transform: scale(0.95) translateY(10px);
    }
    .modal-enter-active {
        opacity: 1;
        transform: scale(1) translateY(0);
        transition: all 0.3s ease-out;
    }
    .modal-exit {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
    .modal-exit-active {
        opacity: 0;
        transform: scale(0.95) translateY(10px);
        transition: all 0.2s ease-in;
    }
    @keyframes resources-shimmer {
      0% { background-position: 0% 50%; }
      100% { background-position: 200% 50%; }
    }
    .resources-hero-border {
      background: linear-gradient(90deg, rgba(244,63,94,0.5), rgba(192,38,211,0.5), rgba(20,184,166,0.5), rgba(244,63,94,0.5));
      background-size: 200% auto;
      animation: resources-shimmer 8s linear infinite;
    }
  </style>
</head>
<body class="bg-deep-bg text-slate-300 font-sans antialiased overflow-x-hidden selection:bg-core-blue selection:text-white flex flex-col min-h-screen">

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
        <a href="./resources.php" class="text-sm font-medium leading-6 text-white border-b-2 border-core-blue">Recursos</a>
        <a href="./dashboards.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Dashboards</a>
        
        <!-- Action Buttons (Dinámicos) -->
        <div class="flex items-center gap-4 ml-4 pl-4 border-l border-white/10">
            <?php if ($isLoggedIn): ?>
                <div class="flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-full">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-xs font-medium text-green-400">Sesión Activa</span>
            </div>
                <a href="./logout.php" class="text-sm font-medium leading-6 text-red-400 hover:text-red-300 transition-colors">Salir</a>
            <?php else: ?>
                <a href="./register.php" class="text-sm font-medium leading-6 text-core-blue hover:text-data-cyan transition-colors">Registro</a>
                <a href="./login.php" class="rounded-full bg-core-blue/10 px-4 py-2 text-sm font-bold text-core-blue hover:bg-core-blue hover:text-white transition-all border border-core-blue/30">Acceso</a>
            <?php endif; ?>
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
          <a href="./resources.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-white bg-white/5">Recursos</a>
          <a href="./dashboards.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Dashboards</a>
          <div class="border-t border-white/10 pt-4 mt-4">
              <?php if ($isLoggedIn): ?>
                  <span class="block px-3 py-2 text-sm text-green-400">Hola, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></span>
                  <a href="./logout.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-red-400">Cerrar Sesión</a>
              <?php else: ?>
                  <a href="./register.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-core-blue">Registro</a>
                  <a href="./login.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-white">Iniciar Sesión</a>
              <?php endif; ?>
          </div>
      </div>
    </div>
  </div>

  <main class="relative z-10 pt-28 pb-28 flex-grow">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <!-- Hero lanzamiento -->
        <div class="relative rounded-3xl p-[1px] resources-hero-border mb-14 shadow-[0_0_60px_rgba(124,58,237,0.12)]">
          <div class="rounded-3xl bg-deep-bg/95 backdrop-blur-xl px-8 py-12 sm:px-12 sm:py-16 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-fuchsia-600/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 bottom-0 w-72 h-72 rounded-full bg-teal-500/15 blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-4xl">
              <div class="flex flex-wrap items-center gap-3 mb-6">
                <span class="inline-flex items-center rounded-full bg-rose-500/15 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-rose-300 ring-1 ring-rose-400/30">Lanzamiento</span>
                <span class="inline-flex items-center rounded-full bg-white/5 px-4 py-1.5 text-xs font-mono text-slate-300 ring-1 ring-white/10">Portal BI v1.0</span>
                <span class="text-xs text-slate-500">Documentación · Abril 2026</span>
              </div>
              <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-bold text-white leading-tight mb-6">
                Nuevo <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-300 via-fuchsia-300 to-teal-300">portal de inteligencia de negocio</span> para Telas Real
              </h1>
              <p class="text-lg sm:text-xl text-slate-400 leading-relaxed mb-8 max-w-2xl">
                Un solo lugar para acceder a tus tableros Power BI, con identidad de marca, acceso seguro y flujo de registro pensado para el equipo. Esta página resume qué trae la versión actual y cómo sacarle provecho.
              </p>
              <div class="flex flex-wrap gap-4">
                <a href="./dashboards.php" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-violet-600 to-fuchsia-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-fuchsia-500/25 hover:opacity-95 transition-opacity">
                  Ir a dashboards
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
                <button type="button" onclick="openModal('lanzamiento-portal')" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/10 transition-colors">
                  Detalle del lanzamiento
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Métricas / pilares -->
        <section class="mb-20">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-violet-900/30 to-transparent p-8 text-center sm:text-left">
              <p class="text-3xl font-heading font-bold text-white mb-1">v1.0</p>
              <p class="text-xs uppercase tracking-widest text-fuchsia-300/90 mb-2">Versión estable</p>
              <p class="text-sm text-slate-400">Primera entrega pública del portal: acceso, recursos y <strong class="text-slate-300">Gestión B2B</strong> en Power BI.</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-teal-900/25 to-transparent p-8 text-center sm:text-left">
              <p class="text-3xl font-heading font-bold text-white mb-1">100%</p>
              <p class="text-xs uppercase tracking-widest text-teal-300/90 mb-2">En la nube</p>
              <p class="text-sm text-slate-400">Reportes hospedados en Power BI con experiencia embebida y opción de pantalla completa.</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-rose-900/25 to-transparent p-8 text-center sm:text-left">
              <p class="text-3xl font-heading font-bold text-white mb-1">Seguro</p>
              <p class="text-xs uppercase tracking-widest text-rose-300/90 mb-2">Acceso controlado</p>
              <p class="text-sm text-slate-400">Registro con validación, reCAPTCHA y aprobación de usuarios antes de entrar al portal.</p>
            </div>
          </div>
        </section>

        <!-- Qué hay en esta versión -->
        <section class="mb-20">
          <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-10">
            <div>
              <span class="text-xs font-bold uppercase tracking-[0.2em] text-data-cyan">Incluido hoy</span>
              <h2 class="text-3xl sm:text-4xl font-heading font-bold text-white mt-2">Qué incluye el portal ahora</h2>
            </div>
            <p class="text-slate-400 max-w-md text-sm leading-relaxed">Roadmap vivo: iremos sumando tableros y mejoras. Lo que ves abajo es el núcleo de la <strong class="text-slate-200">v1.0</strong>.</p>
          </div>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <article class="lg:col-span-7 glass-card rounded-2xl p-8 lg:p-10 relative overflow-hidden group cursor-pointer min-h-[280px] flex flex-col justify-end" onclick="openModal('lanzamiento-portal')">
              <div class="absolute inset-0 bg-gradient-to-t from-deep-bg via-deep-bg/40 to-transparent z-[1]"></div>
              <div class="absolute top-6 right-6 w-32 h-32 rounded-full bg-fuchsia-500/30 blur-2xl group-hover:bg-fuchsia-400/40 transition-all"></div>
              <div class="relative z-10">
                <span class="text-xs font-bold text-amber-300 bg-amber-400/10 px-2 py-1 rounded">Portal</span>
                <h3 class="text-2xl font-bold text-white mt-4 mb-2 group-hover:text-fuchsia-200 transition-colors">Experiencia unificada</h3>
                <p class="text-slate-400 text-sm leading-relaxed max-w-lg">Home, recursos, dashboards y cierre de sesión con la misma línea visual Telas Real — pensada para uso diario del equipo comercial y dirección.</p>
              </div>
            </article>
            <div class="lg:col-span-5 flex flex-col gap-6">
              <article class="glass-card rounded-2xl p-8 flex-1 border-l-4 border-l-teal-400/60 hover:border-l-teal-300 transition-colors cursor-pointer" onclick="openModal('lanzamiento-dashboard')">
                <h3 class="text-lg font-bold text-white mb-2">Gestión B2B · Power BI</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">Tablero comercial integrado: métricas clave y vistas listas para presentar o profundizar.</p>
                <span class="text-teal-400 text-sm font-semibold">Ver ficha técnica →</span>
              </article>
              <article class="rounded-2xl border border-dashed border-white/15 bg-white/[0.03] p-8 flex-1 flex flex-col justify-center">
                <p class="text-xs uppercase tracking-widest text-slate-500 mb-2">Próximamente</p>
                <p class="text-white font-semibold">Más reportes y notificaciones</p>
                <p class="text-slate-500 text-sm mt-1">Las nuevas versiones se anunciarán aquí y en tu correo interno.</p>
              </article>
            </div>
          </div>
        </section>

        <!-- Tutoriales -->
        <section class="mb-8">
            <div class="flex items-center gap-4 mb-10">
                <span class="h-10 w-1.5 rounded-full bg-gradient-to-b from-core-blue to-data-cyan"></span>
                <div>
                  <h2 class="text-3xl font-heading font-bold text-white">Tutoriales y buenas prácticas</h2>
                  <p class="text-slate-500 text-sm mt-1">Saca más jugo a los informes en pocos minutos.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="group relative rounded-2xl border border-white/10 bg-navy-surface/80 p-8 overflow-hidden cursor-pointer hover:border-fuchsia-400/40 transition-all duration-300 hover:shadow-[0_0_40px_rgba(192,38,211,0.12)]" onclick="openModal('tutorial-navegacion')">
                    <div class="absolute -right-8 -top-8 w-28 h-28 rounded-full bg-core-blue/20 blur-2xl group-hover:bg-core-blue/30 transition-all"></div>
                    <div class="relative z-10">
                      <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-core-blue/30 to-fuchsia-600/20 flex items-center justify-center mb-6 text-fuchsia-200 ring-1 ring-white/10">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                      </div>
                      <h3 class="text-xl font-bold text-white mb-3 group-hover:text-fuchsia-200 transition-colors">Navegar los dashboards</h3>
                      <p class="text-slate-400 text-sm leading-relaxed">Pantalla completa, filtros y cómo restablecer la vista sin perder el hilo del análisis.</p>
                    </div>
                </article>
            </div>
        </section>

    </div>
  </main>

  <footer class="site-footer-legal relative z-20 w-full border-t border-white/10 bg-black/95">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-3 sm:py-3.5">
      <div class="flex flex-col gap-2.5 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-x-4 sm:gap-y-1 text-[11px] leading-snug sm:text-xs text-slate-400">
        <div class="flex flex-wrap items-center gap-x-2 gap-y-1 min-w-0">
          <img src="./assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-5 w-auto shrink-0 object-contain logo-tr-white opacity-90">
          <span class="text-slate-500 uppercase tracking-wider">Portal BI · Telas Real</span>
        </div>
        <div class="flex flex-wrap items-center gap-x-1.5 gap-y-0.5 sm:justify-center">
          <span class="text-slate-500">Diseñado con amor</span>
          <span class="footer-heart footer-heart--sm text-rose-400" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17l-.022.012-.007.004-.003.001a.752.752 0 01-.544 0z"/></svg></span>
          <span class="text-slate-500">por</span>
          <a href="https://www.dataworld.com.co/" target="_blank" rel="noopener noreferrer" class="font-medium text-fuchsia-400/95 hover:text-fuchsia-300">Data World</a>
        </div>
        <p class="text-slate-500 sm:text-right tabular-nums">&copy; <?php echo date('Y'); ?> Telas Real</p>
      </div>
    </div>
  </footer>

  <!-- Modal Overlay -->
  <div id="resource-modal" class="fixed inset-0 z-[200] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-deep-bg/95 backdrop-blur-xl transition-opacity opacity-0" id="modal-backdrop"></div>
    
    <!-- Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-navy-surface border border-white/10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="modal-panel">
                
                <!-- Close Button -->
                <div class="absolute right-0 top-0 pr-4 pt-4 z-10">
                    <button type="button" class="rounded-md bg-navy-surface text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-core-blue focus:ring-offset-2" onclick="closeModal()">
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Content Container -->
                <div class="px-6 py-8 sm:p-10">
                    <h3 class="text-2xl font-bold leading-6 text-white mb-6" id="modal-title">Titulo</h3>
                    <div class="mt-2" id="modal-content">
                        <!-- Dynamic Content -->
                    </div>
                </div>
                
                <!-- Footer actions -->
                <div class="bg-deep-bg/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-white/20 sm:mt-0 sm:w-auto" onclick="closeModal()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script>
    const resourcesData = {
        'lanzamiento-portal': {
            title: 'Lanzamiento del portal BI (v1.0)',
            content: `
                <div class="space-y-8 text-slate-300">
                    <p class="text-lg leading-relaxed">
                        Damos la bienvenida al <strong class="text-white">portal de inteligencia de negocio de Telas Real</strong>, desarrollado con Data World. La versión <strong class="text-fuchsia-300">1.0</strong> (documentación abril 2026) concentra acceso autenticado, materiales de ayuda y los tableros Power BI autorizados para la organización.
                    </p>
                    <ul class="grid sm:grid-cols-2 gap-4">
                        <li class="bg-deep-bg/50 p-4 rounded-xl border border-white/5"><span class="text-teal-400 font-bold">·</span> Identidad visual Telas Real y experiencia responsive.</li>
                        <li class="bg-deep-bg/50 p-4 rounded-xl border border-white/5"><span class="text-teal-400 font-bold">·</span> Registro con validación de dominio y reCAPTCHA.</li>
                        <li class="bg-deep-bg/50 p-4 rounded-xl border border-white/5"><span class="text-teal-400 font-bold">·</span> Recuperación de contraseña con preguntas de seguridad.</li>
                        <li class="bg-deep-bg/50 p-4 rounded-xl border border-white/5"><span class="text-teal-400 font-bold">·</span> Dashboard <strong class="text-white">Gestión B2B</strong> embebido y vista ampliada.</li>
                    </ul>
                    <p class="text-sm text-slate-500">Las próximas versiones ampliarán catálogo de reportes y novedades; esta página se actualizará con cada despliegue.</p>
                </div>
            `
        },
        'lanzamiento-dashboard': {
            title: 'Gestión B2B · Informe Power BI',
            content: `
                <div class="space-y-8 text-slate-300">
                    <p class="text-lg leading-relaxed">
                        El tablero <strong class="text-white">Gestión B2B</strong> concentra el análisis comercial para Telas Real: evolución de oportunidades, lectura rápida de KPIs y vistas pensadas tanto para operación diaria como para presentaciones.
                    </p>
                    <div class="space-y-6">
                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-xl font-bold text-white mb-4">1. Vista Funnel Mercately</h4>
                            <img src="./assets/Imagenes/1_vista_funnel_mercateli.png" alt="Vista Funnel Mercately" class="w-full rounded-lg shadow-lg mb-4 border border-white/10">
                            <p class="mb-2">Leads y etapas del embudo con foco en conversión y seguimiento por asesor.</p>
                            <p class="text-sm text-gray-500 italic">Fuente de datos: API Mercately + archivo Excel "RADICACIÓN".</p>
                        </div>
                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-xl font-bold text-white mb-4">2. Vista gestión comercial</h4>
                            <img src="./assets/Imagenes/2_vista_gestion_comercial.png" alt="Vista Gestión Comercial" class="w-full rounded-lg shadow-lg mb-4 border border-white/10">
                            <p>Seguimiento interno de registros hasta cierre, alineado al proceso de Telas Real.</p>
                        </div>
                    </div>
                </div>
            `
        },
        'tutorial-navegacion': {
            title: 'Cómo navegar los dashboards',
            content: `
                <div class="space-y-8 text-slate-300">
                    <p class="text-lg">Domina la navegación en nuestros reportes para sacar el máximo provecho a la información.</p>
                    
                    <div class="space-y-6">
                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-core-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                                Pantalla Completa
                            </h4>
                            <img src="./assets/Imagenes/navegar_pantalla_completa_dash.png" alt="Pantalla Completa" class="w-full rounded-lg mb-4 border border-white/10">
                            <p class="text-sm">Utiliza el botón en la esquina superior derecha o inferior para expandir el reporte. Para salir, presiona la tecla <kbd class="px-2 py-0.5 bg-gray-700 rounded text-xs text-white">ESC</kbd> o el botón nuevamente.</p>
                        </div>

                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-data-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                Borrar Filtros
                            </h4>
                            <img src="./assets/Imagenes/navegar_borrar_filtros.png" alt="Borrar Filtros" class="w-full rounded-lg mb-4 border border-white/10">
                            <p class="text-sm">Para reiniciar la vista, busca el icono de "Goma de borrar" o "Restablecer filtros" en la barra de herramientas del reporte.</p>
                        </div>
                    </div>
                </div>
            `
        }
    };

    function openModal(id) {
        const data = resourcesData[id];
        if (!data) return;

        document.getElementById('modal-title').innerText = data.title;
        document.getElementById('modal-content').innerHTML = data.content;

        const modal = document.getElementById('resource-modal');
        const backdrop = document.getElementById('modal-backdrop');
        const panel = document.getElementById('modal-panel');

        modal.classList.remove('hidden');
        
        // Trigger animations
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            panel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('resource-modal');
        const backdrop = document.getElementById('modal-backdrop');
        const panel = document.getElementById('modal-panel');

        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Match transition duration
    }

    // Close on backdrop click
    document.getElementById('modal-backdrop').addEventListener('click', closeModal);
    
    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
  </script>
</body>
</html>
