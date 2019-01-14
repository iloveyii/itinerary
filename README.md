HW03
=========

This is a PHP / Yii 2 application to find the shortest path between departure and destination airports using Djikstras algorithm.

![Screenshot](http://itinerary.softhem.se/images/screenshot.png)

# [DEMO](http://itinerary.softhem.se)



INSTALLATION
------------

  * Clone the repository `git clone git@github.com:iloveyii/itinerary.git`.
  * Run composer install `composer install`.
  * Then run composer command `composer dump-autoload`.
  * Init the Yii app `php init`.
  * Create a database (manually for now) and adjust the database credentials in the `common/config/main-local.php` file as per your environment.
  * Run the migration command to create the database table as `./yii migrate`.
  * Point web browser to frontend/web directory or Create a virtual host using [vh](https://github.com/iloveyii/vh) `vh new itinerary -p ~/sportspoll/frontend/web`
  * Browse to [http://itinerary.loc](http://itinerery.loc).
  

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
