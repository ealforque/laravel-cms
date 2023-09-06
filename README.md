# **Laravel REST Contact Mgmt Test**

## Stack

> Laravel 9  
> Docker

## Design Patterns

> Domain Driven Design  
> Repository & Service Layer Design Pattern  
> Offset and Cursor Pagination implemented

## Prerequisites

> PHP  
> Docker

## Setup

> **step 1: Clone the repository:**  
> `git clone `

> **step 2: Copy environment example and fill with correct environment values:**  
> `cp .env.example .env`

> **step 3: Build docker containers:**  
> `docker-compose build --no-cache`

> **step 4: Start docker containers:**  
> `docker-compose up` _(with console logging)_  
> `docker-compose up -d` _(without console logging)_

> **step 5: Execute migrations and seeders:**  
> `docker-compose exec -T app php artisan migrate:fresh --seed`

> **step 6: Change permissions on nginx storage:**  
> `docker-compose exec -T nginx chmod -R 777 /var/www/html/storage`

> **step 7: Generate application key:**  
> `docker exec -it <container_name> bash`  
> `php artisan key:generate`

> **optional: Recreate docker containers:**  
> `docker-compose up --force-recreate` _(with console logging)_  
> `docker-compose up -d --force-recreate` _(without console logging)_

> **Accessing to application & phpmyadmin locally:**  
> application: `localhost:8080`  
> phpmyadmin: `localhost:81`

## Important:

> **Before pushing to git, always create your own branch, run CS Fixer and unit tests, then create a pull request for your changes:**  
> `./vendor/bin/php-cs-fixer fix --allow-risky=yes --verbose --show-progress=dots --config=.php-cs-fixer.php`  
> `php artisan test --coverage` _(to run all tests)_
