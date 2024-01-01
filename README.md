# First time Install

1. Run the following commands to install the dependencies:
```
composer install
```

2. Make sure you have a .env file in your project root. If not, copy the .env.example file and rename it to .env. Then, run:
```
php artisan key:generate
```
3. Run `php artisan migrate:fresh --seed` to create basic users table

# LOGIN AS ADMIN

type `gracefulglam.test/admin`

# PHP Location

1. sidebar = rsrc>views>cmp>nvb>sidebar.php
2. dashboard = rsrc>views>dsbrd>index.php
3. sign in = rsrc>views>ssions>create.php
4. sign up = rsrc>views>rgstr>create.php
5. setting in dashboard = rsrc>views>cmp>plugins.php
6. navbar = rsrc>views>cmp>nvbrs>nv>
7. footer = rsrc>views>cmp>footers
8. letak gambar = public>assets>img
