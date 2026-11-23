# OnlyMLM / Nema — Bagisto kurulumu ve mevcut entegrasyon

[English](setup.en.md) · [Türkçe](setup.tr.md) · [Русский](setup.ru.md) · [Français](setup.fr.md) · [Español](setup.es.md)

Bu belge, 23 Kasım 2026 tarihinde `nema-platform` ve `onlyMlmBagisto` çalışma kopyalarındaki kodlar esas alınarak hazırlanmıştır. Codester benzeri platformlarda teslim edilecek ürün, mevcut Bagisto projesine kopyalanan Nema kaynak kodlarıdır. Bagisto uygulamasının tamamı satış ZIP'inin parçası değildir.

## 1. Mevcut sürüm ve gereksinimler

| Bileşen | Mevcut durum / gereksinim | Kaynak |
| --- | --- | --- |
| onlyMlmBagisto | Bagisto `2.4.x-dev` | `onlyMlmBagisto/packages/Webkul/Core/src/Core.php`, `BAGISTO_VERSION` |
| Laravel | Kilitli sürüm `v12.67.0`; Nema paketlerinin alt sınırı `12.61` | Bagisto `composer.lock`, Nema paketlerinin `composer.json` dosyaları |
| PHP | Nema `^8.3`, Bagisto `>=8.2 <8.5`; ortak aralık PHP 8.3 ve 8.4 | İlgili `composer.json` dosyaları |
| Veritabanı | MySQL 8 veya uyumlu MariaDB | `README.tr.md` |
| Nema Core | `sryyabey/nema-core`, `dev-main` | `packages/core/composer.json`, Bagisto `composer.lock` |
| Nema Laravel | `sryyabey/nema-laravel`, `dev-main` | `packages/laravel/composer.json`, Bagisto `composer.lock` |
| Nema Bagisto | `sryyabey/nema-bagisto`, `dev-main` | `packages/bagisto/composer.json`, Bagisto `composer.lock` |
| Lisans doğrulama | Etkinleştirildiğinde PHP Sodium uzantısı gerekir | `packages/laravel/src/Licensing/LicenseDocumentVerifier.php` |

İnceleme anındaki HEAD değerleri: nema-platform `34db1fd`, onlyMlmBagisto `74e25dd`. Çalışma kopyalarında commit edilmemiş değişiklikler bulunduğundan bu değerler belgedeki tüm kodların tek başına sürüm kimliği değildir. Nema için burada `1.0.0` gibi bir satış sürümü ilan edilmemiştir. `2.4.x-dev` de belirli bir kararlı Bagisto etiketi değildir; başka Bagisto sürümleriyle uyumluluk ayrıca doğrulanmalıdır.

## 2. Mevcut geliştirme entegrasyonu

Şu anda projeler yan yana bulunur:

```text
onlyMlm/
├── nema-platform/
│   └── packages/
│       ├── core/
│       ├── laravel/
│       └── bagisto/
└── onlyMlmBagisto/
```

`onlyMlmBagisto/composer.json` içindeki mevcut bağlantı:

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

Bu, dosyanın yalnızca Nema ile ilgili bölümüdür. Bagisto'nun diğer bağımlılıkları ve repository kayıtları korunur. Bagisto adaptörü Core ve Laravel paketlerini bağımlılık olarak getirir. İki Nema servis sağlayıcısı paketlerin `extra.laravel.providers` tanımları üzerinden otomatik keşfedilir; mevcut Bagisto `bootstrap/providers.php` dosyasında ayrıca Nema kaydı yoktur.

Bu kardeş klasör ve symlink düzeni geliştirme içindir. Müşteriye teslim edilecek kopyala-kur düzeni aşağıdadır; mevcut depolar bu belge eklenirken bu düzene dönüştürülmemiştir.

## 3. Satış ZIP'inin dosya yerleşimi

Platformdaki üç paketin tamamını, klasör içlerini değiştirmeden aşağıdaki hedeflere yerleştirin:

| nema-platform kaynağı | Müşterinin Bagisto projesindeki hedef |
| --- | --- |
| `packages/core/` | `packages/OnlyMlm/Core/` |
| `packages/laravel/` | `packages/OnlyMlm/Laravel/` |
| `packages/bagisto/` | `packages/OnlyMlm/Bagisto/` |

Teslimatın açılmış görünümü:

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

Yalnızca `src/` klasörlerini kopyalamayın: provider'lar `config/`, `database/migrations/` ve `src/Resources/` yollarını göreli olarak kullanır. Hedef klasörler büyük harfle başlasa da PHP namespace'leri `Nema\Core`, `Nema\Laravel`, `Nema\Bagisto` olarak kalır.

