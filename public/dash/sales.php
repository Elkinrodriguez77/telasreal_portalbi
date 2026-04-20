<?php 
require_once __DIR__ . '/../auth.php'; 
// En esta página siempre estamos logueados porque auth.php lo fuerza.
// Pero necesitamos la sesión para mostrar el nombre.
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BI Gestión Comercial | Telas Real</title>
  <link rel="icon" type="image/png" href="../assets/Imagenes/logo_tr.png">
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
  <link rel="stylesheet" href="../assets/css/telas-brand.css">
  <style>
    /* PowerBI iframe container */
    .iframe-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    /* Fullscreen fallback for mobile/iOS */
    .fullscreen-fallback {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 9999 !important;
        background: #000;
        padding: 0 !important;
        margin: 0 !important;
        border-radius: 0 !important;
    }
  </style>
  <script>
    function toggleFullScreen() {
        const iframeContainer = document.getElementById('dashboard-container');
        const iframe = iframeContainer.querySelector('iframe');
        
        // Try standard fullscreen API first
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen();
        } else if (iframe.webkitRequestFullscreen) { /* Safari */
            iframe.webkitRequestFullscreen();
        } else if (iframe.msRequestFullscreen) { /* IE11 */
            iframe.msRequestFullscreen();
        } else {
            // Fallback for iOS/Mobile browsers that don't support fullscreen API on iframes
            iframeContainer.classList.toggle('fullscreen-fallback');
            iframe.classList.toggle('rounded-xl'); // Remove rounded corners in fullscreen
        }
    }
  </script>
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
        <!-- Ruta corregida: subir un nivel -->
        <a href="../index.php" class="-m-1.5 p-1.5 flex items-center gap-3 group">
          <img src="../assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-10 w-auto max-h-11 object-contain object-left logo-tr-white opacity-95 group-hover:opacity-100 transition-opacity">
        </a>
      </div>
      
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
          <span class="sr-only">Menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        </button>
      </div>
      
      <div class="hidden lg:flex lg:gap-x-10 items-center">
        <!-- Rutas corregidas: subir un nivel ../ -->
        <a href="../index.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Home</a>
        <a href="../resources.php" class="text-sm font-medium leading-6 text-slate-300 hover:text-white transition-all">Recursos</a>
        <a href="../dashboards.php" class="text-sm font-medium leading-6 text-white border-b-2 border-core-blue">Dashboards</a>
        
        <div class="flex items-center gap-4 ml-4 pl-4 border-l border-white/10">
            <div class="flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-full">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            <span class="text-xs font-medium text-green-400">Sesión Activa</span>
        </div>
            <!-- Ruta corregida para logout -->
            <a href="../logout.php" class="rounded-full bg-red-500/10 px-4 py-2 text-sm font-bold text-red-400 hover:bg-red-500 hover:text-white transition-all border border-red-500/30">Cerrar Sesión</a>
        </div>
      </div>
    </nav>
    
  </header>

  <!-- Mobile menu -->
  <div class="hidden lg:hidden relative z-[100]" id="mobile-menu">
    <div class="fixed inset-0 bg-deep-bg/95 backdrop-blur-xl"></div>
    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto px-6 py-6">
      <div class="flex items-center justify-between mb-8">
        <a href="../index.php" class="-m-1.5 p-1.5">
          <img src="../assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-8 w-auto object-contain logo-tr-white">
        </a>
        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-200" onclick="document.getElementById('mobile-menu').classList.add('hidden')">
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
      </div>
      <div class="space-y-4">
          <a href="../index.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Home</a>
          <a href="../resources.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-slate-300 hover:bg-white/5 hover:text-white">Recursos</a>
          <a href="../dashboards.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-white bg-white/5">Dashboards</a>
          <div class="border-t border-white/10 pt-4 mt-4">
              <span class="block px-3 py-2 text-sm text-green-400">Hola, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></span>
              <a href="../logout.php" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-red-400">Cerrar Sesión</a>
          </div>
      </div>
    </div>
  </div>

  <main class="relative z-10 pt-24 pb-12 flex-grow">
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                 <div class="flex items-center gap-2 mb-1">
                     <a href="../dashboards.php" class="text-xs text-core-blue hover:text-white transition-colors flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg> Volver
                     </a>
                 </div>
                 <h1 class="text-2xl font-heading font-bold text-white">BI Gestión Comercial</h1>
            </div>
            <div class="flex gap-2">
                <button onclick="toggleFullScreen()" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-xs text-slate-300 border border-white/10 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                    Pantalla Completa
                </button>
            </div>
        </div>

        <!-- PowerBI Container -->
        <div id="dashboard-container" class="glass-card p-1 rounded-2xl transition-all duration-300">
             <iframe title="BI Gestión Comercial" class="w-full h-[85vh] rounded-xl bg-white" src="https://app.powerbi.com/view?r=eyJrIjoiZDU5ZDcwMjEtNDY3Yi00MWJhLWI0NTItMTY0ZTU1N2NiZWI0IiwidCI6IjVkNTZhZDFiLTc4NDctNDQ1Yy1hNTBjLTIzMWQ5ZjhlY2NiMiJ9" frameborder="0" allowFullScreen="true"></iframe>
        </div>
        
    </div>
  </main>

  <footer class="bg-black py-12 border-t border-white/10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-3">
             <img src="../assets/Imagenes/logo_tr.png" alt="Telas Real" class="h-8 w-auto object-contain logo-tr-white opacity-55 hover:opacity-100 transition-opacity">
             <span class="text-xs text-gray-500">| Portal Centralizado</span>
        </div>
        <p class="text-xs text-gray-600">
            &copy; 2026 diseñado con 💗 por <a href="https://www.dataworld.com.co/" target="_blank" class="text-core-blue hover:text-white transition-colors">Data World</a>. Todos los derechos reservados.
        </p>
    </div>
  </footer>

</body>
</html>
