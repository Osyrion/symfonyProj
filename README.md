User registration project
=============


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

### Example:


POST method

```
{
  "email": "example@brno.cz",
  "name": "person",
  "password": "abcd1234",
  "roles": "ROLE_USER"
}
```

GET method

```
http://localhost:8000/api/user/
```
What is returned

```
[
    {
        "id": 1,
        "email": "example@brno.cz",
        "userIdentifier": "example@brno.cz",
        "username": "example@brno.cz",
        "roles": "ROLE_USER",
        "password": "$2y$13$PZgVIVpCF6RNdS8hLmz.auhDpWoTlOSh3QviYfPhFviMAoZKHI8A6",
        "salt": null,
        "name": "person"
    }
]
```

### Troubleshooting:

If you have connection problems with database, check ```.env``` file and update your DB credentials
