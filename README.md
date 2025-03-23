# NYT Best Sellers API

This is a Laravel-based JSON API that acts as a wrapper around the New York Times Best Sellers API. It provides endpoints to fetch best-selling books based on various filters like author, title, ISBN, and more.

---

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Setup](#setup)
3. [Environment Variables](#environment-variables)
4. [Running the Project](#running-the-project)
5. [Running Tests](#running-tests)
6. [Postman Collection](#postman-collection)
7. [API Endpoints](#api-endpoints)

---

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP (>= 8.0)
- Composer
- Laravel (>= 9.x)
- MySQL or any other supported database
- Git

---

## Setup

1. Clone the repository:
git clone [https://github.com/syed-shaheer/NYT.git]
cd nyt-best-sellers-api

2. Install dependencies:
composer install

3. Generate the Laravel application key:
php artisan key:generate


4. Create a `.env` file by copying the `.env.example` file:
cp .env.example .env

5. Update the `.env` file with your database credentials and NYT API key

6. Run migrations to set up the database:
php artisan migrate

## Environment Variables

Update the following variables in the `.env` file:

### Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password


### NYT API Key
NYT_API_KEY=your_nyt_api_key


---

## Running the Project

1. Start the Laravel development server:
php artisan serve

2. The API will be available at:
http://localhost:8000/api/v1


---

## Running Tests

To run the unit and feature tests, use the following command:
php artisan test

Copy

### Test Coverage
- **Unit Tests**: Tests for the repository and service layers.
- **Feature Tests**: Tests for the API endpoints.

---

## Postman Collection

You can find the Postman collection for this API here:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://documenter.getpostman.com/view/14865918/2sAYkHnHSf)

This collection includes examples of valid and invalid requests for all endpoints.

---

## API Endpoints

### Get Best Sellers
- **URL**: `/api/v1/best-sellers`
- **Method**: `GET`
- **Query Parameters**:
  - `author` (optional): Filter by author name.
  - `isbn` (optional): Filter by ISBN(s). Multiple ISBNs can be separated by semicolons.
  - `title` (optional): Filter by book title.
  - `offset` (optional): Pagination offset (must be a multiple of 20).
  - `age-group` (optional): Filter by target age group.

### Example Requests
- Get best sellers by author:
GET /api/v1/best-sellers?author=Stephen+King

- Get best sellers by ISBN:
GET /api/v1/best-sellers?isbn=9780307743657;9780345806789

- Get best sellers with pagination:
GET /api/v1/best-sellers?offset=20


## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Acknowledgments

- [New York Times API](https://developer.nytimes.com/) for providing the Best Sellers data.
- [Laravel](https://laravel.com/) for the awesome PHP framework.
