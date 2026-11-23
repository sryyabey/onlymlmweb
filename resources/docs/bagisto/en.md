# OnlyMLM / Nema — Bagisto setup and current integration

[English](setup.en.md) · [Türkçe](setup.tr.md) · [Русский](setup.ru.md) · [Français](setup.fr.md) · [Español](setup.es.md)

Prepared on 23 November 2026 from the working copies of `nema-platform` and `onlyMlmBagisto`. The product delivered through marketplaces such as Codester consists of Nema source files copied into an existing Bagisto project. The sales ZIP does not include the entire Bagisto application.

## 1. Current versions and requirements

| Component | Current version / requirement | Source |
| --- | --- | --- |
| onlyMlmBagisto | Bagisto `2.4.x-dev` | `onlyMlmBagisto/packages/Webkul/Core/src/Core.php`, `BAGISTO_VERSION` |
| Laravel | Locked version `v12.67.0`; Nema minimum `12.61` | Bagisto `composer.lock`, Nema package `composer.json` files |
| PHP | Nema `^8.3`, Bagisto `>=8.2 <8.5`; shared range: PHP 8.3 and 8.4 | Respective `composer.json` files |
| Database | MySQL 8 or compatible MariaDB | `README.tr.md` |
| Nema Core | `sryyabey/nema-core`, `dev-main` | `packages/core/composer.json`, Bagisto `composer.lock` |
| Nema Laravel | `sryyabey/nema-laravel`, `dev-main` | `packages/laravel/composer.json`, Bagisto `composer.lock` |
| Nema Bagisto | `sryyabey/nema-bagisto`, `dev-main` | `packages/bagisto/composer.json`, Bagisto `composer.lock` |
| License verification | PHP Sodium required when enabled | `packages/laravel/src/Licensing/LicenseDocumentVerifier.php` |

HEAD at inspection: nema-platform `34db1fd`, onlyMlmBagisto `74e25dd`. Both working copies contained uncommitted changes, so these hashes alone do not identify all documented code. No commercial Nema version such as `1.0.0` is declared here. `2.4.x-dev` is not a specific stable Bagisto tag; compatibility with other releases requires separate verification.

## 2. Existing development integration

The projects currently sit alongside each other:

```text
onlyMlm/
├── nema-platform/
│   └── packages/
│       ├── core/
│       ├── laravel/
│       └── bagisto/
└── onlyMlmBagisto/
```

Current Nema connection in `onlyMlmBagisto/composer.json`:

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

This is only the Nema-related excerpt. Keep all other Bagisto dependencies and repositories. The Bagisto adapter depends on Core and Laravel. Both Nema service providers are discovered through the packages' `extra.laravel.providers` entries; there are no additional Nema entries in the current Bagisto `bootstrap/providers.php`.

This sibling-directory/symlink layout is for development. The copy-based customer installation is described below. Adding this document did not convert the existing repositories to that layout.

## 3. Sales ZIP layout

Copy each complete package without changing its internal directory structure:

| nema-platform source | Destination in the customer's Bagisto project |
| --- | --- |
| `packages/core/` | `packages/OnlyMlm/Core/` |
| `packages/laravel/` | `packages/OnlyMlm/Laravel/` |
| `packages/bagisto/` | `packages/OnlyMlm/Bagisto/` |

Extracted delivery layout:

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

Do not copy only `src/`: providers use relative paths to `config/`, `database/migrations/` and `src/Resources/`. Although destination folders start with capitals, PHP namespaces remain `Nema\Core`, `Nema\Laravel` and `Nema\Bagisto`.

Exclude `reference/legacy-nema`, `.git`, `.env`, database backups, real license keys, private signing keys, `vendor`, `node_modules` and local runtime data. Do not replace the customer's Bagisto `composer.json` with the platform root file.

## 4. Source-code installation in an existing Bagisto project

No `composer require` is used and no Nema package is downloaded from Packagist or a private Composer repository. Bagisto's existing Composer installation still provides class autoloading. Terminal access is required.

### 4.1. Preparation and copying files

