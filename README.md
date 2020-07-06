Queliwrap, PHP QueryList Wrapper.
==============================================

Queliwrap is a wrapper that provides easy helper functions
around PHP popular web scrapper, 
[QueryList](https://github.com/jae-jae/QueryList)
and [Guzwrap](https://github.com/ahmard/guzwrap).

# Notice
This library is totally different from version 1.
There won't be an easy solution for users upgrading from version 1 except rewritting their scripts.
This happens because we chose to use Guzwrap for making requests which provides much much easier interface for sending requests,
Guzwrap uses promises as its return value.
Appologies.

# Installation

Make sure that you have composer installed
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

# Note
We use [Guzwrap](https://github.com/ahmard/guzwrap) in the followimg examples.
You might want to dig a little deeper in to it.


# Usage
```php
use Queliwrap\Client;

Client::request(function($g){
    $g->get('https://google.com');
})->then(function($ql){
    $lists = $ql->find('ul')->eq(0)
        ->find('li');
});
```
Handle errors using promise's otherwise method
```php

Client::request(function($g){
    $g->get('https://google.com');
})
->then(function($ql){
    $lists = $ql->find('ul')->eq(0)
        ->find('li');
})
->otherwise(function($e){
    echo $e->getMessage();
});
```

# Submit Form
```php
Client::request(function($g){
    $g->post(function($req){
        $req->url('http://localhost:8080/rand/guzwrap.php');
        $req->field('name', 'Jane Doe');
        $req->file('image', 'C:\1.jpg');
    });
});
```

# Documentations
- [QueryList](https://github.com/jae-jae/QueryList)
- [Guzzle](http://guzzlephp.org/)
- [Guzwrap](http://github.com/ahmard/guzwrap)
