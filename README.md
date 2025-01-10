# Backend Web - Laravel Project
Dit project is een Laravel-gebaseerde webapplicatie waarmee gebruikers hun kledingcollectie kunnen beheren, outfits kunnen genereren en delen, en interactie kunnen hebben met andere gebruikers. Het biedt zowel openbare als admin-functionaliteiten voor een uitgebreide en gebruiksvriendelijke ervaring.

![VScode](https://img.shields.io/badge/VScode-v1.96.2-blue?style=for-the-badge&logo=visual-studio-code&logoColor=white&labelColor=000000)
![Node.js](https://img.shields.io/badge/Node.js-v20.18.1-green?style=for-the-badge&logo=node.js&logoColor=white&labelColor=000000)
![MySQL](https://img.shields.io/badge/MySQL-v8.0.40-yellow?style=for-the-badge&logo=MySQL&logoColor=white&labelColor=000000)
![Laravel](https://img.shields.io/badge/Laravel-v11.36.1-red?style=for-the-badge&logo=Laravel&logoColor=white&labelColor=000000)
![Composer](https://img.shields.io/badge/Composer-v2.7.4-brown?style=for-the-badge&logo=Composer&logoColor=white&labelColor=000000)
![PHP](https://img.shields.io/badge/PHP-v8.2.12-lightblue?style=for-the-badge&logo=PHP&logoColor=white&labelColor=000000)

## Inhoudsopgave

1. [Functionaliteiten](#functionaliteiten)
2. [Installatie](#installatie)
3. [Database opzetten en vullen](#database-opzetten-en-vullen)
4. [Gebruik](#gebruik)
5. [Bronnen](#bronnen)

## Functionaliteiten

- Je kunt kledingstukken toevoegen en verwijderen.
- Outfits laten genereren met wat je al in je kleerkast hebt.
- Outfits delen met andere gebruikers en outfits van anderen bekijken.
- Nieuwsitems liken en erop reageren.
- Berichten sturen naar andere gebruikers.
- Wisselen tussen dark en light mode.
- Via een contactformulier hulp of informatie vragen.
- Admins kunnen:
  - Nieuws toevoegen, aanpassen of verwijderen.
  - Gebruikers handmatig aanmaken.
  - Ingekomen contactformulieren beantwoorden.

## Installatie

1. **Kloon de repository:**

   ```bash
   git clone https://github.com/FirewallFugitive/portfolio2.git
   ```

2. **Installeer afhankelijkheden:**

   ```bash
   cd portfolio2
   composer install
   npm install
   ```

3. **Stel het .env-bestand in:**
   Maak een `.env`-bestand in de rootdirectory en kopieer de inhoud van `.env.example`:

   ```bash
   cp .env.example .env
   ```

4. **Genereer de applicatiesleutel:**

   ```bash
   php artisan key:generate
   ```

5. **Link de storage:**

   ```bash
   php artisan storage:link
   ```

6. **Stel de database in:**
   - Maak een MySQL-database lokaal aan
   - Update de `.env` file met je databasegegevens:
    ```bash
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=backendweb_db
      DB_USERNAME=root
      DB_PASSWORD=yourpassword
    ```
    
7. **Configureer e-mailservice:**
   Update de `.env` file met je e-mailservicegegevens:
    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.office365.com
    MAIL_PORT=587
    MAIL_USERNAME=mail
    MAIL_PASSWORD=oassword
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=mail
    MAIL_FROM_NAME="Your Application Name"
    ```

## Database opzetten en vullen
Migraties uitvoeren:

```bash
php artisan migrate
```
Seed de database:

```bash
php artisan db:seed
```
Admin login:

E-mail: admin@ehb.be
Wachtwoord: Password!321
## Gebruik

1. **Start de ontwikkelserver:**

   ```bash
   php artisan serve
   npm run dev
   ```

2. **Toegang tot de applicatie:**
   Open je browser en ga naar `http://127.0.0.1:8000`.

3. **Admin toegang:**

   - Standaard wordt een admin-gebruiker ge-seed in de database:
     - E-mail: `admin@ehb.be`
     - Wachtwoord: ` Password!321`

4. **Openbare toegang:**

   - Gebruikers kunnen zich registreren of inloggen om toegang te krijgen tot profiel- en nieuwsfunctionaliteiten.

## bronnen
https://dev.to/ashallendesign/13-placeholder-avatar-image-websites-4g03
https://chatgpt.com/share/672a3eaf-d244-800c-9afc-16e64c57c0cf
https://laravel.com/docs/11.x/filesystem
https://stackoverflow.com/questions/20776638/adding-a-birthdate-using-php-to-a-mysql-database
https://laravel.com/docs/11.x/precognition#customizing-validation-rules
https://laracasts.com/discuss/channels/laravel/what-is-the-best-way-to-implement-an-admin-user
https://chatgpt.com/share/674887f4-3518-800c-b2ac-14ddd5ab95e7
