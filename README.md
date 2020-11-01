Queliwrap, PHP QueryList Wrapper.
==============================================

Queliwrap is a wrapper that provides easy helper functions
around PHP popular web scrapper, 
[QueryList](https://github.com/jae-jae/QueryList) and 
[Guzwrap](https://github.com/ahmard/guzwrap).


## Installation

Make sure you have composer installed
[Composer](http://getcomposer.org).

If you don't have Composer run the below command
```bash
curl -sS https://getcomposer.org/installer | php
```

Now, let's install Queliwrap:

```bash
composer require ahmard/queliwrap
```

Now update composer libraries to match current latest releases.

 ```bash
composer update
 ```

After installing, require Composer's autoloader in your code:

```php
require 'vendor/autoload.php';
```

## Note
We use [Guzwrap](https://github.com/ahmard/guzwrap) in the following examples.
You might want to dig a little deeper in to it.


## Usage
```php
use Queliwrap\Client;

Client::get('https://google.com')->exec()
    ->find('ul')->eq(0)
    ->find('li');
```
Handle errors using promise's otherwise method
```php
use Queliwrap\Client;
try {
    Client::get('https://google.com')->exec()
        ->find('ul')->eq(0)
        ->find('li');
}catch (Throwable $exception){
    echo $exception->getMessage();
}
```

### Submit Form
```php
use Guzwrap\Core\Post;
use Queliwrap\Client;

Client::post(function(Post $post){
    $post->url('http://localhost:8080/rand/guzwrap.php');
    $post->field('name', 'Jane Doe');
    $post->file('image', 'C:\1.jpg');
});
```

## Documentations
- [QueryList](https://github.com/jae-jae/QueryList)
- [Guzwrap](http://github.com/ahmard/guzwrap)
- [Guzzle](http://guzzlephp.org/)
