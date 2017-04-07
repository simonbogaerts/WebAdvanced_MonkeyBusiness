laravel:

Stap 1

- composer create-project --prefer-dist laravel/laravel blog


-ERROR: 
- php.ini-development veranderen naar php.ini
- uit commentaar zetten
	- extension=php_openssl.dll
	- extension=php_mbstring.dll
    - extension_dir = "ext"

Als het niet zou werken om u laravel te kunnen runnen volg stap 2

Stap 2:

cmd:
in root directory zitten.
php artisan key:generate
