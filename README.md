TL;DR: Web application for Web Technologies Course, at Università degli Studi di Ferrara, a.y. 2020-2021.

I made a project management software where a generic company does services for other companies, in particular take trace of the hours that each employee spends on various projects assigned to them, and that can manage two types of users: admin and common user.

I used MVC pattern, where my views are made with blaze (Laravel template engine), the Models are simple php class and then Controllers contains my business logic. For the frontend part I used JavaScript and Ajax to make some asynchronous calls for CRUD. I finally used Bootstrap to style my web app.
This web app is contained in Docker containers so you will need to use the docker-compose up command:
progetto-tecweb_laravel.test_1
progetto-tecweb_phpmyadmin_1
progetto-tecweb_mysql_1

Others useful commands:
php artisan route:cache     to clear the routes cache
php artisan route:list      to display the list of routs
php artisan make:seed --class UserSeeder    for seeding the User class


