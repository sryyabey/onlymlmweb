# OnlyMLM / Nema — Instalación de Bagisto e integración actual

[English](setup.en.md) · [Türkçe](setup.tr.md) · [Русский](setup.ru.md) · [Français](setup.fr.md) · [Español](setup.es.md)

Documento preparado el 23 de noviembre de 2026 a partir de las copias de trabajo de `nema-platform` y `onlyMlmBagisto`. El producto distribuido en plataformas como Codester contiene el código fuente de Nema para copiarlo en un proyecto Bagisto existente. El ZIP comercial no incluye toda la aplicación Bagisto.

## 1. Versiones actuales y requisitos

| Componente | Versión actual / requisito | Fuente |
| --- | --- | --- |
| onlyMlmBagisto | Bagisto `2.4.x-dev` | `onlyMlmBagisto/packages/Webkul/Core/src/Core.php`, `BAGISTO_VERSION` |
| Laravel | Versión bloqueada `v12.67.0`; mínimo de Nema `12.61` | `composer.lock` de Bagisto, archivos `composer.json` de Nema |
| PHP | Nema `^8.3`, Bagisto `>=8.2 <8.5`; intervalo común: PHP 8.3 y 8.4 | Archivos `composer.json` correspondientes |
| Base de datos | MySQL 8 o MariaDB compatible | `README.tr.md` |
| Nema Core | `sryyabey/nema-core`, `dev-main` | `packages/core/composer.json`, `composer.lock` de Bagisto |
| Nema Laravel | `sryyabey/nema-laravel`, `dev-main` | `packages/laravel/composer.json`, `composer.lock` de Bagisto |
| Nema Bagisto | `sryyabey/nema-bagisto`, `dev-main` | `packages/bagisto/composer.json`, `composer.lock` de Bagisto |
| Verificación de licencia | Requiere PHP Sodium cuando está activada | `packages/laravel/src/Licensing/LicenseDocumentVerifier.php` |

HEAD al revisar: nema-platform `34db1fd`, onlyMlmBagisto `74e25dd`. Había cambios sin confirmar, por lo que estos identificadores no representan por sí solos todo el código documentado. Aquí no se declara una versión comercial de Nema como `1.0.0`. `2.4.x-dev` tampoco es una etiqueta estable concreta de Bagisto; la compatibilidad con otras versiones debe verificarse por separado.

## 2. Integración de desarrollo actual

Actualmente los proyectos están en directorios contiguos:

```text
onlyMlm/
├── nema-platform/
│   └── packages/
│       ├── core/
│       ├── laravel/
│       └── bagisto/
└── onlyMlmBagisto/
```

Conexión actual de Nema en `onlyMlmBagisto/composer.json`:

