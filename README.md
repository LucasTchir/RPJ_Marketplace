# Marketplace

Laravel marketplace projekt na pridavanie, vyhladavanie a spravu inzeratov.
Aplikacia podporuje pouzivatelske ucty, emailovu verifikaciu, kategorie,
odporucania, sledovanie predajcov, hodnotenia, upozornenia a administracny panel.

## Funkcie

- registracia, prihlasenie, odhlasenie a zmena hesla
- emailova verifikacia pouzivatela
- vytvaranie, uprava a mazanie inzeratov
- nahravanie hlavnej fotky a dalsich obrazkov k inzeratu
- vyhladavanie inzeratov a prehliadanie podla kategorii
- odporucane a blizke inzeraty podla preferencii a polohy
- profily predajcov, sledovanie pouzivatelov a hodnotenia
- upozornenia, spravy o zaujme a nahlasovanie inzeratov
- admin dashboard na spravu pouzivatelov, inzeratov a kategorii

## Technologie

- PHP 8.2+
- Laravel 11
- MySQL
- Blade sablony
- Vite
- Laravel Telescope

## Instalacia

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

V subore `.env` nastav pripojenie k databaze a mail server pre emailovu
verifikaciu. Potom spusti migracie a seedery:

```bash
php artisan migrate --seed
php artisan storage:link
```

Seedery vytvoria zakladne kategorie a administratorsky ucet.

## Spustenie

V jednom terminali spusti Laravel server:

```bash
php artisan serve
```

V druhom terminali spusti Vite:

```bash
npm run dev
```

Aplikacia bude dostupna typicky na adrese `http://127.0.0.1:8000`.

## Poznamky

- Verejne nahravane obrazky sa ukladaju do `storage/app/public`.
- Admin pristup kontroluje middleware `IsAdmin` cez hodnotu `group = admin`.
- Zakladne routes su definovane v `routes/web.php`.
