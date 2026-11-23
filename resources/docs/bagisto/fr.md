# OnlyMLM / Nema — Installation Bagisto et intégration actuelle

[English](setup.en.md) · [Türkçe](setup.tr.md) · [Русский](setup.ru.md) · [Français](setup.fr.md) · [Español](setup.es.md)

Document préparé le 23 novembre 2026 à partir des copies de travail de `nema-platform` et `onlyMlmBagisto`. Le produit distribué sur des plateformes comme Codester comprend les sources Nema à copier dans un projet Bagisto existant. L’application Bagisto complète ne fait pas partie du ZIP commercial.

## 1. Versions actuelles et prérequis

| Composant | Version actuelle / prérequis | Source |
| --- | --- | --- |
| onlyMlmBagisto | Bagisto `2.4.x-dev` | `onlyMlmBagisto/packages/Webkul/Core/src/Core.php`, `BAGISTO_VERSION` |
| Laravel | Version verrouillée `v12.67.0` ; minimum Nema `12.61` | `composer.lock` de Bagisto, fichiers `composer.json` de Nema |
| PHP | Nema `^8.3`, Bagisto `>=8.2 <8.5` ; plage commune : PHP 8.3 et 8.4 | Fichiers `composer.json` respectifs |
| Base de données | MySQL 8 ou MariaDB compatible | `README.tr.md` |
| Nema Core | `sryyabey/nema-core`, `dev-main` | `packages/core/composer.json`, `composer.lock` de Bagisto |
| Nema Laravel | `sryyabey/nema-laravel`, `dev-main` | `packages/laravel/composer.json`, `composer.lock` de Bagisto |
| Nema Bagisto | `sryyabey/nema-bagisto`, `dev-main` | `packages/bagisto/composer.json`, `composer.lock` de Bagisto |
| Vérification de licence | Extension PHP Sodium requise si activée | `packages/laravel/src/Licensing/LicenseDocumentVerifier.php` |

HEAD lors de l’examen : nema-platform `34db1fd`, onlyMlmBagisto `74e25dd`. Des modifications non commitées existaient ; ces identifiants ne suffisent donc pas à identifier tout le code décrit. Aucune version commerciale Nema telle que `1.0.0` n’est déclarée ici. `2.4.x-dev` n’est pas une version stable précise de Bagisto ; toute autre version doit être vérifiée séparément.

## 2. Intégration de développement actuelle

Les projets se trouvent actuellement côte à côte :

```text
onlyMlm/
├── nema-platform/
│   └── packages/
│       ├── core/
│       ├── laravel/
│       └── bagisto/
└── onlyMlmBagisto/
```

Connexion Nema actuelle dans `onlyMlmBagisto/composer.json` :

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

Il s’agit uniquement de l’extrait concernant Nema. Conservez les autres dépendances et dépôts Bagisto. L’adaptateur Bagisto dépend de Core et Laravel. Les deux fournisseurs de services Nema sont découverts automatiquement via `extra.laravel.providers` ; le fichier Bagisto `bootstrap/providers.php` actuel ne contient aucune inscription Nema supplémentaire.

Cette organisation avec dossier voisin et liens symboliques sert au développement. L’installation client par copie est décrite ci-dessous. L’ajout de cette documentation n’a pas converti les dépôts existants.

## 3. Structure du ZIP commercial

Copiez intégralement les trois paquets sans modifier leur structure interne :

| Source nema-platform | Destination dans le projet Bagisto du client |
| --- | --- |
| `packages/core/` | `packages/OnlyMlm/Core/` |
| `packages/laravel/` | `packages/OnlyMlm/Laravel/` |
| `packages/bagisto/` | `packages/OnlyMlm/Bagisto/` |

Structure après extraction :

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

Ne copiez pas uniquement `src/` : les fournisseurs utilisent des chemins relatifs vers `config/`, `database/migrations/` et `src/Resources/`. Les dossiers cibles commencent par une majuscule, mais les espaces de noms PHP restent `Nema\Core`, `Nema\Laravel` et `Nema\Bagisto`.

Excluez `reference/legacy-nema`, `.git`, `.env`, les sauvegardes de base de données, les vraies clés de licence, les clés privées de signature, `vendor`, `node_modules` et les données locales d’exécution. Le `composer.json` racine de la plateforme ne remplace pas celui du projet Bagisto client.

## 4. Installation des sources dans un projet Bagisto existant

Aucun `composer require` n’est nécessaire et aucun paquet Nema n’est téléchargé depuis Packagist ou un dépôt Composer privé. Composer reste utilisé pour le chargement automatique des classes Bagisto. Un accès au terminal est requis.

### 4.1. Préparation et copie

Utilisez un Bagisto opérationnel respectant les prérequis PHP/Laravel. Sauvegardez les fichiers et la base de données et commencez dans un environnement de test. Copiez le dossier `packages/OnlyMlm` du ZIP dans le dossier `packages/` de Bagisto.

### 4.2. Correspondances autoload

