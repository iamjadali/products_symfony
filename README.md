#Task-1:Build a RESTful API using Symfony
#Symfony Project Development
#Deliverables-1: (Updated on gitHub-Repository:https://github.com/iamjadali/products_symfony)
#Deliverable-1.1:Code: (Uploaded on gitHub-Repository:https://github.com/iamjadali/products_symfony)
API endpoints have implemented with appropriate controllers, services, and repository classes.
#Deliverable-1.2:Testing: (Uploaded on gitHub-Repository:https://github.com/iamjadali/products_symfony)
PHPUnit tests for the API endpoints have written and tested(passed) successfully.

#Documentation: 
#Setup Process(Prerequisites):
Ensure the following software is installed:
=>PHP (8.2)
=> MySQL (8.0)
=> Composer (dependency management for PHP)
=> Symfony CLI (Symfony command-line tool)

#Setting Up Symfony Project:
=> Install Dependencies: composer install

#Create a new Symfony project:
=> composer create-project symfony/skeleton products_symfony
#Set Environment Variables(database, development)
Database connection details, API keys, etc., typically stored in .env file.
=> cd products_symfony
#Database Setup(Run this command): 
php bin/console doctrine:database:create
#Note: Please create a database with name: products_symfony

#Install required packages(Run these commands):
composer require api platform/api-pack
composer require doctrine/doctrine-bundle
composer require symfony/security-bundle
composer require lexik/jwt-authentication-bundle
composer require symfony/validator
composer require symfony/form
composer require sensio/framework-extra-bundle

# Configure Doctrine ORM
=> Create the Product Entity:(src/Entity/User.php)
=> Create the User Entity:(src/Entity/User.php)
#Create the repository:
=> Create the Product Repository:(src/Repository/ProductRepository.php)
=> Create the User Repository:(src/Repository/UserRepository.php) 

#Configure JWT Authentication:
=> Configure Lexik JWT Authentication Bundle
=> Generate SSL keys:(private.pem, public.pem)
=> Configure security(config/packages/security.yaml)
=> Create the Authenticator:(src/Security/LoginFormAuthenticator.php)
=> Register the Authenticator as a Service:(config/services.yaml)

#Run Doctrine migrations(Run these commands):
php bin/console make:migration
php bin/console doctrine:migrations:migrate
=> Two tables generated(User, Product)

#Create API Endpoints:
=> Create the Product Controller: (src/Controller/Api/ProductController.php)
#Create the Login Route and Controller:
=> /api/login (config/routes.yaml)
=> Create the Authenticator: (src/Security/LoginFormAuthenticator.php)

#Start Your Symfony Server(Run this command):
symfony server:start 
OR
php -S localhost:8000 -t public

#Create and Test Users:
=> CreateUserCommand:(src/Command/CreateUserCommand.php)
=> Register the Command:(config/services.yaml)
#Test the Command(Run this command to create test user on command-line):
php bin/console app:create-user user@example.com password

#Testing: Write PHPUnit tests for the API endpoints:
#PHPUnit Tests:
#Install PHPUnit(Run this command):
composer require --dev phpunit/phpunit

=> Create Test Cases:(tests/Controller/Api/ProductControllerTest.php)

#Run the Tests(Run this command):
php bin/phpunit

#Note-1: Please create a database with name: products_symfony_test
#Note-2: For 5th-Test-Case(Delete a product), must pass an id which exists in db, otherwise test will be failed.
#Note-2: 5 Tests will be run against APIs Endpoints.
------------------------------------------------------------------------------

#Task-2:Docker Configuration (Dockerize the Symfony Application)
#Deliverables:
#Deliverable-2.1:
Docker Configuration: Provide the Dockerfile and docker-compose.yml files.
#(Dockerfile and docker-compose.yml files exists in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony)

#Deliverable-2.2:
#Documentation:
#Instructions on how to Build and Run the Docker Containers:

#Prerequisites: Docker should be installed on host machine.

#Step-1:Start the Docker Service(Run this command):
sudo systemctl start docker
OR
sudo systemctl enable docker

#Step-2:Verify Docker is Running(Run this command):
sudo systemctl status docker

#Step-3:Build and Start Your Docker Containers(Run this command):
docker-compose up --build
#To run the containers in the background (detached mode), add the -d option(Run this command):
docker-compose up -d


#Step-1: Create the Project Directory Structure:
/var/www/html/products_symfony
│
├── Dockerfile
├── docker-compose.yml
├── .env
├── public
│   └── index.php
├── src
│   └── ...
├── config
│   └── ...
├── var
│   └── ...
├── vendor
│   └── ...
└── ...

#Step-2:Create a Dockerfile file:(in the root of your project directory)
#Note:(Dockerfile files exist in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony) 

#Step-3:Create a Docker Compose File:
#Note:(docker-compose.yml file exist in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony)

#Step-4:Create an Environment File:
In .env File:(root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony)
APP_ENV=dev
APP_SECRET=your_secret_key
DATABASE_URL=mysql://symfony_user:symfony_password@db:3306/symfony_db

#Step-5:Build and Run the Containers:
#5.1:Build the Docker images and start the containers(Run this command):
docker-compose up --build
#5.2:Access Your Symfony application:
=> Symfony application should be accessible at http://localhost:9000.
=> phpMyAdmin should be accessible at http://localhost:8080.

#Containers Related Commands:
#Build and start containers(Run this command):
docker-compose up --build

#Stop containers(Run this command):
docker-compose down

