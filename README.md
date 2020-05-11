Universal Education API Client
======================

PHP client for connecting to the UniversalEducation V1 REST API.

Requirements
------------

- PHP 5.6 or greater
- cUrl extension enabled

**To connect to the API auth you need the following:**

- Secure URL pointing to a UniversalEducation
- API key for the user

Installation
------------

Use the following Composer command to install the
API client from [the UniversalEducation vendor on Packagist](https://packagist.org/packages/UniversalEducation/api):

~~~shell
 $ composer require UniversalEducation/api
 $ composer update
~~~

You can also install composer for your specific project by running the following in the library folder.

~~~shell
 $ curl -sS https://getcomposer.org/installer | php
 $ php composer.phar install
 $ composer install
~~~

Namespace
---------

All the examples below assume the `UniversalEducation\Api\Client` class is imported
into the scope with the following namespace declaration:

~~~php
use UniversalEducation\Api\Client as UniversalEducation;
~~~

Configuration
-------------

To use the API client in your PHP code, ensure that you can access `UniversalEducation\Api`
in your autoload path (using Composer’s `vendor/autoload.php` hook is recommended).

Provide your credentials to the static configuration hook to prepare the API client
for connecting to a store on the UniversalEducation platform:

Auth
----

~~~php
UniversalEducation::configure(array(
    'api_key' => 'd81aada4xc34xx3e18f0xxxx7f36ca'
    'is_dev' => false //use true for test api
));
~~~

Accessing collections and resources (GET)
-----------------------------------------

To list all the resources in a collection:

~~~php
$classes = UniversalEducation::getClasses('email');

foreach ($classes as $cl) {
    echo $cl->token;
}
~~~

To access a single resource and its connected sub-resources:

~~~php
$product = UniversalEducation::getProduct(11);

echo $product->name;
echo $product->price;
~~~

To view the total count of resources in a collection:

~~~php
$count = UniversalEducation::getProductsCount();

echo $count;
~~~

Updating existing resources (PUT)
---------------------------------

To update a resource by passing an array or stdClass object of fields
you want to change to the global update method:

~~~php
$fields = array(
    "nick_name"  => "MacBook Air",
    "email" => "john.doe@example.com",
);

UniversalEducation::updateUser($fields);
~~~

Creating new resources (POST)
-----------------------------

Some resources support creation of new items by posting to the collection. This
can be done by passing an array or stdClass object representing the new
resource to the global create method:

~~~php
$fields = array(
    "last_name" => "Doe",
    "first_name" => "John",
    "password" => "Apple",
    "email" => "john.doe@example.com",
);

UniversalEducation::createUser($fields);
~~~

You can also create a resource by making a new instance of the resource class
and calling the create method once you have set the fields you want to save:

~~~php
$user = new UniversalEducation\Api\Resources\User();

$user->last_name = "Doe";
$user->first_name = "John";
$user->password = "Apple";
$user->email = "john.doe@example.com";
$user->create();
~~~

Handling Errors And Timeouts
----------------------------

For whatever reason, the HTTP requests at the heart of the API may not always
succeed.

Every method will return false if an error occurred, and you should always
check for this before acting on the results of the method call.

In some cases, you may also need to check the reason why the request failed.
This would most often be when you tried to save some data that did not validate
correctly.

~~~php
$user = UniversalEducation::getUser();

if (!$orders) {
    $error = UniversalEducation::getLastError();
    echo $error->code;
    echo $error->message;
}
~~~

Returning false on errors, and using error objects to provide context is good
for writing quick scripts but is not the most robust solution for larger and
more long-term applications.

An alternative approach to error handling is to configure the API client to
throw exceptions when errors occur. Bear in mind, that if you do this, you will
need to catch and handle the exception in code yourself. The exception throwing
behavior of the client is controlled using the failOnError method:

~~~php
UniversalEducation::failOnError();

try {
    $orders = UniversalEducation::getOrders();

} catch(UniversalEducation\Api\Error $error) {
    echo $error->getCode();
    echo $error->getMessage();
}
~~~

The exceptions thrown are subclasses of Error, representing
client errors and server errors. The API documentation for response codes
contains a list of all the possible error conditions the client may encounter.

Verifying SSL certificates
--------------------------

By default, the client will attempt to verify the SSL certificate used by the
UniversalEducation store. In cases where this is undesirable, or where an unsigned
certificate is being used, you can turn off this behavior using the verifyPeer
switch, which will disable certificate checking on all subsequent requests:

~~~php
UniversalEducation::verifyPeer(false);
~~~

Connecting through a proxy server
---------------------------------

In cases where you need to connect to the API through a proxy server, you may
need to configure the client to recognize this. Provide the URL of the proxy
server and (optionally) a port to the useProxy method:

~~~php
UniversalEducation::useProxy("http://proxy.example.com", 81);
~~~
