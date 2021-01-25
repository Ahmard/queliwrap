Queliwrap.
==============================================

Queliwrap is a wrapper that provides easy helper functions around PHP popular web scrapper,
[QueryList](https://github.com/jae-jae/QueryList) and
[Guzwrap](https://github.com/ahmard/guzwrap).

**Notice:** **_Queliwrap\Wrapper\Queliwrap::exec()_** method has been replaced with **_execute()_**. exec() now returns
**psr-7** compliant object while execute() returns **QueryList** object.

## Installation

Make sure you have [Composer](http://getcomposer.org) installed.

```bash
composer require ahmard/queliwrap
```

After installation is done, require Composer's autoloader in your code:

```php
require 'vendor/autoload.php';
```

## Usage
**Queliwrap relies on [Guzwrap](https://github.com/ahmard/guzwrap), you might want to dig a little deeper in
to it**.

```php
use Queliwrap\Client;

Client::get('https://google.com')->execute()
    ->find('ul')->eq(0)
    ->find('li');
```

Handle errors
```php
use Queliwrap\Client;

try {
    $text = Client::get('https://google.com')->execute()
        ->find('ul')->eq(0)
        ->find('li')
        ->text();
        
    echo $text;
}catch (Throwable $exception){
    echo $exception->getMessage();
}
```

### Submit Form

```php
use Guzwrap\Wrapper\Form;
use Queliwrap\Client;

Client::post(function(Form $form){
    $form->action('http://localhost:8080/rand/guzwrap.php');
    $form->field('name', 'Jane Doe');
    $form->file('image', 'C:\1.jpg');
});
```

### Cookies

Thanks to [Guzwrap](https://github.com/Ahmard/guzwrap) cookies can be preserved across multiple requests

```php
use Guzwrap\Wrapper\Form;
use Queliwrap\Client;

//Login
Client::create()
    ->referer('http://localhost:8000')
    ->withSharedCookie()
    ->form(function (Form $form){
        $form->action('http://localhost:8000/login');
        $form->method('POST');
        $form->input('email', 'queliwrap@example.com');
        $form->input('password', 1234);
        $form->input('remember_me', 1);
    })->exec();

//View user profile
$queryList = Client::create()
    ->get('http://localhost:8000/users/view')
    ->query(['id' => 2])
    ->withSharedCookie()
    ->execute();

//Find user info
$firstName = $queryList->find('.profile')
    ->find('list-group-item')
    ->eq(0)
    ->text();

echo "First name: {$firstName}";
```

## Documentations

- [QueryList](https://github.com/jae-jae/QueryList)
- [Guzwrap](http://github.com/ahmard/guzwrap)
- [Guzzle](http://guzzlephp.org/)

## Licence
Queliwrap is **MIT** licenced.