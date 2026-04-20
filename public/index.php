<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Centralizado | Telas Real</title>
  
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
</head>
<body class="bg-deep-bg text-slate-300 font-sans antialiased overflow-x-hidden selection:bg-core-blue selection:text-white flex flex-col min-h-screen">

  <!-- Fondo tipo textil: oscuro + degradados vivos -->
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
          <!-- Logo del Cliente -->
          <img src="./assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-10 w-auto max-h-11 object-contain object-left logo-tr-white opacity-95 group-hover:opacity-100 transition-opacity">
        </a>
      </div>
      
      <!-- Mobile menu button -->
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
          <span class="sr-only">Menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        </button>
      </div>
      
      <!-- Desktop Links -->
      <div class="hidden lg:flex lg:gap-x-10 items-center">
        <a href="./index.php" class="text-sm font-medium leading-6 text-white border-b-2 border-core-blue">Home</a>
        <a href="./resources.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Recursos</a>
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
          <a href="./index.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-white bg-white/5">Home</a>
          <a href="./resources.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Recursos</a>
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

  <main class="relative z-10 pt-20 flex-grow">

    <!-- Hero Section -->
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-4xl py-24 sm:py-32 lg:py-40 text-center">
        <!-- Badge -->
        <div class="hidden sm:mb-8 sm:flex sm:justify-center animate-drift">
          <div class="relative rounded-full px-4 py-1.5 text-sm leading-6 text-slate-400 ring-1 ring-white/10 hover:ring-core-blue/50 hover:bg-core-blue/10 transition-all cursor-default backdrop-blur-sm">
            Bienvenido a la Central de Datos <span class="font-semibold text-transparent bg-clip-text bg-gradient-to-r from-rose-300 via-fuchsia-300 to-teal-300">Telas Real</span>
          </div>
        </div>
        
        <!-- Main Title -->
        <h1 class="font-heading text-5xl font-extrabold tracking-tight text-white sm:text-7xl mb-6">
          Toda tu empresa <br/>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-fuchsia-400 to-teal-300 text-glow">Centralizada & Visible 24/7</span>
        </h1>
        
        <p class="mt-6 text-lg leading-8 text-slate-400 max-w-2xl mx-auto">
          Data World consolida la información crítica de tu negocio en un solo lugar. Visualizaciones de alto impacto para decisiones estratégicas inmediatas.
        </p>
        
        <div class="mt-10 flex items-center justify-center gap-x-6 flex-wrap gap-y-4">
          <a href="./dashboards.php" class="rounded-full bg-core-blue px-8 py-4 text-sm font-bold text-white shadow-[0_0_20px_rgba(57,91,181,0.4)] hover:bg-blue-600 hover:shadow-[0_0_30px_rgba(57,91,181,0.6)] hover:-translate-y-1 transition-all duration-300">
            Ir a Dashboards
          </a>
          <a href="#soluciones" class="group text-sm font-semibold leading-6 text-white hover:text-data-cyan transition-colors flex items-center gap-2">
            Explorar Soluciones <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform">→</span>
          </a>
        </div>
      </div>

      <!-- Post-hero: franja técnica a todo el ancho (sin tarjetas grandes) -->
      <div class="w-full border-y border-white/[0.07] bg-gradient-to-r from-transparent via-white/[0.04] to-transparent">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-center gap-x-5 gap-y-2 sm:gap-x-8 text-[10px] sm:text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-300/90 to-fuchsia-400/90">24/7</span>
          <span class="text-slate-600 hidden sm:inline" aria-hidden="true">|</span>
          <span>Power BI</span>
          <span class="text-slate-600 hidden sm:inline" aria-hidden="true">|</span>
          <span>Acceso gobernado</span>
          <span class="text-slate-600 hidden sm:inline" aria-hidden="true">|</span>
          <span class="text-data-cyan/80">Data World</span>
        </div>
      </div>

      <!-- Propuesta de valor: diseño editorial + lista compacta -->
      <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16 sm:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
          <div class="lg:col-span-5">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-fuchsia-400/90 mb-3">Por qué este portal</p>
            <h2 class="text-2xl sm:text-3xl font-heading font-bold text-white leading-tight mb-4">Menos fricción, más claridad para decidir</h2>
            <p class="text-sm sm:text-base text-slate-400 leading-relaxed">Un solo punto de entrada, sesión segura y tableros listos cuando los necesitas. Pensado para equipos B2B que viven del dato, no del archivo suelto.</p>
          </div>
          <ul class="lg:col-span-7 space-y-0 rounded-2xl border border-white/10 bg-white/[0.02] overflow-hidden divide-y divide-white/5">
            <li class="flex gap-4 px-5 py-4 sm:px-6 sm:py-5 items-start">
              <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-core-blue/15 text-core-blue text-xs font-bold">01</span>
              <div>
                <p class="text-sm font-semibold text-white">Identidad corporativa y control</p>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Registro con dominio Telas Real, aprobación y recuperación de acceso sin depender de terceros externos.</p>
              </div>
            </li>
            <li class="flex gap-4 px-5 py-4 sm:px-6 sm:py-5 items-start">
              <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-data-cyan/15 text-data-cyan text-xs font-bold">02</span>
              <div>
                <p class="text-sm font-semibold text-white">Informes vivos, no capturas estáticas</p>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Power BI integrado: filtros, drill-down y la misma experiencia que en el servicio, dentro del portal.</p>
              </div>
            </li>
            <li class="flex gap-4 px-5 py-4 sm:px-6 sm:py-5 items-start">
              <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-telas-rose/15 text-telas-rose text-xs font-bold">03</span>
              <div>
                <p class="text-sm font-semibold text-white">Recursos y acompañamiento</p>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">Materiales de ayuda y evolución del catálogo de dashboards con el respaldo de Data World.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Metrics / Value Grid -->
      <div id="soluciones" class="mx-auto max-w-7xl px-6 pb-24 lg:px-8">
        <div class="max-w-3xl mb-12 lg:mb-14">
          <p class="text-xs font-bold uppercase tracking-[0.2em] text-data-cyan mb-3">Capacidades</p>
          <h2 class="text-3xl sm:text-4xl font-heading font-bold text-white mb-4">Un portal con peso operativo</h2>
          <p class="text-lg text-slate-400 leading-relaxed">Acceso autenticado, tableros gobernados y recursos para que Telas Real tome decisiones con la misma verdad de datos en toda la organización.</p>
        </div>
        <dl class="grid grid-cols-1 gap-6 lg:grid-cols-3">
          
          <!-- Card 1 -->
          <div class="glass-card rounded-2xl p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <dt class="flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-core-blue mb-4">
               <span class="p-2 rounded-lg bg-core-blue/10"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg></span>
               Centralización
            </dt>
            <dd>
              <p class="text-2xl font-heading font-bold text-white mb-2">Todo en un lugar</p>
              <p class="text-sm text-slate-400 leading-relaxed">Olvídate de buscar en múltiples archivos. Tu información consolidada y lista para consultar.</p>
            </dd>
          </div>

          <!-- Card 2 -->
          <div class="glass-card rounded-2xl p-8 relative overflow-hidden group border-data-cyan/30 shadow-[0_0_30px_rgba(6,182,212,0.1)] hover:-translate-y-2 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-data-cyan/5 to-transparent opacity-50"></div>
            <dt class="flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-data-cyan mb-4 relative z-10">
               <span class="p-2 rounded-lg bg-data-cyan/10"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>
               Disponibilidad
            </dt>
            <dd class="relative z-10">
              <p class="text-2xl font-heading font-bold text-white mb-2">Acceso 24/7</p>
              <p class="text-sm text-slate-300 leading-relaxed">Tu empresa no duerme. Accede a tus métricas clave en cualquier momento y lugar.</p>
            </dd>
          </div>

          <!-- Card 3 -->
          <div class="glass-card rounded-2xl p-8 relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
            <dt class="flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-purple-400 mb-4">
               <span class="p-2 rounded-lg bg-purple-400/10"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg></span>
               Impacto
            </dt>
            <dd>
              <p class="text-2xl font-heading font-bold text-white mb-2">Decisiones Reales</p>
              <p class="text-sm text-slate-400 leading-relaxed">Visualizaciones diseñadas para entender el "por qué" de tus datos y actuar rápido.</p>
            </dd>
          </div>

        </dl>

        <!-- CTA dual: ancho completo, bajo perfil visual -->
        <div class="mt-16 sm:mt-20 flex flex-col sm:flex-row gap-4 sm:items-stretch max-w-5xl">
          <a href="./dashboards.php" class="flex-1 rounded-2xl border border-white/10 bg-gradient-to-br from-core-blue/20 to-transparent px-6 py-5 text-left hover:border-core-blue/40 transition-colors group">
            <span class="text-xs font-bold uppercase tracking-widest text-core-blue/90">Siguiente paso</span>
            <span class="mt-2 block text-lg font-heading font-bold text-white group-hover:text-data-cyan transition-colors">Abrir área de dashboards</span>
            <span class="mt-1 block text-xs text-slate-500">Elige el informe B2B u otros reportes publicados.</span>
          </a>
          <a href="./resources.php" class="flex-1 rounded-2xl border border-white/10 bg-white/[0.02] px-6 py-5 text-left hover:border-fuchsia-500/30 transition-colors group">
            <span class="text-xs font-bold uppercase tracking-widest text-fuchsia-400/90">Documentación</span>
            <span class="mt-2 block text-lg font-heading font-bold text-white group-hover:text-fuchsia-300 transition-colors">Centro de recursos</span>
            <span class="mt-1 block text-xs text-slate-500">Guías, novedades y buenas prácticas del portal.</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Section: Visualización Showcase -->
    <div class="bg-navy-surface py-24 relative border-t border-white/5 overflow-hidden">
        <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-fuchsia-600/10 via-rose-600/5 to-transparent pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-core-blue font-bold tracking-wider uppercase text-sm mb-2">Potencia Visual</h2>
                    <h3 class="text-3xl font-bold text-white mb-6 font-heading">Claridad Específica para tu Negocio</h3>
                    <p class="text-slate-400 mb-8 leading-relaxed">
                        Nuestros dashboards están construidos pensando en el usuario final. Filtros intuitivos, drill-down detallado y exploración de datos. Diseñados para responder preguntas de negocio, no solo para mostrar números.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-slate-300">
                            <span class="w-6 h-6 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center text-xs">✓</span>
                            <span>Reportes de Gestión</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <span class="w-6 h-6 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center text-xs">✓</span>
                            <span>Indicadores de Rendimiento (KPIs) en tiempo real</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <span class="w-6 h-6 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center text-xs">✓</span>
                            <span>Seguridad y Gobernanza de Datos</span>
                        </li>
                    </ul>
                    <div class="mt-10">
                        <a href="./dashboards.php" class="text-white border border-white/20 hover:bg-white/5 px-6 py-3 rounded-lg transition-colors inline-block">
                            Ver Galería de Reportes
                        </a>
                    </div>
                </div>
                <!-- Visual Representation with Real Image -->
                <div class="relative">
                    <div class="glass-card rounded-xl p-2 transform rotate-1 hover:rotate-0 transition-transform duration-500 overflow-hidden shadow-2xl shadow-core-blue/20">
                        <div class="bg-deep-bg rounded-lg overflow-hidden border border-white/5 relative">
                            <!-- Image Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-deep-bg/80 to-transparent z-10"></div>
                            <!-- High Quality Dashboard Image -->
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80" 
                                 alt="Dashboard Analytics" 
                                 class="w-full h-auto object-cover opacity-80 hover:opacity-100 transition-opacity duration-700">
                            
                            <!-- Floating Badge -->
                            <div class="absolute bottom-6 left-6 z-20 flex items-center gap-3 bg-black/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-xs font-mono text-white">LIVE DATA FEED</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </main>

  <footer class="site-footer-legal relative z-20 mt-auto w-full border-t border-white/10 bg-black/95">
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

</body>
</html>
