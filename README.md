## Prerequisites  

- PHP ^8.2 (if without Docker)
- Composer
- MySQL 8.0+
- Docker & Docker Compose (if using Docker)


## How to Run Backend (Laravel) Without Docker - Recommended since the frontend has setup according to this base url
1) Clone the repo: git clone https://github.com/charith-lansakara/book-rental-platform-be.git
 - cd book-rental-platform-be

2) Install dependencies:
 - composer install

3) ensure this section is in your .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=book_rental_platform
   DB_USERNAME=root
   DB_PASSWORD=

5) Generate Laravel app key:
 - php artisan key:generate

6) Run migrations & seeders:
 - php artisan migrate --seed

7) Run server:
 - php artisan serve
 - API will be available at: http://127.0.0.1:8000/api




## How to Run Backend with Docker
1) Clone the repo: git clone https://github.com/charith-lansakara/book-rental-platform-be.git
 - cd book-rental-platform-be

2) Install dependencies:
 - composer install

3) Update the .env file's below section for Docker:
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=book_rental_platform
   DB_USERNAME=book_user
   DB_PASSWORD=secret

4) Build and start containers:
 - docker-compose up --build -d

5) Check running containers:
 - docker-compose ps

6) Enter the Laravel container:
 - docker exec -it book_rental_app bash

7) Inside container:
 - php artisan config:clear
 - php artisan config:cache
 - php artisan migrate --seed

8) Done ✅
 - API available at: http://localhost:9000/api
 - phpMyAdmin at: http://localhost:8081

Server: db
User: book_user
Password: secret

9) To stop containers:
 - docker-compose down

10) To stop and delete DB data:
 - docker-compose down -v