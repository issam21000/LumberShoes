# ShoesRental

This application was Developed through the module Object Programming for the Web, it was developed by:

- [Mohamed ALHASNE](https://github.com/alhasnecode)
- [Issam MEDJMADJ](https://github.com/issam21000)


On our web site you can check the list of all available shoes or shoes available by shop or the shoes closest to you.
To rent shoes you must first register and log on the website to add and access your bag.

### Install via Composer
- Clone the repository :
```
$ git clone https://github.com/issam21000/lumberjack_rental.git
```
- Execute the command `$ composer update`
- Change MySQL database setting in `config/database.php` file, and then grant the following rights (if you're under Linux) :
```
$ chmod 666 config/database.php
```
- Create a MySQL database with the name you've given in `config/database.php` file, and then create the database schema by executing the following command `$ php migrate` or import directly the file `ShoesRental.sql`
- Start the application on PHP's built-in web server by executing the command `$ php -S localhost:8000`
- Go to URL http://localhost:8000/ to access the application
- Grant rights on the folder `storage/` (under Linux) :
```
$ chmod -R 777 storage
```
