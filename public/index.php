<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Centralizado | Asesor Group</title>
  
  <!-- Favicon añadido -->
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
            'core-blue': '#395bb5',      
            'deep-bg': '#020617',        
            'navy-surface': '#0f172a',   
            'data-cyan': '#06b6d4',      
            'data-amber': '#f59e0b',     
            'glass': 'rgba(15, 23, 42, 0.7)',
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            'hero-glow': 'conic-gradient(from 90deg at 50% 50%, #020617 0%, #1e293b 50%, #395bb5 100%)',
          }
        }
      }
    }
  </script>
  <style>
    .glass-card {
      background: rgba(30, 41, 59, 0.4);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(57, 91, 181, 0.2);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }
    .glass-card:hover {
      background: rgba(57, 91, 181, 0.15);
      border: 1px solid rgba(57, 91, 181, 0.5);
      box-shadow: 0 0 20px rgba(57, 91, 181, 0.2);
    }
    .text-glow {
      text-shadow: 0 0 20px rgba(57, 91, 181, 0.5);
    }
    @keyframes drift {
      0% { transform: translate(0, 0); }
      50% { transform: translate(10px, 20px); }
      100% { transform: translate(0, 0); }
    }
    .animate-drift {
      animation: drift 10s infinite ease-in-out;
    }
  </style>
</head>
<body class="bg-deep-bg text-slate-300 font-sans antialiased overflow-x-hidden selection:bg-core-blue selection:text-white">

  <!-- Background Effects -->
  <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
    <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-core-blue/20 rounded-full blur-[120px] mix-blend-screen animate-pulse"></div>
    <div class="absolute bottom-[10%] right-[-5%] w-[500px] h-[500px] bg-data-cyan/10 rounded-full blur-[100px] mix-blend-screen"></div>
    <div class="absolute top-[40%] left-[30%] w-[300px] h-[300px] bg-purple-900/20 rounded-full blur-[80px]"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
  </div>

  <!-- Header -->
  <header class="fixed inset-x-0 top-0 z-50 bg-deep-bg/80 backdrop-blur-md border-b border-white/5 transition-all duration-300">
    <nav class="flex items-center justify-between p-6 lg:px-8 max-w-7xl mx-auto" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="./index.php" class="-m-1.5 p-1.5 flex items-center gap-3 group">
          <!-- Logo del Cliente -->
          <img src="./assets/Imagenes/Logobyd.png" alt="Asesor Group Logo" class="h-10 w-auto object-contain brightness-0 invert opacity-90 group-hover:opacity-100 transition-opacity">
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
          <img src="./assets/Imagenes/Logobyd.png" alt="Logo" class="h-8 w-auto brightness-0 invert">
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

  <main class="relative z-10 pt-20">

    <!-- Hero Section -->
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-4xl py-24 sm:py-32 lg:py-40 text-center">
        <!-- Badge -->
        <div class="hidden sm:mb-8 sm:flex sm:justify-center animate-drift">
          <div class="relative rounded-full px-4 py-1.5 text-sm leading-6 text-slate-400 ring-1 ring-white/10 hover:ring-core-blue/50 hover:bg-core-blue/10 transition-all cursor-default backdrop-blur-sm">
            Bienvenido a la Central de Datos <span class="font-semibold text-data-cyan">Asesor Group</span>
          </div>
        </div>
        
        <!-- Main Title -->
        <h1 class="font-heading text-5xl font-extrabold tracking-tight text-white sm:text-7xl mb-6">
          Toda tu empresa <br/>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-core-blue via-blue-400 to-data-cyan text-glow">Centralizada & Visible 24/7</span>
        </h1>
        
        <p class="mt-6 text-lg leading-8 text-slate-400 max-w-2xl mx-auto">
          Data World consolida la información crítica de tu negocio en un solo lugar. Visualizaciones de alto impacto para decisiones estratégicas inmediatas.
        </p>
        
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="./dashboards.php" class="rounded-full bg-core-blue px-8 py-4 text-sm font-bold text-white shadow-[0_0_20px_rgba(57,91,181,0.4)] hover:bg-blue-600 hover:shadow-[0_0_30px_rgba(57,91,181,0.6)] hover:-translate-y-1 transition-all duration-300">
            Ir a Dashboards
          </a>
          <a href="#soluciones" class="group text-sm font-semibold leading-6 text-white hover:text-data-cyan transition-colors flex items-center gap-2">
            Explorar Soluciones <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform">→</span>
          </a>
        </div>
      </div>
      
      <!-- Metrics / Value Grid -->
      <div id="soluciones" class="mx-auto max-w-7xl px-6 pb-24 lg:px-8">
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
      </div>
    </div>

    <!-- Section: Visualización Showcase -->
    <div class="bg-navy-surface py-24 relative border-t border-white/5 overflow-hidden">
        <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-core-blue/5 to-transparent pointer-events-none"></div>
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

  <footer class="bg-black py-12 border-t border-white/10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-3">
             <img src="./assets/Imagenes/Logobyd.png" alt="Logo" class="h-8 w-auto brightness-0 invert opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all">
             <span class="text-xs text-gray-500">| Portal Centralizado</span>
        </div>
        <p class="text-xs text-gray-600">
            &copy; 2026 diseñado con 💗 por <a href="https://www.dataworld.com.co/" target="_blank" class="text-core-blue hover:text-white transition-colors">Data World</a>. Todos los derechos reservados.
        </p>
    </div>
  </footer>

</body>
</html>
