<?php
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva Contraseña | Telas Real</title>
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
<body class="bg-deep-bg text-slate-300 font-sans antialiased overflow-x-hidden selection:bg-core-blue selection:text-white">

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
            <a href="./register.php" class="text-sm font-medium leading-6 text-core-blue hover:text-data-cyan transition-colors">Registro</a>
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
    <div class="mx-auto max-w-xl px-6 lg:px-8">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-heading font-bold text-white">Nueva Contraseña</h1>
            <p class="mt-2 text-slate-400">Ingresa tu nueva contraseña segura.</p>
        </div>

        <div id="alert" class="hidden mb-6 p-4 rounded-lg bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-sm text-center"></div>

        <div class="glass-card p-8 rounded-2xl border-t border-white/10">
            <form id="f" class="space-y-6" novalidate>
                <input type="hidden" id="token" value="<?php echo htmlspecialchars($token, ENT_QUOTES); ?>">
                
                <div>
                    <label for="p1" class="block text-sm font-medium text-slate-300 mb-2">Nueva contraseña</label>
                    <input id="p1" type="password" required minlength="8"
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="p2" class="block text-sm font-medium text-slate-300 mb-2">Confirmar contraseña</label>
                    <input id="p2" type="password" required minlength="8"
                        class="w-full bg-deep-bg border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-core-blue focus:border-transparent transition-all">
                </div>

                <button id="b" type="submit" 
                    class="w-full rounded-full bg-core-blue px-4 py-3 text-sm font-bold text-white shadow-lg shadow-core-blue/20 hover:bg-blue-600 hover:shadow-core-blue/40 transition-all duration-300 transform hover:-translate-y-0.5">
                    Guardar
                </button>
            </form>

            <div id="successActions" class="hidden mt-6 text-center">
              <a href="./login.php" class="inline-block rounded-full bg-green-500 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-green-600 transition-all">
                Ir a Iniciar Sesión
              </a>
            </div>
        </div>
        
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

  <script>
    (function(){
      const f = document.getElementById('f');
      const b = document.getElementById('b');
      const a = document.getElementById('alert');
      function show(m, ok){ 
          a.textContent=m; 
          a.classList.remove('hidden'); 
          a.className = ok ? 'mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 text-sm text-center' : 'mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm text-center';
      }
      function clear(){ a.textContent=''; a.classList.add('hidden'); }
      f.addEventListener('submit', async (e)=>{
        e.preventDefault(); clear(); b.setAttribute('disabled','true'); b.classList.add('opacity-50', 'cursor-not-allowed'); b.textContent = 'Guardando...';
        try{
          const res = await fetch('./api/reset_password.php', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ token: document.getElementById('token').value, password: document.getElementById('p1').value, password_confirm: document.getElementById('p2').value }) });
          const data = await res.json();
          if (data && data.ok){
            show('¡Contraseña actualizada con éxito!', true);
            Array.from(f.querySelectorAll('input,button')).forEach(el=>el.setAttribute('disabled','true'));
            b.classList.add('hidden');
            document.getElementById('successActions').classList.remove('hidden');
            return;
          }
          show((data && data.message) || 'Error al actualizar', false);
        } catch(err){ show('Error de conexión', false); }
        finally{ if(!document.getElementById('successActions').classList.contains('hidden')) return; b.removeAttribute('disabled'); b.classList.remove('opacity-50', 'cursor-not-allowed'); b.textContent = 'Guardar'; }
      });
    })();
  </script>
</body>
</html>
