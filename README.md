# LaraSlim

LaraSlim is a slim 3 application that works out of the box with some extra enhancements.
- Eloquent
- Whoops
- Respect
- UtilPHP
- More to come soon..

## How to install

To install **LaraSlim** you need to run the following command in your projects folder.
`$ composer create-project --no-interaction --stability=dev akrabat/slim3-skeleton my-app`

This will create a new folder called `my-app` in your projects folder.

## Just a website, howto
I will create a few examples on how you can create a website with slim 3, These will come at a later time.

## Working with eloquent.
If you are new to eloquent I would highly recommend to take a look through the [laravel eloquent documentaition](https://laravel.com/docs/5.3/eloquent).
To get fully understanding I would suggest to read everything from the **database** section and the **Eloquent ORM** section.

## Debugging
I turned on whoops automatically but when you use this package on a live server I would suggest to turn of whoops, This is because whoops wil show a part of your code when you get an error.
This can be done by changing the `debug` value from `true` to `false` in the following file : `/base/config/config.php`.

I also include the `utilphp` package for a easy way to debug data.
For example you may want to use `util::var_dump($data)` or `utilphp::force_download($filename, $content);`

## Validation
Validation is done with `Respect` please take a look at the [respect validation documentation website](http://respect.github.io/Validation/).

## Translations
This application does not come with translation support in it standard.
You can take a look at the following [blog post](https://helgesverre.com/blog/i18n-slim-framework-translation-twig/).
