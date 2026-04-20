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

Tras el primer despliegue o la primera petición que toque la BD, el esquema de tablas se crea solo si el usuario MySQL puede ejecutar `CREATE TABLE`. Si prefieres comprobarlo a mano, puedes abrir en el navegador `setup_db.php` una vez.

## Despliegue en hosting (cPanel)

Clona o actualiza desde GitHub con la herramienta de Git del panel. El document root del sitio debe ser la carpeta `public`. Después del pull, vuelve a colocar `backend/config.php` en el servidor (no viene en el repo).

## Registro y correo corporativo

El dominio del email se valida en servidor (`allowed_email_domains` en `config.php`) y en el cliente (`ALLOWED_DOMAIN` en `assets/js/register.js`). Si cambias uno, alinea el otro para no confundir al usuario.

## Recursos de marca

El logo del header/footer es `public/assets/Imagenes/logo_tr.png`; el aspecto oscuro y los degradados están en `public/assets/css/telas-brand.css` y en la configuración de Tailwind embebida en las páginas.
