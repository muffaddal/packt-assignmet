## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

The Technical Test has been completed. I simply achieved it by creating a Laravel Application and writing a simple Artisan Command that runs in two cases: 
1. URLs
2. Words.

The User can decide whether they need the scrabble score for the complete URL or just for one word. Depending upon the input, if the URL is a valid one it will extract the text from the URL and calculate the scrabble score for the complete text.

Things Used - Laravel Framework, Goose Client Library to Extract Text from the URL, Scrabble Points.

How to use : 

Clone the repo in your local machine from github.

Run the following command: 

```./vendor/bin/sail up```

This will start a docker env. Once everything is set up run the following artisan command: 

```php artisan scrabble:score```

The  Scrabble Score for the URL mentioned in the test seems to be this : 6215540. (https://www.gutenberg.org/cache/epub/100/pg100.txt?)
