Test App
========

This app is a solution for recruitment assignment.


## Used technologies

- Vagrant
- Parallels Desktop/Oracle VirtualBox
- Ubuntu
- Apache
- Xdebug
- PHP
- Phalcon
- SASS
- Compass
- Bootstrap


## How it was created

The app based on Phalcon framework and MVC architecture pattern. Application bootstrap file registers only Phalcon services required for building this app.

This app was created in a few following steps:

1. Created PhpStorm project.
2. Initialized Git repository with `.gitignore` file.
3. Created development server environment based on Vagrant and Parallels Desktop. Box with operating system comes from Atlas (https://atlas.hashicorp.com).
4. Created Phalcon catalog structure and bootstrap file.
5. Created Compass project with Bootstrap.
6. Created application prototype using Volt template system and fake data.
7. Created classes to handle resources (JSON-feed, RSS-feed, Varnish log file).
8. Replaced fake data with real data from resources using proper class.
9. Replaced `parallels` with `virtualbox` provider (Vagrant) for better portability development environment.
10. Configured Phalcon for PhpUnit and write unit tests for JsonReader class.

## First configuration

### Virtual domain

Add following line to hosts file (`/etc/hosts` on OS X/Linux or `%SystemRoot%\system32\drivers\etc\hosts` on Windows):

```
127.0.0.1       test-app.dev
```


### Vagrant

Before starting Vagrant, install following software:
- Oracle Virtualbox (https://www.virtualbox.org)
- Vagrant (https://www.vagrantup.com)

Run `vagrant` up or `vagrant up --provider virtualbox` (if VirtualBox isn't default provider) using command line in project's catalog root.


### Run app

In your favourite web browser run `http://test-app.dev:8080`.


### Run unit tests

Because Phalcon is installed only on development server, you must run `phpunit` under Vagrant.

1. Connect to Vagrant by SSH: `vagrant ssh` in project's catalog root.
2. Go to tests directory: `cd /vagrant/tests`.
3. Run PHPUnit: `phpunit`.

## Possible app improvements

- Rendering app view once for all tabs and load data from external resources by AJAX requests for better app performance and for better UX.
- Caching data from external resources like JSON-feed and RSS-feed for better app performance.
- Using resources mockups for unit tests.
- Writing unit tests for reader classes (`RssReader`, `VarnishLogHeader`).
- Replacing Apache server with `Nginx` server and `PHP-FPM`, which provides better performance for PHP applications.
- Building own box for Vagrant with minimum software packages for better performance and optimal use of device resources.
- Replacing shell provisioning script for Vagrant with configuration management solution like `Chef` or `Puppet`. It provides better possibilities for deploying app.