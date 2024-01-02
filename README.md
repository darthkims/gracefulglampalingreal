# First-time Installation

1. Run the following commands to install the dependencies:

```
composer install
```

```
npm install
```

2.  Make sure you have a `.env` file in your project root. If not, run this command to copy `.env.example` to `.env`.

```
cp .env.example .env
```

3.  Then, run to generate the app key.

```
php artisan key:generate
```

4. Run the following command to migrate all tables and seed the database with basic data

```
php artisan migrate:fresh --seed
```

# Login as Admin

1. Go to the login page by navigating to `/sign-in`.
2. Use the following credentials. User can insert either email or username:
    - **Email / Username:** admin@material.com (email) / admin (username)
    - **Password:** secret
3. For user role admin, the system will redirect to the admin panel.

# PHP Location

1. sidebar = rsrc>views>cmp>nvb>sidebar.php
2. dashboard = rsrc>views>dsbrd>index.php
3. sign in = rsrc>views>ssions>create.php
4. sign up = rsrc>views>rgstr>create.php
5. setting in dashboard = rsrc>views>cmp>plugins.php
6. navbar = rsrc>views>cmp>nvbrs>nv>
7. footer = rsrc>views>cmp>footers
8. letak gambar = public>assets>img
