# RestApiFilm

CRUD Rest API

Laravel 5.8 <br>
PHP 7.2.8 <br>
passport:7.5.1 <br>

-copy ".env.example", rename to ".env" (setting database) <br>
-composer install <br>
-php artisan key:generate <br>
-php artisan migrate <br>
-php artisan db:seed <br>
-php artisan passport:install <br>
-php artisan serve <br>

Deskripsi<br>
REST API yang dapat menyimpan data ke dalam database. Ada dua aktor yang digunakan
yaitu admin dan user.<br>

Fitur<br>
- CRUD (create, read, update, delete) film. Operasi create, update dan delete hanya bisa di
akses oleh admin.<br>
- Menampilkan film yang sedang di tayang.<br>
- Menampilkan film yang segera hadir (coming soon).<br>
- User dapat melakukan register dan login menggunakan username.<br>
- User dapat menyimpan film ke dalam daftar favorit.<br>
- User dapat memberikan rating film dari 1 sampai 5.<br>


