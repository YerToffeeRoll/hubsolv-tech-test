
<h1>Scenario</h1>

We are an online retailer specialising in technology books. We have a legacy system which
is proving difficult to maintain and currently has no test coverage that we are looking to
replace. We are looking to build a RESTful json API. You have been tasked with developing
a proof of concept that can demonstrate best practices in modern web development with a
focus on designing something which is maintainable and testable.


# Get Started
To install, clone the code.
Run composer install in the root of the project.
Run "php artisan migrate" to craete the tables in the database
Run "php artisan db:seed" to seed the database with books

## Tests
To run the tests. Run "composer test" in the route of the project.

The codebase runs at 100% test coverage.



## API Usage


-register
To use the api your first need to register for an account via the api.
"GET request"
e.g.
api/register/email=test@test.com&password=testpass&name=testuser&c_password=testpass


-login

You will acquire/renew a new API token via the login request.
"GET request"
e.g.
/api/login?email=test@test.com&password=testpass

You will need to add the token to the headers of the request before you will be allowed access to the API.


Get current user details
"POST request"
e.g.
/api/user/details




#books

-Get all books
"GET request"
e.g.
api/book/


-filter books
"GET request"
e.g.
/api/book/filter?author=Robin Nixon&category=PHP


-add books
"POST request"
/api/book/?title=Modern PHP: New Features and Good Practice&author=Josh Lockhart&category=PHP&price=18.99&ISBN=978-1491905013


-get all categories
"GET request"
e.g.
api/categories
