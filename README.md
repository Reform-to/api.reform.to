# Reform to Lithium

Basic Lithium App to store pledges from Reform.to.

## Installation

Grab the code:

    git clone git@git.fabricatorz.com:reform-to-lithium
    git submodule init
    git submodule update

Lithium comes with an `li3` console command that we have to make available. Add
something like the follwoing to your `~/.bash_profile` file:

    PATH=$PATH:/path/to/reform-to-lithium/libraries/lithium/console

Alternatively, install Lithium as a local library:

Install Lithium:

    git clone https://github.com/UnionOfRAD/lithium.git /usr/local/lib/lithium

Then edit your `~/.bash_profile` file:

    PATH=$PATH:/usr/local/lib/lithium/console

## Setup

Make the resources folder writeable:

    chmod -R 0777 app/resources

Create a new database user:

    CREATE USER 'USER'@'localhost' IDENTIFIED BY 'PASSWORD';

Create the database:

    CREATE DATABASE production DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
    GRANT ALL PRIVILEGES ON production.* TO 'USER'@'localhost';

Rename the connections-sample.php file to connections.php:

  cp app/config/bootstrap/connections-sample.php app/config/bootstrap/connections.php

Edit your new connections.php file, and fill in the access details for your databases.

Run the migrations:

    li3 migrate up

## Testing

In order to do development and run the tests you must also set up a development
database and install SQLite3.

Add this line to the Apache virtual host file:

    SetEnv LITHIUM_ENVIRONMENT "development"

Install SQLite:

    sudo apt-get install sqlite3 libsqlite3-dev
    sudo apt-get install php5-sqlite
    sudo service apache2 restart