Ajoutez ces trois entrées à l’objet `autoload.psr-4` existant du `composer.json` racine de Bagisto. Conservez les entrées App, Database et Webkul :

```json
{
    "Nema\\Core\\": "packages/OnlyMlm/Core/src/",
    "Nema\\Laravel\\": "packages/OnlyMlm/Laravel/src/",
    "Nema\\Bagisto\\": "packages/OnlyMlm/Bagisto/src/"
}
```

Ce bloc est un extrait à fusionner, pas le fichier complet. La présence des fichiers `composer.json` des sous-paquets n’installe aucune dépendance et ne déclenche pas leur découverte automatique dans cette méthode manuelle. Vérifiez vous-même les prérequis, notamment la version Laravel.

### 4.3. Inscription des fournisseurs de services

Ajoutez ces classes dans cet ordre à la fin de la liste `return [...]` de `bootstrap/providers.php`, après les fournisseurs Webkul :

```php
Nema\Laravel\Providers\NemaServiceProvider::class,
Nema\Bagisto\Providers\NemaBagistoServiceProvider::class,
```

Core n’a pas de fournisseur de services. Les modèles Nema actuels utilisent Eloquent ; n’ajoutez aucun `ModuleServiceProvider` Nema à `config/concord.php`. Ne combinez pas une installation Composer découverte automatiquement avec une copie manuelle de Nema. Convertir l’installation Composer locale existante demande aussi une migration des dépendances et du fichier lock, distincte de cette nouvelle installation.

### 4.4. Autoload et base de données

Exécutez à la racine du projet Bagisto client :

```bash
composer dump-autoload
php artisan optimize:clear
php artisan nema:install --sync-customers
php artisan nema:doctor
php artisan route:list --name=nema
```

`nema:install` :

- Publie les configurations avec les balises `nema-config` et `nema-bagisto-config`, sans écraser les fichiers existants.
- Lance Laravel `migrate`, qui applique toutes les migrations en attente de l’application, pas seulement celles de Nema.
- Crée les tables Nema et les attributs de points des produits Bagisto via les migrations.
- Synchronise les traductions des points avec les langues existantes.
- Avec `--sync-customers`, importe les clients existants comme membres Nema sans créer automatiquement leurs relations de parrainage ou leurs placements binaires.

En production, examinez les migrations en attente et sauvegardez avant d’exécuter :

```bash
php artisan nema:install --force --sync-customers
```

Si les migrations ont déjà été exécutées, publiez les configurations et synchronisez les membres sans migration :

```bash
php artisan nema:install --no-migrate --sync-customers
```

## 5. Configuration et licences

Après installation, Bagisto utilise `config/nema.php` et `config/nema-bagisto.php`. Les valeurs sources par défaut sont dans les dossiers `config/` des paquets.

Variables d’environnement de base :

```dotenv
NEMA_PLAN_VERSION=1
NEMA_CV_MAX_LEVELS=10
```

Pour une distribution sous licence, remplacez les valeurs fictives par celles fournies par le vendeur :

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

Le contrôle de licence est désactivé par défaut dans la configuration source ; préparez la politique du produit en conséquence. Lorsqu’il est activé, il vérifie un document signé Ed25519. Seule la clé publique est distribuée au client. Si le serveur est inaccessible, le cache ne reste utilisable que dans la période `grace_until` du document signé. Le middleware contrôle l’état de la licence et les droits fonctionnels ; un accès GET sans licence valide ne donne pas accès à toutes les fonctions. L’écran de licence est dans la rubrique Nema de l’administration.

Ces commandes utilisent l’API de licence du produit. Elles ne constituent pas une intégration prête à l’emploi de vérification des codes d’achat Codester. La correspondance entre code d’achat et clé Nema doit être conçue séparément.

## 6. Fonctionnement de l’intégration Bagisto

### Identité et réseaux

- L’identifiant du tenant suit `channel:{id}` et celui du membre `customer:{id}`.
- `customer.create.after` synchronise le client avec son membre Nema.
- Un événement de rendu ajoute le champ de parrain à l’inscription.
- `customer.registration.before` valide `sponsor_code` ou le code de parrainage en session. Si le tenant ne possède aucun membre Nema, la première inscription peut être sans parrain ; les suivantes exigent un parrain valide.
- `customer.registration.after` affecte le parrain validé, sans placement automatique dans l’arbre binaire gauche/droite.
- Les liens de parrainage utilisent `/nema/join/{code}`.

### Commandes, points et forfaits

| Événement Bagisto | Action Nema |
| --- | --- |
| `checkout.order.orderitem.save.after` | Instantané des points de la ligne de commande |
| `sales.order.update-status.after` | Traitement PV/CV et qualification des forfaits pour les statuts admissibles |
| `sales.order.cancel.after` | Contre-écritures de points et annulation des forfaits |
| `sales.refund.save.after` | Contre-écritures des points remboursés |

