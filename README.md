#  Laravel Nullable

Do not let any `null` to walk in your code...

[![StyleCI](https://github.styleci.io/repos/198048918/shield?branch=analysis-Xk3E4y)](https://github.styleci.io/repos/198048918)
<a href="https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable"><img src="https://img.shields.io/scrutinizer/g/imanghafoori1/laravel-nullable.svg?style=flat-square" alt="Quality Score"></img></a>
[![Code Coverage](https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/?branch=master)
[![Build Status](https://travis-ci.org/imanghafoori1/laravel-nullable.svg?branch=master)](https://travis-ci.org/imanghafoori1/laravel-nullable)
[![Latest Stable Version](https://poser.pugx.org/imanghafoori/laravel-nullable/v/stable)](https://packagist.org/packages/imanghafoori/laravel-nullable)
[![License](https://poser.pugx.org/imanghafoori/laravel-anypass/license)](https://packagist.org/packages/imanghafoori/laravel-anypass)


### Functional paradigm in laravel

#### Built with :heart: for every smart laravel developer


`Null` is usually used to represent a missing value, (ex when we can't find a table row with a partcular Id.)
And that is the BAD IDEA, we are going to kill off !!!


### installation:

```
composer require imanghafoori/laravel-nullable
```

This package exposes a `nullable()` global helper function with which you can wrap variables which most of the times are objects but suddenly become `null`.

Consider this:

```php

$email = User::find(1)->email;

```

What if the user with ID of 1 gets deleted in future ?!

```null->email ```  and crap !

So if you forget to handle the null with an if statement, you will have errors.

You need something to force you and the users of your class methods to handle the `null` cases.

To prevent such errors, you should code like this:

```php
$user = $userRepo->find($id);

if ($user === null) {
    return redirect()->route('page_not_found');
}

```

## Nullables to rescue !!!

To refactor the code above, first

You have to change your repo class :

```php
// old :
public function find ($id) {
     $user = User::find($id);
     
     return $user;         <--- you return  User|null :(
}
```
The above code returns 2 types, and That is the source of confusion for method callers.
They get ready for one type, and forget about the other.

Let's do a small change to it:
```php

public function find ($id) {
     $user = User::find($id);
   
     return nullable($user);   <--- you return only Nullable objects !
}
```
Now it Only returns a single Nullable type, no matter what :)

After this change, no one can have access to the real meat of your repo (in this case User object) unless he/she gives a way to handle the `null` case. 
No `if(is_null())` is required, No exception handling is required.

Remember PHP does not force us to write that if, and we as humen always tend to forget it.


And that makes a differnce ! Before it was easy to forget, but it is impossible to continue if you forget !!!

```php

$userObj = $userRepo->find($id)->getOrSend(function () {
  return redirect()->route('page_not_found');
});

// Call a static method.
$userObj = $userRepo->find($id)->getOrSend([Response::class, 'pageNotFound']);

// or a get default value
$userObj = $userRepo->find($id)->getOr(new User());


```

Now we are sure $user is not null and we can sleep better at night !



### Q & A :

#### Why throwing exceptions is not a good idea ?

When you throw an exception you should always ask your self. Is there any body out there to catch it ??
What if they forget to catch and handle the exception ?! It is the same issue as the `null`.
It cases error.

The point is to give no way to continue, if they forget to handle the failures.


### More from the authors:


### Laravel Hey Man

:gem: It allows to write expressive code to authorize, validate and authenticate.

- https://github.com/imanghafoori1/laravel-heyman


------------

### Laravel Terminator


 :gem: A minimal yet powerful package to give you opportunity to refactor your controllers.

- https://github.com/imanghafoori1/laravel-terminator


------------

### Laravel AnyPass

:gem: It allows you login with any password in local environment only.

- https://github.com/imanghafoori1/laravel-anypass

------------

### Eloquent Relativity

:gem: It allows you to decouple your eloquent models to reach a modular structure

- https://github.com/imanghafoori1/eloquent-relativity