ZIP'e `reference/legacy-nema`, `.git`, `.env`, veritabanı yedekleri, gerçek lisans anahtarları, private signing key, `vendor`, `node_modules` veya yerel çalışma verileri eklenmez. Platform kökündeki `composer.json`, müşterinin Bagisto `composer.json` dosyasının yerine konulmaz.

## 4. Mevcut Bagisto'ya kaynak koduyla kurulum

Bu yöntemde `composer require` çalıştırılmaz; Packagist veya özel Composer deposundan Nema indirilmez. Bagisto'nun mevcut Composer kurulumu sınıfları yüklemek için kullanılmaya devam eder. Terminal erişimi gerekir.

### 4.1. Ön hazırlık ve dosyaları kopyalama

Bagisto'nun çalışır durumda olması ve yukarıdaki PHP/Laravel gereksinimlerini karşılaması gerekir. Dosya ve veritabanı yedeği alın; ilk denemeyi test ortamında yapın. ZIP içindeki `packages/OnlyMlm` klasörünü Bagisto kökündeki `packages/` altına kopyalayın.

### 4.2. Autoload eşlemeleri

Bagisto kökündeki `composer.json` dosyasının mevcut `autoload.psr-4` nesnesine şu üç kaydı ekleyin. Mevcut App, Database ve Webkul kayıtlarını koruyun:

```json
{
    "Nema\\Core\\": "packages/OnlyMlm/Core/src/",
    "Nema\\Laravel\\": "packages/OnlyMlm/Laravel/src/",
    "Nema\\Bagisto\\": "packages/OnlyMlm/Bagisto/src/"
}
```

Bu blok, `autoload.psr-4` içine birleştirilecek kayıtlardır; dosyanın tamamı değildir. Alt paketlerin `composer.json` dosyalarının klasörde bulunması, bu manuel yöntemde bağımlılıkları kurmaz veya provider keşfini kendiliğinden çalıştırmaz. Laravel sürümü gibi gereksinimler elle kontrol edilmelidir.

### 4.3. Servis sağlayıcılarını kaydetme

Bagisto'nun `bootstrap/providers.php` dosyasındaki mevcut `return [...]` listesinin sonuna, Webkul provider'larından sonra şu iki sınıfı sırayla ekleyin:

```php
Nema\Laravel\Providers\NemaServiceProvider::class,
Nema\Bagisto\Providers\NemaBagistoServiceProvider::class,
```

Core katmanının servis sağlayıcısı yoktur. Mevcut Nema modelleri Laravel Eloquent modelleridir; Nema için `config/concord.php` içine `ModuleServiceProvider` eklenmez. Önceki bir Composer kurulumundan otomatik keşfedilen Nema ile manuel kopyayı aynı kurulumda birleştirmeyin; tek kurulum yöntemi kullanın. Mevcut yerel Composer kurulumunu dönüştürmek ayrıca bağımlılık/lock dosyası geçişi gerektirir ve bu belgenin yeni kurulum adımlarından ayrıdır.

### 4.4. Autoload ve veritabanı kurulumu

Aşağıdaki komutları müşterinin Bagisto kökünde çalıştırın:

```bash
composer dump-autoload
php artisan optimize:clear
php artisan nema:install --sync-customers
php artisan nema:doctor
php artisan route:list --name=nema
```

`nema:install`:

- `nema-config` ve `nema-bagisto-config` etiketleriyle yapılandırmaları yayımlar; mevcut dosyaların üzerine yazmaz.
- Laravel `migrate` komutunu çalıştırır. Bu işlem sadece Nema'ya değil, uygulamadaki tüm bekleyen migration'lara uygulanır.
- Migration'larla Nema tabloları ve Bagisto ürün puanı alanları oluşturulur.
- Ürün puanı çevirilerini mevcut locale kayıtlarıyla eşitler.
- `--sync-customers` verildiğinde mevcut Bagisto müşterilerini Nema üyelerine aktarır; sponsor ve binary yerleşimlerini kendiliğinden oluşturmaz.

Canlı ortamda bekleyen migration'ları inceleyip yedek aldıktan sonra:

```bash
php artisan nema:install --force --sync-customers
```

Migration'lar önceden çalıştırıldıysa yalnızca yapılandırma/üye eşitlemesi için:

```bash
php artisan nema:install --no-migrate --sync-customers
```

## 5. Yapılandırma ve lisans

