# Portal BI — Telas Real

Aplicación web en **PHP** con front en `public/` y lógica y credenciales fuera del document root en `backend/`.

## Requisitos

- **PHP** 8.x recomendado (con extensiones habituales: `pdo_mysql`, `json`, `session`).
- **MySQL** o MariaDB (misma base que uses en producción o una copia local).
- Navegador moderno.

## Estructura

| Ruta | Uso |
|------|-----|
| `public/` | Raíz web: páginas, `api/`, assets. |
| `backend/` | Configuración, acceso a BD, logs (no debe ser público). |
| `backend/config.sample.php` | Plantilla de configuración **sin secretos**. |
| `public/assets/Imagenes/logo_tr.png` | Logo Telas Real (header/footer; en blanco vía CSS). Debe existir en el proyecto. |
| `public/assets/css/telas-brand.css` | Estilos de marca (vidrio, degradados, animación suave). |

Archivos que **no** van al repositorio (ver `.gitignore`): notas locales, `backend/config.php` real, logs, `.env`.

## Configuración

1. Copia la plantilla: `backend/config.sample.php` → `backend/config.php`.
2. Edita `backend/config.php` en tu máquina o en el servidor con:
   - datos de conexión MySQL;
   - claves **secreta** y **de sitio** de reCAPTCHA (deben corresponder al mismo par en Google).
3. No subas `config.php` ni notas con contraseñas a Git; usa `config.md` solo en local si lo necesitas (está ignorado por git).

## Probar en desarrollo (local)

Desde la **raíz del proyecto** (donde están las carpetas `public` y `backend`).

**Git Bash:**

```bash
php -S localhost:8080 -t public
```

**PowerShell:**

```powershell
php -S localhost:8080 -t public
```

Abre en el navegador: `http://localhost:8080/`

Si ya estás dentro de `public/`:

```bash
php -S localhost:8080
```

Detener el servidor: `Ctrl+C`.

Comprueba que PHP esté instalado: `php -v`. Si falla la conexión a BD o el registro, revisa que `backend/config.php` apunte a un MySQL accesible desde tu PC.

## Despliegue (resumen)

- Repositorio en GitHub; en cPanel usar **Control de versiones de Git** para clonar o actualizar el repo en el servidor.
- Tras clonar o actualizar, asegurar que exista **`backend/config.php`** en el servidor (no viene del repo).
- El **document root** del dominio debe apuntar a la carpeta **`public`** del proyecto (o equivalente en tu hosting).

## Registro y dominios de correo

El servidor valida el dominio del correo con `allowed_email_domains` en `backend/config.php`. El archivo `public/assets/js/register.js` repite la misma regla solo para feedback inmediato en el navegador: mantén ambos alineados. La plantilla usa `telasreal.com`; si usas otro dominio corporativo, actualiza esos dos sitios y tu `config.php` en servidor.

---

*Este README solo documenta el flujo de trabajo; no contiene credenciales ni claves.*
