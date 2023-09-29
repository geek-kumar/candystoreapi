# Candy Store API
Candy Store API is a system to handle the backend data
interaction for consumers (customers) and candy products for a Company, NorthStar,which is running a candy business.


## Installation

Clone the project from the repository.

Install all the necessary package with composer

```bash
  cd my-project
  composer install
  php artisan passport:install  
```
## Enviornment
Create .env file same as .env.example file.
Set database details in .env file.
Create .env.testing for testing Enviornment. 



## API Reference

#### Get all inventory

```http
  GET /api/inventory
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get item

```http
  GET /api/inventory/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch | 


## Set Test Enviornment
 
```bash
  php artisan config:cache --env=testing
```
To run the testcases execute commands.

```bash
  php artisan test
```
## Test Coverage
To run the testcases execute commands.

Note : Install php xdebug to generate coverage report.

```bash
  php artisan test --coverage
```

## Tech Stack

**Client:** Postman

**Framework:** Laravel Framework 10.24.0
**Testing FramewoRK:** phpunit

**Server:** php, apache

**Database:** MySql,Sqlite


## Authors

- [@Kumar Rahul](https://github.com/geek-kumar)

