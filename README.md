
<h1 align="center"> Laravel Nullable</h1>

<h2  align="center">Do not let "null" to impersonate your objects.</h2>
   
<p align="center">
<img src="https://user-images.githubusercontent.com/6961695/63855847-9524ef00-c9b5-11e9-92dc-9e5232741199.png"/>
   

   
<a href="https://github.styleci.io/repos/198048918" rel="nofollow"><img src="https://camo.githubusercontent.com/eb20fd626fa8b25bb725cb77f91779c724bc48ad/68747470733a2f2f6769746875622e7374796c6563692e696f2f7265706f732f3139383034383931382f736869656c643f6272616e63683d616e616c797369732d586b33453479" alt="StyleCI" data-canonical-src="https://github.styleci.io/repos/198048918/shield?branch=analysis-Xk3E4y" style="max-width:100%;"></a>
<a href="https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable" rel="nofollow"><img src="https://camo.githubusercontent.com/41bca3726697592f356f1e789d37997aac201519/68747470733a2f2f696d672e736869656c64732e696f2f7363727574696e697a65722f672f696d616e676861666f6f7269312f6c61726176656c2d6e756c6c61626c652e7376673f7374796c653d666c61742d737175617265" alt="Quality Score" data-canonical-src="https://img.shields.io/scrutinizer/g/imanghafoori1/laravel-nullable.svg?style=flat-square" style="max-width:100%;"></a>
<a href="https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/?branch=master" rel="nofollow"><img src="https://camo.githubusercontent.com/1eeff0bf14f35448520631b23321844d90dbe986/68747470733a2f2f7363727574696e697a65722d63692e636f6d2f672f696d616e676861666f6f7269312f6c61726176656c2d6e756c6c61626c652f6261646765732f636f7665726167652e706e673f623d6d6173746572" alt="Code Coverage" data-canonical-src="https://scrutinizer-ci.com/g/imanghafoori1/laravel-nullable/badges/coverage.png?b=master" style="max-width:100%;"></a>
<a href="https://travis-ci.org/imanghafoori1/laravel-nullable" rel="nofollow"><img src="https://camo.githubusercontent.com/af8075aac34f51b9bb627143545f00bb247b44d4/68747470733a2f2f7472617669732d63692e6f72672f696d616e676861666f6f7269312f6c61726176656c2d6e756c6c61626c652e7376673f6272616e63683d6d6173746572" alt="Build Status" data-canonical-src="https://travis-ci.org/imanghafoori1/laravel-nullable.svg?branch=master" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/imanghafoori/laravel-nullable" rel="nofollow"><img src="https://camo.githubusercontent.com/ad783a174a9a32fc6415825c41eb8d631f43c82e/68747470733a2f2f706f7365722e707567782e6f72672f696d616e676861666f6f72692f6c61726176656c2d6e756c6c61626c652f762f737461626c65" alt="Latest Stable Version" data-canonical-src="https://poser.pugx.org/imanghafoori/laravel-nullable/v/stable" style="max-width:100%;"></a>
<a target="_blank" rel="noopener noreferrer" href="https://camo.githubusercontent.com/53867af7105346d348a9fce0d888c67ff4498262/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f7068702d762f6469706c6f646f636b65722f636f6d6d656e74732d6c6f616465722e7376673f636f6c6f723d386139326262266c6f676f3d706870266c6f676f436f6c6f723d666666"><img src="https://camo.githubusercontent.com/53867af7105346d348a9fce0d888c67ff4498262/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f7068702d762f6469706c6f646f636b65722f636f6d6d656e74732d6c6f616465722e7376673f636f6c6f723d386139326262266c6f676f3d706870266c6f676f436f6c6f723d666666" alt="PHP from Packagist" data-canonical-src="https://img.shields.io/packagist/php-v/diplodocker/comments-loader.svg?color=8a92bb&amp;logo=php&amp;logoColor=fff" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/imanghafoori/laravel-anypass" rel="nofollow"><img src="https://camo.githubusercontent.com/c80bc97504e609e27ff81f3fa18c7c500104a7aa/68747470733a2f2f706f7365722e707567782e6f72672f696d616e676861666f6f72692f6c61726176656c2d616e79706173732f6c6963656e7365" alt="License" data-canonical-src="https://poser.pugx.org/imanghafoori/laravel-anypass/license" style="max-width:100%;"></a></p>