Kurulumdan sonra Bagisto `config/nema.php` ve `config/nema-bagisto.php` dosyalarını kullanır. Kaynak varsayılanları paketlerin `config/` klasörlerindedir.

Temel ortam değişkenleri:

```dotenv
NEMA_PLAN_VERSION=1
NEMA_CV_MAX_LEVELS=10
```

Lisanslı dağıtımda aşağıdaki alanları satıcının verdiği gerçek değerlerle doldurun:

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

Kaynak yapılandırmada lisans denetimi varsayılan olarak kapalıdır; satış paketinin lisans politikası buna göre hazırlanmalıdır. Etkin denetim Ed25519 imzalı belgeyi doğrular; istemciye yalnızca public key verilir. Ulaşılamayan sunucu için cache kullanım süresi imzalı belgedeki `grace_until` ile sınırlıdır. Route middleware'i lisans durumuna ve özellik yetkilerine göre erişimi denetler; lisanssız GET erişimi tüm özelliklerin açık olduğu anlamına gelmez. Lisans ekranı yönetim panelindeki Nema bölümündedir.

Mevcut lisans komutları kendi lisans API'sine yöneliktir. Codester satın alma kodunu doğrulayan hazır bir entegrasyon olduğu bu belgeden çıkarılmamalıdır; satın alma kodu ile Nema lisans anahtarı eşleştirmesi ayrıca tasarlanmalıdır.

## 6. Bagisto entegrasyonunun çalışma şekli

### Kimlik ve ağ

- Tenant kimliği `channel:{id}`, üye kimliği `customer:{id}` biçimindedir.
- `customer.create.after` olayı müşteri kaydını Nema üyesiyle eşitler.
- Kayıt formuna sponsor alanı view render eventiyle eklenir.
- `customer.registration.before`, `sponsor_code` veya oturumdaki referral kodunu doğrular. Tenant'ta henüz Nema üyesi yoksa ilk kayıt sponsorsuz açılabilir; sonraki kayıtlarda geçerli sponsor gerekir.
- `customer.registration.after` doğrulanmış sponsoru atar. Bu işlem binary sol/sağ yerleşimini otomatik yapmaz.
- Davet bağlantısı `/nema/join/{code}` biçimindedir.

### Sipariş, puan ve paket

| Bagisto olayı | Nema işlemi |
| --- | --- |
| `checkout.order.orderitem.save.after` | Sipariş kalemi puan snapshot'ı |
| `sales.order.update-status.after` | Uygun durumda PV/CV ve paket yeterlilik işlemleri |
| `sales.order.cancel.after` | Puan ters kayıtları ve paket iptali |
| `sales.refund.save.after` | Puan iade ters kayıtları |

Varsayılan uygun sipariş durumları `processing` ve `completed` değerleridir. Ürünlerde `nema_pv` ve `nema_cv` kullanılır. PV alıcıya, CV yapılandırılan üst hat sınırına kadar sponsor ağına işlenir. İade/iptal puanları özgün snapshot üzerinden ters çevrilir. Ürün ailelerine puan alanlarının eklenmesi migration'larda yapılır; sonradan oluşturulan ailelerde alanların bulunduğu ayrıca kontrol edilmelidir.

### Ekranlar, yetkiler ve temalar

Provider; admin/müşteri menülerini, ACL kayıtlarını, route'ları, `nema-bagisto` view/çeviri namespace'ini ve profil view composer'ını yükler. `shop` view namespace'ine paket içindeki override klasörünü ekler. Bu entegrasyon için Bagisto çekirdek dosyalarını elle değiştirmek gerekmez.

- Admin giriş noktası: `/{admin_url}/nema`; `admin_url`, `config('app.admin_url')` değeridir.
- Müşteri özeti: `/customer/account/nema`.
- Ağ ve puan ekranları: `/nema/mlm`, `/nema/mlm_points`, `/nema/binary`, `/nema/binary_points`.
- Kariyer ekranı: `/nema/career`.

Özel tema kullanılıyorsa kayıt formunun ilgili view render eventini çağırdığı ve müşteri ekranlarının paket override'larıyla uyumlu olduğu kontrol edilmelidir. Alt admin rollerine Nema ACL yetkileri atanmalıdır. Mevcut Bagisto asset dosyaları değiştirilmeden kurulum yapılır; kaynak kodunu kopyalamak tek başına bir frontend build işlemi gerektirmez.

### Finans kapsamı

