# Learner Progress Dashboard - Coding Challenge

<!--Note: I had tried to containerise the app but I ran into issues trying to download packages whilst setting up the image.
Also: I'm running the application on a ARM mac but I ran the commands below and the application worked just fine. -->
## Getting Started
This getting started guide assumes that you have the following installed and are running this on a Linux Ubuntu machine.
### Prerequisities
- PHP version 8.2
- PHP Composer
- NodeJS version 20.12.2 or later

1. Run `composer install`
2. Configure your `.env` file from the example
3. Generate the App Key: `php artisan key:generate`
4. Run migrations and seeders: `php artisan migrate --seed`
5. Install all javascript packages `npm i`
6. Build Javascript Assets `npm run build`
7. Start the development server: `php artisan serve`. The application will be reachable on http://localhost:8000