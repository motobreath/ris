##UC Merced Zend 2 Template

##Installation:
Run git clone https://github.com/motobreath/UC-Merced-Template-V2.git <directory>

Update Submodules:

    git submodule init
    git submodule update

Include a local.php configuration file. Place this file in config/autoload. Sample local.php:

    return array(
        'db' => array(
            'driver'   => 'Pdo',
            'dsn'      => 'mysql:dbname=####;host=####',
            'username' => '####',
            'password' => '####',
            'host' => 'localhost'
        ),
        'ldap'=>array(
            'host'              => '####',
            'username'          => '####',
            'password'          => '####',
            'baseDn'            => '####',
        ),
        "email"=>array(
            "smtp"=>array(
                'name'              => '####',
                'host'              => '####',
                'connection_class'  => 'login',
                'connection_config' => array(
                    'username' => '####',
                    'password' => '####',
                )
            ),
        ),

    );

Note: Not all services are required. Remove each entry in the service manger from Application/Module.php
if not using.


##Hosting:
A web server running php 5.4 is required. Tested on Apache, but other web servers should work just as well.
Point your web server's root to the public folder. Add server variable APPLICATION_ENV=development to take advantage of the configuration options.
In apache vhosts I use:

    SetEnv APPLICATION_ENV development


## Administration Section:
NOTE: Mysql database is required to run admin section.
It is possible to use other databases, just change the local.php configuration file to
change database info.

Run SQL in /data/SQL to create tables

Include local.php in the /config/autoload folder with database connectivity info for your database:

    <?php
    return array(
        'db' => array(
            'dsn'      => 'mysql:dbname=template;host=localhost',
            'username' => 'user',
            'password' => 'pass',
            'host'     => 'localhost'
        ),
    );
    ?>



Don't forget to seed yourself as an admin! Login with your user to generate a userID to generate a userID then run this SQL (Where X=your user ID):

    insert into roles(userID,role) values(X,'admin');
