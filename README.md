##UC Merced Zend 2 Template

##Installation:
Run git clone https://github.com/motobreath/UC-Merced-Template-V2.git <directory>

Update Submodules:

    git submodule init
    git submodule update



## Administration Section
Create local database

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
