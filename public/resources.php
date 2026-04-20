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
  <link rel="icon" type="image/png" href="./assets/Imagenes/logo_tr.png">
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

  <main class="relative z-10 pt-32 pb-24 flex-grow">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        
        <div class="max-w-2xl mb-12">
            <h1 class="text-4xl font-heading font-bold text-white mb-4">Centro de Recursos</h1>
            <p class="text-lg text-slate-400">Últimos lanzamientos, noticias y tutoriales para maximizar el valor de tus datos.</p>
        </div>

        <!-- Noticias Section -->
        <section class="mb-20">
            <div class="flex items-center gap-4 mb-8">
                <span class="w-1 h-8 bg-data-cyan rounded-full"></span>
                <h2 class="text-2xl font-bold text-white">Noticias y Lanzamientos</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Card 1: Lanzamiento Dashboard -->
                <article class="glass-card p-8 rounded-2xl relative overflow-hidden group hover:-translate-y-1 transition-transform cursor-pointer w-full md:col-span-2 lg:col-span-1" onclick="openModal('lanzamiento-dashboard')">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg class="w-24 h-24 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                    </div>
                    <span class="text-xs font-bold text-data-cyan bg-data-cyan/10 px-2 py-1 rounded mb-4 inline-block">NUEVO</span>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-core-blue transition-colors">Lanzamiento Dashboard de Gestión Comercial</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-4">Descubre el nuevo tablero para el análisis del comportamiento y desempeño del equipo comercial de Telas Real.</p>
                    <span class="text-core-blue text-sm font-semibold flex items-center gap-2 mt-4 group-hover:gap-3 transition-all">
                        Leer más <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </span>
                </article>
            </div>
        </section>

        <!-- Tutoriales Section -->
        <section>
            <div class="flex items-center gap-4 mb-8">
                <span class="w-1 h-8 bg-core-blue rounded-full"></span>
                <h2 class="text-2xl font-bold text-white">Tutoriales & Guías</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tutorial 1 -->
                <article class="bg-navy-surface border border-white/5 p-6 rounded-xl hover:border-core-blue/50 transition-colors group cursor-pointer" onclick="openModal('tutorial-navegacion')">
                    <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center mb-4 group-hover:bg-core-blue group-hover:text-white transition-colors">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Cómo navegar los dashboards</h3>
                    <p class="text-slate-400 text-sm">Aprende los conceptos básicos: uso de filtros, pantalla completa y más.</p>
                </article>
            </div>
        </section>
        
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
        'lanzamiento-dashboard': {
            title: 'Lanzamiento Dashboard de Gestión Comercial',
            content: `
                <div class="space-y-8 text-slate-300">
                    <p class="text-lg leading-relaxed">
                        Presentamos el nuevo dashboard diseñado para visualizar el comportamiento y desempeño del equipo comercial de Telas Real. Este reporte integral ofrece dos vistas principales para un análisis profundo del funnel de ventas.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-xl font-bold text-white mb-4">1. Vista Funnel Mercately</h4>
                            <img src="./assets/Imagenes/1_vista_funnel_mercateli.png" alt="Vista Funnel Mercately" class="w-full rounded-lg shadow-lg mb-4 border border-white/10">
                            <p class="mb-2">Esta vista consolida todos los leads potenciales que llegan a Mercately, permitiendo visualizar su gestión en cada etapa del funnel de conversión. Ofrece tanto una perspectiva general como detallada por asesor, analizando tasas de conversión efectivas y no efectivas.</p>
                            <p class="text-sm text-gray-500 italic">Fuente de datos: API Mercately + Archivo Excel "RADICACIÓN".</p>
                        </div>

                        <div class="bg-deep-bg/50 p-6 rounded-xl border border-white/5">
                            <h4 class="text-xl font-bold text-white mb-4">2. Vista Gestión Comercial</h4>
                            <img src="./assets/Imagenes/2_vista_gestion_comercial.png" alt="Vista Gestión Comercial" class="w-full rounded-lg shadow-lg mb-4 border border-white/10">
                            <p>Enfocada en el seguimiento una vez los registros ingresan al proceso de gestión interno de Telas Real, permitiendo monitorear la evolución y cierre de cada oportunidad.</p>
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
