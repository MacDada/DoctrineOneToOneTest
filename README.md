DoctrineOneToOneTest
====================

A Symfony project created on May 22, 2015, 10:10 pm.

------

# Install

1. clone it
2. `composer install`
3. configure `./app/parameters.yml`
3. `./app/console doctrine:database:create`
4. `./app/console doctrine:schema:update --dump-sql --force`
5. `./app/console doctrine:schema:validate`

# Run tests

`bin/phpunit -c app`

# See files

* `src/AppBundle/Entity/User.php`
* `src/AppBundle/Entity/UserProfile.php`
* `src/AppBundle/Tests/UserAndProfilePersistanceTest.php`

# See branches

* `master`
* `manual_persist1`
* `manual_persist2`