Les statuts admissibles par défaut sont `processing` et `completed`. Les produits utilisent `nema_pv` et `nema_cv`. Le PV revient à l’acheteur ; le CV remonte la lignée de parrainage jusqu’à la profondeur configurée. Les remboursements/annulations utilisent l’instantané d’origine. Les migrations ajoutent les champs aux familles d’attributs ; vérifiez séparément les familles créées ensuite.

### Écrans, droits et thèmes

Le fournisseur charge les menus administrateur/client, les ACL, les routes, l’espace de noms de vues/traductions `nema-bagisto` et le compositeur de vue du profil. Il ajoute en priorité le dossier de surcharge aux vues `shop`. Aucune modification manuelle du cœur Bagisto n’est requise.

- Administration : `/{admin_url}/nema`, où `admin_url` vaut `config('app.admin_url')`.
- Tableau de bord client : `/customer/account/nema`.
- Réseaux et points : `/nema/mlm`, `/nema/mlm_points`, `/nema/binary`, `/nema/binary_points`.
- Carrière : `/nema/career`.

Pour un thème personnalisé, vérifiez l’appel de l’événement de rendu dans le formulaire d’inscription et la compatibilité des écrans clients avec les surcharges. Accordez les droits ACL Nema aux rôles administrateur limités. L’installation ne modifie pas les assets existants ; la seule copie des sources ne demande pas de compilation frontend.

### Périmètre financier

Nema produit les résultats de réseau, points, forfaits, carrière et calcul binaire périodique. `nema.features.income` vaut actuellement `false`. Aucun portefeuille, transfert d’argent, paiement de commissions ou système comptable n’est installé. Utilisez l’outbox persistante `nema_domain_events` et le contrat de consommation d’événements du README pour les intégrations financières. La description commerciale doit refléter ce périmètre.

## 7. Vérification et dépannage

`nema:doctor` vérifie la configuration de base et les tables, sans valider tous les parcours de bout en bout. Vérifiez en environnement de test :

1. Les menus s’ouvrent et les utilisateurs non autorisés n’accèdent pas aux données d’autres membres.
2. Les clients existants disposent de membres Nema ; une nouvelle synchronisation ne crée pas de doublons.
3. La première inscription, l’inscription parrainée et les liens de parrainage fonctionnent.
4. Les champs PV/CV s’affichent, les commandes admissibles génèrent des points et les événements répétés ne les dupliquent pas.
5. Les remboursements partiels et annulations produisent les contre-écritures attendues.
6. Placement binaire, forfaits et carrières respectent le tenant.
7. Les licences valides/invalides et les droits fonctionnels sont correctement pris en compte.

Contrôle de production de base :

```bash
php artisan nema:doctor --production
```

Il attend `APP_ENV=production`, `APP_DEBUG=false`, une `APP_URL` HTTPS et une connexion de queue différente de `sync`. Gérez les workers selon votre déploiement si vous utilisez les queues.

| Symptôme | Vérification |
| --- | --- |
| `Class Nema... not found` | Trois chemins PSR-4, casse des dossiers et `composer dump-autoload` |
| Commandes Artisan `nema` absentes | Ordre des fournisseurs et inscriptions dans `bootstrap/providers.php` |
| Tables Nema absentes | Résultat des migrations et connexion à la bonne base |
| Menus ou paramètres absents | `optimize:clear`, ACL, configuration publiée et fonctions de licence |
| Erreur de parrain à l’inscription | Code valide du même tenant et état des membres existants |
| Aucun point | Correspondance client, PV/CV des produits, statut et événements |
| Fonction Sodium absente | Extension Sodium dans le PHP qui vérifie la licence |

## 8. Mises à jour et préparation commerciale

Sauvegardez fichiers/base, mettez à jour les trois dossiers ensemble, régénérez l’autoload, videz les caches et examinez les migrations en attente. La commande d’installation n’écrase pas les configurations publiées ; intégrez les nouvelles valeurs par défaut après examen. Revérifiez la licence si elle est activée.

## 9. Données de démonstration (facultatif)

Après installation de Bagisto et Nema, exécutez depuis la racine Bagisto sur une base de démonstration :

```bash
php artisan nema:demo-seed --with-products --with-careers --force
```

Crée 35 clients, les réseaux de parrainage/binaire, 70 écritures PV/CV synthétiques, cinq carrières et 25 produits avec images et valeurs PV/CV. Les libellés sont en anglais. Une nouvelle exécution traduit les anciens noms turcs des clients/carrières en conservant mots de passe, points et noms personnalisés. La commande produits met à jour contenu et stock par SKU ; utilisez uniquement un catalogue de démonstration.

L’adresse du leader apparaît dans le terminal (canal ID 1 : demo.c1.member1@example.test). Son mot de passe apparaît uniquement lors de sa création. Aucun ordre de vente, paiement ou attribution de forfait n’est créé.

Avec plusieurs canaux, utilisez la commande avec code de canal ci-dessous à la place de la commande combinée. Les produits sont ajoutés séparément au premier canal ; vérifiez le canal cible.

```bash
php artisan nema:demo-seed --channel=default --with-careers --force
php artisan nema:demo-products add
```
