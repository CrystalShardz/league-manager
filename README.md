#League Manger
##Introduction
League Manager is an easy to use application to aide league administrators to manage their 10 pin bowling league.

League Manager provides the tools to manage:
* Teams
* Players
* Team captains
* Player transfers
* Round Robin tournament generation
* Seasons
* Floating substitutes [ development ]
* Handicaps [ development ]

League Manager is in active development and not all features may currently be available.

##Installing
1. Clone this repository
2. Upload to your web host (or if running locally move to your local web server)
3. Open a terminal and navigate to this repository
4. run the command ``composer install`` to install League Manager, and it's dependencies
5. run the command ```npm i``` to install the front end dependencies
6. Modify the Users seed file (database/seeds/UsersSeed.php) to set yourself a new password for the default administrator account
7. run ``php artisan migrate --seed`` to install the database and seed the users table

You can now login to your website using the email address and password setup in the users seed file.
If you wish to add sample members & teams you can run:
``php artisan db:seed``
