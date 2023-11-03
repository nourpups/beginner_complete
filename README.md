
# Installation

`git clone https://github.com/nourpups/beginner_complete.git`

`cd beginner_complete`

`docker compose up -d`

`docker compose run --rm composer install`

`docker compose run --rm artisan key:generate`

## Set database settings

 `cp .env.example .env`

`DB_HOST=db`

`DB_DATABASE=crm_db`

`DB_USERNAME=root`

`DB_PASSWORD=root`

## Migrations & Seeders

`docker compose run --rm artisan migrate`

`docker compose run --rm artisan db:seed`

## Login credentials
- Email: welCUM2dm@gmail.com
- Password: nouracea

## Make Storage files accessible
.env: `FILESYSTEM_DISK=public`
### Make storage:link inside app container

`docker exec -it crm_app bash`

`php artisan storage:link`

`exit`
    
## Final! Running on local server

`docker compose run --rm npm install`

`docker compose run --rm npm run build`

You can now access the application at [http://localhost:8876](http://localhost:8876)
