# Task Management API

This is a Task Management API built with Laravel. It allows users to manage their tasks (CRUD operations) and handle authentication using Laravel Sanctum.

## Table of Contents
1. [Features](#features)
2. [Project Setup](#project-setup)
3. [Running the Project Locally](#running-the-project-locally)
4. [API Documentation](#api-documentation)
    - [Authentication](#authentication)
    - [Task Management](#task-management)
5. [Assumptions and Design Decisions](#assumptions-and-design-decisions)

---

## Features
- User authentication (login/logout) via API tokens (Laravel Sanctum).
- Task CRUD operations (Create, Read, Update, Delete) for authenticated users.
- Secure API routes protected by middleware.

---

## Project Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/task-management-api.git
    ```

2. **Install dependencies**:
   Navigate to the project folder and install dependencies using Composer.
    ```bash
    cd task-management-api
    composer install
    ```

3. **Set up your environment**:
   Copy the `.env.example` file to `.env` and configure the database and other settings.
    ```bash
    cp .env.example .env
    ```

   Then, generate the application key:
    ```bash
    php artisan key:generate
    ```

4. **Run database migrations**:
   Make sure your database is up and running, then migrate the tables:
    ```bash
    php artisan migrate
    ```

5. **Install Laravel Sanctum**:
   To ensure API authentication works properly, you need to install Laravel Sanctum:
    ```bash
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
    ```

---

## Running the Project Locally

1. **Start the local development server**:
    ```bash
    php artisan serve
    ```

2. **Testing the API**:
   Use Postman or cURL to test the endpoints. See [API Documentation](#api-documentation) below for details on available endpoints and their usage.

---

## API Documentation

### Base URL
http://localhost:8000/api

### Authentication

#### Login

- **Endpoint**: `/api/login`
- **Method**: `POST`
- **Request**:
    ```json
    {
        "email": "user@example.com",
        "password": "password123"
    }
    ```
- **Response**:
    ```json
    {
        "token": "your-auth-token-here"
    }
    ```

#### Logout

- **Endpoint**: `/api/logout`
- **Method**: `POST`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Response**:
    ```json
    {
        "message": "Logged out successfully."
    }
    ```

### Task Management

#### List Tasks

- **Endpoint**: `/api/tasks`
- **Method**: `GET`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Response**:
    ```json
    [
        {
            "id": 1,
            "title": "Task 1",
            "description": "This is task 1",
            "created_at": "2024-09-06T12:00:00",
            "updated_at": "2024-09-06T12:00:00"
        }
    ]
    ```

#### Create Task

- **Endpoint**: `/api/tasks`
- **Method**: `POST`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Request Body**:
    ```json
    {
        "title": "New Task",
        "description": "Task description"
    }
    ```
- **Response**:
    ```json
    {
        "id": 2,
        "title": "New Task",
        "description": "Task description",
        "created_at": "2024-09-06T12:30:00",
        "updated_at": "2024-09-06T12:30:00"
    }
    ```

#### Show Task

- **Endpoint**: `/api/tasks/{task}`
- **Method**: `GET`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Response**:
    ```json
    {
        "id": 1,
        "title": "Task 1",
        "description": "This is task 1",
        "created_at": "2024-09-06T12:00:00",
        "updated_at": "2024-09-06T12:00:00"
    }
    ```

#### Update Task

- **Endpoint**: `/api/tasks/{task}`
- **Method**: `PUT`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Request Body**:
    ```json
    {
        "title": "Updated Task",
        "description": "Updated description"
    }
    ```
- **Response**:
    ```json
    {
        "id": 1,
        "title": "Updated Task",
        "description": "Updated description",
        "created_at": "2024-09-06T12:00:00",
        "updated_at": "2024-09-06T13:00:00"
    }
    ```

#### Delete Task

- **Endpoint**: `/api/tasks/{task}`
- **Method**: `DELETE`
- **Request Header**:
    - `Authorization: Bearer {token}`
- **Response**:
    ```json
    {
        "message": "Task deleted successfully."
    }
    ```

---

## Assumptions and Design Decisions

- **Authentication**: The API is protected by Laravel Sanctum, which provides token-based authentication.
- **Task Ownership**: Each task is owned by an authenticated user, and only that user can perform operations on their tasks.
- **Validation**: Basic input validation is in place for task creation and updates.
