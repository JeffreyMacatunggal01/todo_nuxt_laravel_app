# Project Name

TODO APP

## Description

This is a Todo App that uses Laravel as the backend framework and Nuxt.js as the frontend framework.

## Prerequisite

- Docker

## Docker Setup

1. Clone the repository.

### Backend Installation

1. Open terminal in the `backend` folder
   Then, run the following command to build and start the Docker containers:

```bash
   docker compose up -d --build
```

2. Execute the migration of backend:

```bash
   docker exec Serve sh -c "cd /app && php artisan migrate"
```

3. Then you can now run the backend by accessing [localhost:8000](http://localhost:8000).

### Frontend Installation

1. Add a new terminal that opens in the `frontend` folder
   Then, run the following command to build and start the Docker containers:

```bash
   docker compose up -d --build
```

2. Then you can now run the site by accessing [localhost:3000](http://localhost:3000).

## Unit Testing

The unit testing for this project is located in the `backend/tests` directory. It includes test cases for various components and functionalities of the project.

To run the unit tests, you can try this on terminal :
<b>For Feature Tests:<b/>

```bash
   docker exec Serve sh -c "cd /app && php artisan test --testsuite=Feature"
```

<b>For Unit Tests:<b/>

```bash
   docker exec Serve sh -c "cd /app && php artisan test --testsuite=Unit"
```

## License

This project is licensed under the [MIT License](LICENSE).
