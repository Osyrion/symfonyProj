User registration project
=============
(Windows)

## Requirements:
- Composer
- MySQL/MariaDB 
- Symfony (downloadable from: http://symfony.com/download)
- web browser or API client like Postman (downloadable from https://www.postman.com/downloads/)

## Install:

If needed:
```
composer require symfony/runtime
```

Start your MySQL/MariaDB, and then run this in command line:
```
php bin/console doctrine:database:create
```

Database testDB is now created! Now, migrate table schema to testDB and create table:
```
php bin/console doctrine:migrations:migrate
```

Finally, start server with this command:
```
symfony server:start --no-tls
```

If All done, project is available on:
```
http://localhost:8000/api/user
```