### Functional programming paradigm in laravel

#### Built with :heart: for every smart laravel developer


`Null` is usually used to represent a missing value (for ex when we can't find a row with a partcular Id we return null)
And that is the BAD IDEA, we are going to kill off !!!


### :fire: Installation:

```
composer require imanghafoori/laravel-nullable
```

This package exposes a `nullable()` global helper function with which you can wrap variables which sometimes are object and sometimes `null`.

Consider this:

```php

$email = TwitterApi::find(1)->email;

```

Now this code is working fine But...

What if the user with ID of 1 gets deleted in future ?!

```null->email ```  and crap ! :anguished:

So if you forget to handle the null with an if statement, you will have errors.

You need something to FORCE you and the users of your class methods to handle the `null` cases.

To prevent such errors, you should code like this:

```php
$user = $twitterApi->find($id);

if ($user === null) {
    return redirect()->route('page_not_found');
}

```

#### :arrow_forward: Nullables to rescue !!!

To refactor the code above, first

You have to change your repo class :

```php

// the old way:

/**
* @return User|null            <---- consider here. We are returning two types !!!
*/
public function find ($id) {
     $user = TwitterApi::search($id);
     
     if (!$user) {
         return null;
     }
     return new User($user);   
}
```
The above code returns 2 types, and That is the source of confusion for method callers.
They get ready for one type, and forget about the other.

Let's do a small change to it:

```php
/**
 * @return Nullable        <---- we now have only one consistent type. Not two.
 */
public function find ($id) {
     $user = TwitterApi::search($id);
     
     if (!$user) {
         return new Nullable(null);   //  <----  instead of pure null;
     }
     $user = new User($user);   
     
     $message = 'Model Not Found with Id : '. $id;

     return new Nullable($user, [$message]);   //  <----  instead of User;
}
```

:bell: **Now our method consistently returns Nullable objects, no matter what :)** 

After this change, no one can have access to the real meat of your repo (in this case User object) unless he/she gives a way to handle the `null` case. 
No `if(is_null())` is required, No exception handling is required.

Remember PHP does not force us to write that if, and we as humen always tend to forget it.


And that makes a differnce ! Before it was easy to forget, but it is impossible to continue if you forget !!!

```php

$userObj = $userRepo->find($id)->getOrSend(function ($message) {

  return redirect()->route('page_not_found')->with('error', $message);
});

// Call a static method.
$userObj = $twitterApi->find($id)->getOrSend([Response::class, 'pageNotFound']);

// or a get default value
$userObj = $twitterApi->find($id)->getOr(new User());


```

Now we are sure $user is not null and we can sleep better at night !

#### :arrow_forward: Testing:

An other advantage is that, if you use nullable and you forget to write a test that simulates the situations where null values are returned, phpunit code coverage highlights the closure you have passed to the `->getOrDo()` (or similar methods) as none-covered, indicating that there is a missing test.

but if you return the object directly, you can get 100% code coverage without having a test covering nully situations, hence hidden errors may still lurk you at 100% coverage.

#### :arrow_forward: Q & A :

#### Why throwing exceptions is not always the best idea?!

When you throw an exception you should always ask your self. Is there any body out there to catch it ??
What if they forget to catch and handle the exception ?! It is the same issue as the `null`.
It cases error.

The point is to give no way to continue, if they forget to handle the failures.


## More from the author:

###  Laravel middlewarize (new*)

:gem: You can put middleware on any method calls.

- https://github.com/imanghafoori1/laravel-middlewarize

-----------

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

-------------

### 🍌 Reward me a crypto-banana 🍌
So that I will have energy to start the next package for you.

- Dodge Coin: DJEZr6GJ4Vx37LGF3zSng711AFZzmJTouN
- LiteCoin: ltc1q82gnjkend684c5hvprg95fnja0ktjdfrhcu4c4
- BitCoin: bc1q53dys3jkv0h4vhl88yqhqzyujvk35x8wad7uf9
- Ripple: rJwrb2v1TR6rAHRWwcYvNZxjDN2bYpYXhZ
- Etherium: 0xa4898246820bbC8f677A97C2B73e6DBB9510151e