Start with a working Bagisto installation meeting the PHP/Laravel requirements above. Back up files and database and try the procedure in a test environment first. Copy `packages/OnlyMlm` from the ZIP into Bagisto's `packages/` directory.

### 4.2. Autoload mappings

Merge these three entries into the existing `autoload.psr-4` object in Bagisto's root `composer.json`. Keep the App, Database and Webkul mappings:

```json
{
    "Nema\\Core\\": "packages/OnlyMlm/Core/src/",
    "Nema\\Laravel\\": "packages/OnlyMlm/Laravel/src/",
    "Nema\\Bagisto\\": "packages/OnlyMlm/Bagisto/src/"
}
```

This is a fragment, not a replacement file. Merely placing package-level `composer.json` files in these folders does not install dependencies or trigger provider discovery in this manual installation. Check requirements such as the Laravel version yourself.

### 4.3. Registering service providers

Append these classes, in this order, to the existing `return [...]` list in Bagisto's `bootstrap/providers.php`, after the Webkul providers:

```php
Nema\Laravel\Providers\NemaServiceProvider::class,
Nema\Bagisto\Providers\NemaBagistoServiceProvider::class,
```

Core has no service provider. Current Nema models use Laravel Eloquent; do not add a Nema `ModuleServiceProvider` to `config/concord.php`. Do not combine an automatically discovered Composer installation with a manually copied Nema installation. Converting the existing local Composer setup also requires a dependency/lock-file migration and is separate from these new-installation steps.

### 4.4. Autoload and database installation

Run from the customer's Bagisto root:

```bash
composer dump-autoload
php artisan optimize:clear
php artisan nema:install --sync-customers
php artisan nema:doctor
php artisan route:list --name=nema
```

`nema:install`:

- Publishes configuration using `nema-config` and `nema-bagisto-config`, without overwriting existing files.
- Runs Laravel `migrate`, which applies all pending application migrations, not only Nema migrations.
- Creates Nema tables and Bagisto product point attributes through migrations.
- Synchronizes product point translations with existing locales.
- With `--sync-customers`, imports existing customers as Nema members without automatically creating sponsor relationships or binary placements.

In production, review pending migrations and take a backup before running:

```bash
php artisan nema:install --force --sync-customers
```

If migrations have already run, publish configuration and synchronize members without migrating:

```bash
php artisan nema:install --no-migrate --sync-customers
```

## 5. Configuration and licensing

After installation, Bagisto uses `config/nema.php` and `config/nema-bagisto.php`. Source defaults are in the packages' `config/` folders.

Basic environment variables:

```dotenv
NEMA_PLAN_VERSION=1
NEMA_CV_MAX_LEVELS=10
```

For a licensed distribution, replace the placeholders with actual values supplied by the vendor:

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

License checks are disabled by default in the source configuration; prepare the sales package's license policy accordingly. When enabled, verification checks an Ed25519-signed document. Distribute only the public key to clients. If the server is unreachable, cached documents can be used only within the signed `grace_until` period. Route middleware checks license state and feature permissions; GET access without a valid license does not imply access to every feature. The license screen is in the admin Nema section.

These commands target the product's own license API. They do not establish a ready-made Codester purchase-code verification integration. Mapping purchase codes to Nema license keys must be designed separately.

## 6. How the Bagisto integration works

### Identity and networks

- Tenant IDs use `channel:{id}` and member IDs use `customer:{id}`.
- `customer.create.after` synchronizes customers with Nema members.
- A view render event adds the sponsor field to registration.
- `customer.registration.before` validates `sponsor_code` or the referral code in the session. The first registration can omit a sponsor if the tenant has no Nema members; subsequent registrations require a valid sponsor.
- `customer.registration.after` assigns the validated sponsor. It does not automatically place members in the left/right binary tree.
- Referral links use `/nema/join/{code}`.

### Orders, points and packages

| Bagisto event | Nema action |
| --- | --- |
| `checkout.order.orderitem.save.after` | Snapshot order-item points |
| `sales.order.update-status.after` | Process PV/CV and package qualification for eligible statuses |
| `sales.order.cancel.after` | Reverse points and cancel packages |
| `sales.refund.save.after` | Reverse refunded points |

