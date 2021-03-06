# Laravel CMS

This project can  be used for the generation of a content management system and includes the front-end for a car enthusiast community. The project includes functionality such as: user profiles, articles and commenting, a photo gallery, real-time messaging and conversations with PusherJS.

Users can be configured as administrators and accept/deny articles which are posted to the system. These articles will display on the homepage and are organised in a trending algorithm. Articles with the most views (trending) will display above others on the front page. The same algorithm applies to the photo gallery which shows various photos that users have uploaded.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Prerequisites

What things you need to install the software and how to install them

```
- PHP 5 - http://php.net/downloads.php
- Apache - https://httpd.apache.org/
- MySQL - https://www.mysql.com/downloads/
- Composer - https://getcomposer.org/
```

### Installing

A step by step series of examples that tell you have to get a development env running

Clone the repository and install vendor packages with Composer.

```
composer install
```

Create a MySQL database and import the queries in e30aus.sql in the cloned repository. Migrations were not utilised for the development of the project. (To-do)



Serve the project with the Artisan CLI.

```
php artisan serve
```

The CLI will display the port and URL which the project is accessible on.


## Built With

* [Laravel 4.2](https://laravel.com/docs/4.2) - PHP framework
* [Bootstrap](https://getbootstrap.com/) - Front-end CSS framework
* [PusherJS](https://pusher.com/) - Real-time notification framework

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors/Contributors

* **Joshua Nissenbaum** - Full-Stack Development
* **Jared Duncan** - UI/UX Design

## To-Do List

* **Migrate to Laravel 5.5** as PHP functions from version 5 have been depreciated
* **Code formatting and optimisation** - Bundle HTTP POST requests and format to PSR-2 style 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details