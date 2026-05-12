# Portal BI — Telas Real

Portal interno de business intelligence para Telas Real: acceso a dashboards (Power BI embebido), registro con aprobación, login y recuperación de contraseña. El stack es PHP y MySQL; el front vive en `public/` y lo que no debe exponerse al navegador está en `backend/`.

## Entorno

Necesitas PHP 8 (con `pdo_mysql`, `json`, `session` y `mbstring`) y una base MySQL o MariaDB. En local conviene una BD propia: las credenciales del hosting no suelen funcionar contra `localhost` en tu máquina.

## Arranque rápido en local

En la raíz del repo (donde están `public` y `backend`):

```bash
php -S localhost:8080 -t public
```

Abre `http://localhost:8080`. Para parar el servidor: `Ctrl+C`.

## Configuración

No subimos secretos al repo. Copia `backend/config.sample.php` a `backend/config.php` y rellena conexión a la base, claves de reCAPTCHA (sitio + secreta del mismo par en Google) y dominios de correo permitidos. Los archivos `config.php`, notas con contraseñas y `config.md` están en `.gitignore`; quien clone el proyecto tiene que crear su propio `config.php`.

### URLs de los dashboards Power BI (embebidos)

Los `iframe` de **Gestión B2B** y **Ventas 360°** no llevan la URL del informe en el código versionado: se leen desde **`public/dash/embed-config.php`**, que está en **`.gitignore`** y no debe subirse a GitHub. Así los enlaces publicados del servicio Power BI no quedan expuestos en el repositorio público (solo en el servidor o en máquinas locales donde crees ese archivo).

1. Copia `public/dash/embed-config.sample.php` a **`public/dash/embed-config.php`**.
2. Pega ahí las dos URLs embed de cada informe (claves `gestion_b2b` y `ventas_360`).

En cada despliegue ( hosting o nuevo entorno ), crea ese archivo en el servidor igual que `backend/config.php`. Si falta `embed-config.php`, las páginas de dashboard responderán con un mensaje indicando que falta la configuración.

**Nota de seguridad:** el portal solo muestra los informes a usuarios **logueados**; aun así, quien obtenga una URL embed podría abrirla fuera del portal si el informe está publicado de forma muy abierta en Power BI. Por eso conviene mantener esas URLs fuera del Git público y revisar periódicamente la política de publicación en Power BI. El `.gitignore` evita subir `embed-config.php` en commits nuevos; si en el pasado ya se llegaron a versionar enlaces dentro de los PHP del dashboard, pueden seguir en el historial de Git hasta que regeneres enlaces en Power BI o hagas una limpieza deliberada del historial.

### Probar en tu PC sin mezclar con producción

Puedes dejar `config.php` como en el hosting (o una copia) y crear **`backend/config.local.php`** a partir de `backend/config.local.sample.php`. Ese archivo solo existe en tu máquina (también está en `.gitignore`): redefine por ejemplo el bloque `mysql` para apuntar a una base **local**. El código fusiona `config.local.php` encima de `config.php`, así reutilizas las mismas claves de reCAPTCHA y dominios de correo si quieres. Crea una base vacía local, entra a `setup_db.php`, registra un usuario de prueba y aprueba `approved = 1` en MySQL; eso **no viaja a GitHub**: solo son datos en tu disco.

Tras el primer despliegue o la primera petición que toque la BD, el esquema de tablas se crea solo si el usuario MySQL puede ejecutar `CREATE TABLE`. Si prefieres comprobarlo a mano, puedes abrir en el navegador `setup_db.php` una vez.

## Despliegue en hosting (cPanel)

Clona o actualiza desde GitHub con la herramienta de Git del panel. El document root del sitio debe ser la carpeta `public`. Después del pull, vuelve a colocar `backend/config.php` y **`public/dash/embed-config.php`** en el servidor (no vienen en el repo).

## Registro y correo corporativo

El dominio del email se valida en servidor (`allowed_email_domains` en `config.php`) y en el cliente (`ALLOWED_DOMAIN` en `assets/js/register.js`). Si cambias uno, alinea el otro para no confundir al usuario.

## Recursos de marca

El logo del header/footer es `public/assets/Imagenes/logo_tr.png`; el aspecto oscuro y los degradados están en `public/assets/css/telas-brand.css` y en la configuración de Tailwind embebida en las páginas.
