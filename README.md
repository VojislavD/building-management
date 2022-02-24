# Building Management App
<p><i>Note: App is still in heavy development</i></p>

<img src="https://user-images.githubusercontent.com/23532087/155483837-3d056ca9-6458-42f9-b859-2f1b37b525b7.png" alt="Building Management Image">

<p>Application to manage building with notficiation sending feature.</p>

## Installation
Clone the repository, navigate to project directory and install dependencies
```bash
composer install
```
  
Create a file for environment variables by coping `.env.example`:
```bash
cp .env.example .env
```

Create application key
```bash
php artisan key:generate
```

Setup database credentials in `.env` file and run migrations
```bash
php artisan migrate
```

To seed the database with some test data run
```bash
php artisan db:seed
```

## Testing
```bash
php artisan test
```