#Check running containers(Run this command):
docker-compose ps

#Clear Docker Resources(Run this command):
docker system prune -a --volumes

#Check Logs for any Errors(Run this command):
docker-compose logs app
docker-compose logs db
docker-compose logs phpmyadmin

#To List all running containers(Run this command):
docker ps

#To List all Containers, including Stopped ones:
docker ps -a

#Inspecting Container Details(Run this command):
docker inspect <container_id_or_name>

#Accessing Container Data on Linux(Run this command):
cd /var/lib/docker/containers
ls

#Using Docker Commands to Manage Containers:
#Stop a container(Run this command):
docker stop <container_id_or_name>

#Start a container(Run this command):
docker start <container_id_or_name>

#Remove a container(Run this command):
docker rm <container_id_or_name>

#Force remove a container(Run this command):
docker rm -f <container_id_or_name>

------------------------------------------------------------------------------

#Task-3: Integrate Static Code Analysis(Static Code Analysis)
#Deliverables:
#Deliverable-1:(phpstan.neon file exists in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony)
#Documentation:
#Guide to Correct phpstan.neon Configuration:
#Install PHPStan Symfony Extension(Run this command):
composer require --dev phpstan/phpstan-symfony

#Create a Simple phpstan.neon Configuration File(in root directory):
includes:
    - vendor/phpstan/phpstan-symfony/extension.neon
    - vendor/phpstan/phpstan-symfony/rules.neon

parameters:
    level: max
    paths:
        - src
        - tests
    symfony:
        container_xml_path: var/cache/dev/App_KernelDevDebugContainer.xml
    tmpDir: var/cache/phpstan

#Run PHPStan(Run this command):
vendor/bin/phpstan analyse

#Deliverable-2:Analysis Results:
=> Showing 4 Errors with Level:5 
=> Most Error Types: e.g: Property App\Entity\User::$id has no type specified.
=> Showing 40 Errors with Level:max(8) 
=> Most Error Types: e.g: Property App\Entity\User::$id has no type specified.



------------------------------------------------------------------------------

#Task-4:Document
#Deliverables:(README.md file exists in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony))
#Documentation:

#4.1.1:Architecture Overview
#Symfony Framework
Symfony is a PHP web application framework known for its flexibility and robustness in building web applications. Key components include:
#Routing: 
Defines URL endpoints and maps them to controllers.
#Controllers: 
Handles incoming requests and returns responses.
#Doctrine ORM: 
Object-Relational Mapping for database interactions.
#Security: 
Provides authentication and authorization mechanisms.
#Serializer: 
Converts between objects and JSON/XML representations.
#Dependency Injection: 
Manages dependencies and services.

#4.1.2:REST API Architecture:
#Endpoints: 
Define CRUD operations for products (GET, POST, PUT, DELETE).
#Serialization: 
Convert entities (e.g., Product) to JSON responses.
#Validation: 
Ensure data integrity using Symfony validation constraints.
#Authentication/Authorization: 
Implement JWT authentication for secure API access.

#4.1.2:Assumptions Made During Development:
#Environment:
 Assumes development on Symfony 5.x with PHP 7.4 or higher.
#Database: 
Assumes MySQL as the database.
#Security: 
JWT tokens used for API authentication.
#Testing: 
Assumes PHPUnit for unit and functional testing.

#4.2:Test Product Endpoints on Postman:
#Note:(Products-Symfony-Rest-APIs.postman_collection.json file exists in root directory on gitHub-Repository:https://github.com/iamjadali/products_symfony))
#4.2:API Documentation
#Endpoints: 
List GET, POST, PUT, DELETE endpoints for products.
#Parameters: 
Request/response parameters are in JSON format.
#Authentication: 
JWT-Token usage for authentication.
#Error Handling: 
Errors are handled with status codes(e.g. 200, 201 etc.) passing in json responses.


#4.3:Authenticate and Obtain JWT Token Endpoint:
URL: http://localhost:8000/api/login
Method: POST
Content-Type: application/json
in postman Body tab, select raw, and enter the JSON payload:
{
    "email": "amjad@gmail.com",
    "password": "12345678"
}
=> Response: JWT-Token will return

#4.4:Product-Module Rest-API Endpoints:
    - `#Method:GET | URL:http://localhost:8000/api/products` - List all products.
    - `#Method:POST | URL:http://localhost:8000/api/products` - Create a new product.
    - `#Method:GET | URL:http://localhost:8000/api/products/{id}` - Get details of a single product.
    - `#Method:PUT | URL:http://localhost:8000/api/products/{id}` - Update an existing product.
    - `#Method:DELETE | URL:http://localhost:8000/api/products/{id}` - Delete a product.
#Example to Create a Product:
#Endpoint: 
POST http://localhost:8000/api/products/
#Request Body: 
{
  "name": "Product Name",
  "description": "Product Description",
  "price": "97.56"
}
#Response:
{
  "id": 1,
  "name": "Product Name",
  "description": "Product Description",
  "price": "97.56"
}
   
    
#Note: For each Endpoint, JWT-token is must for authorization.
So first you have to logged-in(by using email & password) to get this token, then you need to pass
it for other all APIs in header section.Frontend developer need to pass this token as with prefix: [Bearer(space) JWT-token] 

#4.3:Additional Notes:
Project setup instrunctions and process documentation has covered in above 
#1st-task documentation topic: #Symfony Project Setup Instructions.
#Note: Please send raw data in json format.
#I used command-line to create a user to generate JWT-token.
------------------------------------------------------------------------------
