#  laravel nullable

[![Code Coverage](https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/?branch=master)


Functional paradigm in laravel

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

To refactor this case :

First :

You have to change your repo class :

```php
// old :
public function find ($id) {
     $user = User::find($id);
     
     return $user;
}
```

to this:
```php

public function find ($id) {
     $user = User::find($id);
   
     return nullable($user);   <--- you return a nullable !
}
```

Then no one can have access to the real meat of your repo (in this case $user object) unless he/she gives a way to handle the `null` case.

And that makes a differnce ! Before it was easy to forget, but it is impossible to continue if you forget !!!

```php

$userObj = $userRepo->find($id)->getOrSend(function () {
  return redirect()->route('page_not_found');
});

// or
$userObj = $userRepo->find($id)->getOr(new User());


```

Now we are sure $user is not null and we can sleep better at night !