```json
{
    "require": {
        "sryyabey/nema-bagisto": "dev-main"
    },
    "repositories": [
        {
            "type": "path",
            "url": "../nema-platform/packages/*",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

Es solo el fragmento relativo a Nema. Conserve las demás dependencias y repositorios de Bagisto. El adaptador Bagisto depende de Core y Laravel. Los dos proveedores de servicios de Nema se descubren mediante `extra.laravel.providers`; el `bootstrap/providers.php` actual de Bagisto no incluye registros Nema adicionales.

Esta estructura con directorio vecino y enlaces simbólicos sirve para desarrollo. La instalación del cliente mediante copia se describe a continuación. Añadir este documento no convirtió los repositorios existentes a esa estructura.

## 3. Estructura del ZIP comercial

Copie íntegramente los tres paquetes sin modificar su estructura interna:

| Origen en nema-platform | Destino en el proyecto Bagisto del cliente |
| --- | --- |
| `packages/core/` | `packages/OnlyMlm/Core/` |
| `packages/laravel/` | `packages/OnlyMlm/Laravel/` |
| `packages/bagisto/` | `packages/OnlyMlm/Bagisto/` |

Estructura tras la extracción:

```text
OnlyMLM-Bagisto/
├── packages/
│   └── OnlyMlm/
│       ├── Core/
│       │   ├── composer.json
│       │   └── src/
│       ├── Laravel/
│       │   ├── composer.json
│       │   ├── config/
│       │   ├── database/
│       │   └── src/
│       └── Bagisto/
│           ├── composer.json
│           ├── config/
│           └── src/
├── setup.md
├── setup.en.md
├── setup.tr.md
├── setup.ru.md
├── setup.fr.md
└── setup.es.md
```

No copie solo `src/`: los proveedores usan rutas relativas hacia `config/`, `database/migrations/` y `src/Resources/`. Aunque las carpetas de destino empiezan con mayúscula, los espacios de nombres PHP siguen siendo `Nema\Core`, `Nema\Laravel` y `Nema\Bagisto`.

Excluya `reference/legacy-nema`, `.git`, `.env`, copias de seguridad de bases de datos, claves de licencia reales, claves privadas de firma, `vendor`, `node_modules` y datos locales de ejecución. No sustituya el `composer.json` del cliente por el archivo raíz de la plataforma.

## 4. Instalación del código en un Bagisto existente

No se ejecuta `composer require` ni se descarga Nema desde Packagist o un repositorio Composer privado. Composer sigue proporcionando la carga automática de clases de Bagisto. Se necesita acceso al terminal.

### 4.1. Preparación y copia de archivos

Parta de una instalación Bagisto operativa que cumpla los requisitos PHP/Laravel. Haga una copia de seguridad de archivos y base de datos y pruebe primero en un entorno de pruebas. Copie `packages/OnlyMlm` del ZIP dentro de `packages/` de Bagisto.

### 4.2. Asignaciones de autoload

Añada estas tres entradas al objeto `autoload.psr-4` existente del `composer.json` raíz de Bagisto. Conserve las entradas App, Database y Webkul:

```json
{
    "Nema\\Core\\": "packages/OnlyMlm/Core/src/",
    "Nema\\Laravel\\": "packages/OnlyMlm/Laravel/src/",
    "Nema\\Bagisto\\": "packages/OnlyMlm/Bagisto/src/"
}
```

Este bloque es un fragmento para combinar, no el archivo completo. La presencia de los `composer.json` de los subpaquetes no instala dependencias ni activa el descubrimiento de proveedores en este método manual. Compruebe los requisitos, como la versión Laravel, manualmente.

### 4.3. Registro de proveedores de servicios

Añada estas clases en este orden al final de la lista `return [...]` de `bootstrap/providers.php`, después de los proveedores Webkul:

```php
Nema\Laravel\Providers\NemaServiceProvider::class,
Nema\Bagisto\Providers\NemaBagistoServiceProvider::class,
```

Core no tiene proveedor de servicios. Los modelos Nema actuales usan Laravel Eloquent; no añada un `ModuleServiceProvider` Nema a `config/concord.php`. No combine una instalación Composer descubierta automáticamente con una copia manual de Nema. Convertir la instalación Composer local existente también requiere migrar dependencias y el archivo lock, aparte de estos pasos de instalación nueva.

### 4.4. Autoload e instalación de la base de datos

Ejecute desde la raíz del Bagisto del cliente:

```bash
composer dump-autoload
php artisan optimize:clear
php artisan nema:install --sync-customers
php artisan nema:doctor
php artisan route:list --name=nema
```

`nema:install`:

- Publica las configuraciones con las etiquetas `nema-config` y `nema-bagisto-config`, sin sobrescribir archivos existentes.
- Ejecuta Laravel `migrate`, que aplica todas las migraciones pendientes de la aplicación, no solo las de Nema.
- Crea las tablas Nema y los atributos de puntos de productos Bagisto mediante migraciones.
- Sincroniza las traducciones de puntos con los idiomas existentes.
- Con `--sync-customers`, importa los clientes existentes como miembros Nema, sin crear automáticamente relaciones de patrocinio ni posiciones binarias.

En producción, revise las migraciones pendientes y haga una copia de seguridad antes de ejecutar:

```bash
php artisan nema:install --force --sync-customers
```

Si las migraciones ya se ejecutaron, publique configuraciones y sincronice miembros sin migrar:

```bash
php artisan nema:install --no-migrate --sync-customers
```

## 5. Configuración y licencias

Tras instalar, Bagisto usa `config/nema.php` y `config/nema-bagisto.php`. Los valores predeterminados de origen están en los directorios `config/` de los paquetes.

Variables de entorno básicas:

```dotenv
NEMA_PLAN_VERSION=1
NEMA_CV_MAX_LEVELS=10
```

Para una distribución con licencia, sustituya los marcadores por los valores reales proporcionados por el vendedor:

```dotenv
NEMA_LICENSE_ENABLED=true
NEMA_LICENSE_SERVER=https://onlymlm.com/api/v1/licenses
NEMA_LICENSE_KEY=YOUR-LICENSE-KEY
NEMA_LICENSE_PRODUCT=onlymlm-bagisto
NEMA_LICENSE_PUBLIC_KEY=YOUR-BASE64-PUBLIC-KEY
NEMA_LICENSE_ENVIRONMENT=production
NEMA_LICENSE_CACHE_TTL=86400
```

```bash
php artisan optimize:clear
php artisan nema:license activate
php artisan nema:license status
php artisan nema:license validate
```

La comprobación de licencia está desactivada por defecto en la configuración fuente; prepare la política comercial en consecuencia. Cuando se activa, verifica un documento firmado con Ed25519. Solo se entrega la clave pública al cliente. Si el servidor no responde, el documento en caché solo puede usarse dentro del periodo firmado `grace_until`. El middleware verifica estado y permisos de funciones; el acceso GET sin licencia válida no habilita todas las funciones. La pantalla de licencia está en la sección Nema del panel de administración.

Estos comandos utilizan la API de licencias del producto. No implican una integración lista para verificar códigos de compra de Codester. La correspondencia entre código de compra y clave Nema debe diseñarse por separado.

## 6. Funcionamiento de la integración Bagisto

### Identidad y redes

- El identificador del tenant usa `channel:{id}` y el del miembro `customer:{id}`.
- `customer.create.after` sincroniza el cliente con el miembro Nema.
- Un evento de renderizado añade el campo de patrocinador al formulario de registro.
- `customer.registration.before` valida `sponsor_code` o el código de referido en la sesión. Si el tenant no tiene miembros Nema, el primer registro puede omitir el patrocinador; los siguientes requieren uno válido.
- `customer.registration.after` asigna el patrocinador validado, sin colocar automáticamente al miembro en el árbol binario izquierdo/derecho.
- Los enlaces de referido usan `/nema/join/{code}`.

### Pedidos, puntos y paquetes

| Evento Bagisto | Acción Nema |
| --- | --- |
| `checkout.order.orderitem.save.after` | Instantánea de puntos de la línea de pedido |
| `sales.order.update-status.after` | Procesar PV/CV y requisitos de paquetes en estados admisibles |
| `sales.order.cancel.after` | Revertir puntos y cancelar paquetes |
| `sales.refund.save.after` | Revertir puntos reembolsados |

Los estados admisibles predeterminados son `processing` y `completed`. Los productos usan `nema_pv` y `nema_cv`. El PV se asigna al comprador; el CV recorre la línea ascendente de patrocinio hasta la profundidad configurada. Las reversiones de reembolsos/cancelaciones usan la instantánea original. Las migraciones añaden los campos a las familias de atributos; compruebe por separado las familias creadas después.

### Pantallas, permisos y temas

El proveedor carga menús de administración/cliente, ACL, rutas, el espacio de nombres de vistas/traducciones `nema-bagisto` y el compositor de vista del perfil. Añade con prioridad el directorio de sobreescrituras al espacio de vistas `shop`. No requiere modificar manualmente el núcleo de Bagisto.

- Administración: `/{admin_url}/nema`, donde `admin_url` es `config('app.admin_url')`.
- Resumen del cliente: `/customer/account/nema`.
- Redes y puntos: `/nema/mlm`, `/nema/mlm_points`, `/nema/binary`, `/nema/binary_points`.
- Carrera: `/nema/career`.

Con temas personalizados, compruebe que el formulario llama al evento de renderizado correspondiente y que las pantallas del cliente admiten las sobreescrituras. Asigne permisos ACL Nema a los roles administrativos restringidos. No se modifican los assets existentes; copiar las fuentes por sí solo no exige compilar el frontend.

### Alcance financiero

Nema produce resultados de redes, puntos, paquetes, carreras y cálculos binarios periódicos. `nema.features.income` es actualmente `false`. No se instala monedero, transferencia de dinero, pago de comisiones ni sistema contable. Las integraciones financieras deben usar el outbox persistente `nema_domain_events` y el contrato de consumo de eventos del README. La descripción comercial debe reflejar este alcance.

## 7. Verificación y solución de problemas

`nema:doctor` comprueba configuración básica y tablas; no valida todos los flujos de extremo a extremo. Verifique en un entorno de pruebas:

1. Los menús abren y los usuarios no autorizados no acceden a registros de otros miembros.
2. Los clientes existentes tienen miembros Nema; repetir la sincronización no genera duplicados.
3. Funcionan el primer registro, el registro patrocinado y los enlaces de referido.
4. Aparecen PV/CV, los pedidos admisibles generan puntos y los eventos repetidos no los duplican.
5. Los reembolsos parciales y cancelaciones producen reversiones correctas.
6. Colocación binaria, paquetes y carreras respetan el ámbito del tenant.
7. Se verifican licencias válidas/inválidas y permisos de funciones.

Comprobación básica de producción:

```bash
php artisan nema:doctor --production
```

Espera `APP_ENV=production`, `APP_DEBUG=false`, una `APP_URL` HTTPS y una conexión de cola distinta de `sync`. Si usa colas, gestione sus workers según el despliegue.

| Síntoma | Comprobación |
| --- | --- |
| `Class Nema... not found` | Tres rutas PSR-4, mayúsculas de carpetas y `composer dump-autoload` |
| Faltan comandos Artisan `nema` | Orden de proveedores y registros en `bootstrap/providers.php` |
| Faltan tablas Nema | Salida de migraciones y conexión a la base correcta |
| Faltan menús o ajustes | `optimize:clear`, ACL, configuración publicada y funciones de licencia |
| Error de patrocinador al registrar | Código válido del mismo tenant y estado de miembros existentes |
| No se generan puntos | Asignación de cliente, PV/CV del producto, estado y eventos |
| Falta una función Sodium | Extensión Sodium en el PHP que verifica la licencia |

## 8. Actualizaciones y preparación para la venta

Haga una copia de archivos/base, actualice los tres directorios juntos, regenere el autoload, limpie cachés y revise migraciones pendientes. La instalación no sobrescribe configuraciones publicadas; incorpore los nuevos valores predeterminados tras revisarlos. Vuelva a comprobar la licencia cuando esté activada.

## 9. Datos de demostración (opcional)

Tras instalar Bagisto y Nema, ejecute desde la raíz de Bagisto sobre una base de demostración:

```bash
php artisan nema:demo-seed --with-products --with-careers --force
```

Crea 35 clientes, redes de patrocinio/binaria, 70 registros PV/CV sintéticos, cinco carreras y 25 productos con imágenes y valores PV/CV. Los nombres predeterminados están en inglés. Al repetir, traduce los nombres turcos originales de clientes/carreras conservando contraseñas, puntos y nombres personalizados. El comando de productos actualiza contenido y existencias por SKU; úselo solo en un catálogo de demostración.

El correo del líder aparece en la terminal (canal ID 1: demo.c1.member1@example.test). La contraseña solo aparece al crear al líder; las existentes se conservan. No se crean pedidos, pagos ni asignaciones de paquetes.

Con varios canales, use el comando con código de canal siguiente en lugar del comando combinado. Los productos se añaden por separado al primer canal; compruebe el destino.

```bash
php artisan nema:demo-seed --channel=default --with-careers --force
php artisan nema:demo-products add
```
