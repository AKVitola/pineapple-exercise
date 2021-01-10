# Project description

I made this exercise as a test for a junior web developer position.

### I had previous experience working with:

- HTML5
- CSS3
- JS

### Before this project, I haven't worked with:

- PHP
- OOP
- MVC
- MySQL
- ajax
- jQuery
- icon fonts

**What would I have done differently:** used MVC pattern from the start for a cleaner code structure.
**What I would like to fix:** the routs so they don't show the file extension at the end.

## Setting up project

To work with this project locally you have to have PHP and a local server.

In order to work with db you have to create a file called db_config.php in the config folder. I have created a sample file. **Copy the example file, rename it, and replace the database credentials.**

### Run the following queries in db

> CREATE DATABASE `pineapple` /_!40100 DEFAULT CHARACTER SET utf8 _/

> CREATE TABLE `subscriptions` (
> `id` int(11) NOT NULL AUTO_INCREMENT,
> `email` varchar(100) NOT NULL,
> `provider` varchar(50) NOT NULL,
> `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
> PRIMARY KEY (`id`),
> KEY `provider_index` (`provider`)
> ) ENGINE=MyISAM AUTO_INCREMENT=282 DEFAULT CHARSET=utf8

### Routes for all project pages:

- /index.php
- /success.php
- /subscribers.php _(Contains a table with all subscribers. It is possible to search by email, filter by provider, and sort by date and email.)_