Eligible order statuses default to `processing` and `completed`. Products use `nema_pv` and `nema_cv`. PV is awarded to the buyer; CV follows the sponsor upline up to the configured depth. Refund/cancellation reversals use the original snapshot. Migrations add point fields to attribute families; check families created afterwards separately.

### Screens, permissions and themes

The provider loads admin/customer menus, ACL entries, routes, the `nema-bagisto` view/translation namespace and the profile view composer. It prepends the package override directory to the `shop` view namespace. No manual Bagisto core edits are required.

- Admin entry: `/{admin_url}/nema`, where `admin_url` is `config('app.admin_url')`.
- Customer dashboard: `/customer/account/nema`.
- Network and point screens: `/nema/mlm`, `/nema/mlm_points`, `/nema/binary`, `/nema/binary_points`.
- Career screen: `/nema/career`.

For custom themes, check that registration calls the relevant view render event and customer screens support the package overrides. Grant Nema ACL permissions to restricted admin roles. Installation does not modify existing Bagisto assets; copying the source alone does not require a frontend build.

### Financial scope

Nema produces network, point, package, career and periodic binary results. `nema.features.income` is currently `false`. No wallet, money transfer, commission payout or accounting system is installed. Financial integrations should use the persistent `nema_domain_events` outbox and the event-consumption contract in the README. Sales descriptions must reflect this scope.

## 7. Installation verification and troubleshooting

`nema:doctor` checks basic configuration and tables; it does not establish end-to-end workflow correctness. Verify in a test environment:

1. Admin/customer menus open and unauthorized users cannot access other members' records.
2. Existing customers have Nema members; repeated synchronization creates no duplicates.
3. First-member registration, sponsored registration and referral links work correctly.
4. PV/CV fields appear, eligible orders generate points and repeated events do not duplicate them.
5. Partial refunds and cancellations produce correct reversals.
6. Binary placement, package and career screens respect tenant scope.
7. Licensed installations handle valid/invalid licenses and feature permissions correctly.

Basic production check:

```bash
php artisan nema:doctor --production
```

This expects `APP_ENV=production`, `APP_DEBUG=false`, an HTTPS `APP_URL` and a queue connection other than `sync`. Manage queue workers according to your deployment when using queues.

| Symptom | Check |
| --- | --- |
| `Class Nema... not found` | Three PSR-4 paths, folder case and `composer dump-autoload` |
| Missing `nema` Artisan commands | Provider order and `bootstrap/providers.php` entries |
| Missing Nema tables | Migration output and correct database connection |
| Missing menus/settings | `optimize:clear`, admin ACL, published config and license features |
| Sponsor error during registration | Valid referral code in the same tenant and existing member state |
| No points awarded | Customer mapping, product PV/CV, order status and event flow |
| Missing Sodium function | Sodium extension in the PHP environment performing license verification |

## 8. Updates and release readiness

Back up files/database, update all three package directories together, rebuild autoloading, clear caches and review pending migrations. The installation command does not overwrite published config files; merge new defaults after review. Recheck the license state on licensed installations.

## 9. Demo data (optional)

After Bagisto and Nema installation, run the following from the Bagisto root on a demo database:

```bash
php artisan nema:demo-seed --with-products --with-careers --force
```

Creates 35 demo customers, sponsor/binary networks, 70 synthetic PV/CV entries, five demo careers and 25 products with images and product PV/CV values. Default customer, career and product labels are English. Re-running translates the original Turkish customer/career labels while preserving passwords, point records and custom customer/career names. The product command updates demo products by SKU, including their content and stock; use it only for a demo catalog.

The leader email is printed in the terminal (for channel ID 1: demo.c1.member1@example.test). A password is printed only when the leader is first created. Existing passwords are preserved. No sales orders, payments or package assignments are created.

For multiple channels, use the channel code below instead of the combined command. Products are added separately and always use the first channel; verify this matches your intended demo store.

```bash
php artisan nema:demo-seed --channel=default --with-careers --force
php artisan nema:demo-products add
```