Nema; ağ, puan, paket, kariyer ve dönemsel binary sonuçlarını üretir. Mevcut `nema.features.income` değeri `false` olup cüzdan, para transferi, komisyon ödemesi veya muhasebe sistemi kurulmaz. Finans entegrasyonu için kalıcı `nema_domain_events` outbox'ı ve README'deki event tüketim sözleşmesi kullanılmalıdır. Satış açıklaması bu kapsamla uyumlu olmalıdır.

## 7. Kurulum doğrulaması ve sorun giderme

`nema:doctor` temel yapılandırma ve tabloları kontrol eder; tüm iş akışlarının uçtan uca doğrulandığını göstermez. İlk kurulumda test ortamında şu kontroller yapılmalıdır:

1. Admin ve müşteri menüleri açılır; yetkisiz kullanıcı diğer üyenin kayıtlarına erişemez.
2. Mevcut müşterilerin Nema üyeleri oluşur; tekrar eşitlemede kopya üyeler oluşmaz.
3. İlk üye, sponsorlu kayıt ve referral bağlantısı beklenen şekilde çalışır.
4. Ürün PV/CV alanları görünür; uygun siparişte puan oluşur, tekrar tetiklemede mükerrer puan oluşmaz.
5. Kısmi iade ve iptal doğru puan ters kayıtları üretir.
6. Binary yerleşim, paket ve kariyer ekranları beklenen tenant kapsamında çalışır.
7. Lisanslı pakette geçerli/geçersiz lisans ve lisans özelliklerine göre erişim doğrulanır.

Canlı ortamın temel kontrolü:

```bash
php artisan nema:doctor --production
```

Bu kontrol `APP_ENV=production`, `APP_DEBUG=false`, HTTPS `APP_URL` ve `sync` dışında queue bağlantısı bekler. Queue kullanılıyorsa worker süreçleri dağıtım düzenine göre yönetilmelidir.

| Belirti | Kontrol |
| --- | --- |
| `Class Nema... not found` | Üç PSR-4 yolu, klasör harfleri ve `composer dump-autoload` |
| `nema` Artisan komutları bulunamıyor | İki provider'ın sırası ve `bootstrap/providers.php` kayıtları |
| Nema tabloları yok | Migration çıktısı ve doğru veritabanı bağlantısı |
| Menü veya ayarlar görünmüyor | `optimize:clear`, admin ACL, yayımlanmış config ve lisans özellikleri |
| Kayıtta sponsor hatası | Aynı tenant'a ait geçerli referral kodu ve mevcut üye durumu |
| Puan oluşmuyor | Müşteri eşleşmesi, ürün PV/CV değerleri, uygun sipariş durumu ve event akışı |
| Sodium fonksiyonu bulunamıyor | Lisans doğrulamasını çalıştıran PHP ortamında Sodium uzantısı |

## 8. Güncelleme ve satışa hazırlık durumu

Güncellemede önce dosya/veritabanı yedeği alın, yeni üç paket klasörünü birlikte güncelleyin, autoload/cache temizliğini ve bekleyen migration incelemesini tekrarlayın. Yayımlanmış config dosyaları kurulum komutuyla ezilmez; yeni varsayılanlar bu dosyalara gözden geçirilerek aktarılmalıdır. Lisanslı kurulumda lisans durumu da tekrar kontrol edilmelidir.

## 9. Demo verileri (isteğe bağlı)

Bagisto ve Nema kurulumu bittikten sonra demo veritabanında, Bagisto kök dizininden çalıştırın:

```bash
php artisan nema:demo-seed --with-products --with-careers --force
```

35 demo müşteri, sponsor/binary ağları, 70 örnek PV/CV kaydı, beş demo kariyer ve görselleriyle PV/CV değerlerini içeren 25 ürün oluşturur. Varsayılan kişi, kariyer ve ürün adları İngilizcedir. Tekrar çalıştırıldığında eski Türkçe kişi/kariyer adları çevrilir; şifreler, puan kayıtları ve özel kişi/kariyer adları korunur. Ürün komutu demo ürünlerini SKU üzerinden içerik ve stok dahil günceller; yalnızca demo katalogda kullanın.

Lider e-postası terminalde gösterilir (kanal ID 1 için: demo.c1.member1@example.test). Şifre yalnızca lider ilk oluşturulduğunda gösterilir; mevcut şifreler korunur. Sipariş, ödeme veya paket ataması oluşturulmaz.

Birden fazla kanalda birleşik komut yerine aşağıdaki kanal kodlu komutu kullanın. Ürünler ayrı eklenir ve her zaman ilk kanala gider; hedef demo mağazayı kontrol edin.

```bash
php artisan nema:demo-seed --channel=default --with-careers --force
php artisan nema:demo-products add
```
