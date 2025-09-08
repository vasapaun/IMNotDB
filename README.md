# 🎬 IMNotDB

<img width="1920" height="943" alt="image" src="https://github.com/user-attachments/assets/46828b59-8f1e-41a5-bd3c-924d26537a4a" />

## ✨ Features

* **📡 API-first**: RESTful JSON endpoints

* **🔐 Authentication**: Laravel Sanctum for token-based auth

* **💾 Database**: SQLite with migrations and seeders

* **📦 CRUD**: Full create, read, update, delete for films

* **🔍 Search**: Query films by title, genre, etc.

* **🐳 Dockerized**: Runs fully inside a container, no local setup needed

## 🚀 Installation and running

1. Pull the Docker image
   
   ```docker pull vasavasa/imnotdb/latest```

2. Run the container

   ```docker run -p 8000:8000 vasavasa/imnotdb```

3. Access the app by opening http://localhost:8000 in your browser

## 📖 API Endpoints

Base URL(local): http://localhost:8000/api


| Method | Endpoint                         | Description                                  | Auth Required |
|--------|----------------------------------|----------------------------------------------|---------------|
| POST   | /register                        | Register a new user                          | No            |
| POST   | /login                           | Log in and receive auth token                | No            |
| GET    | /films                           | List all films                               | Yes           |
| POST   | /films                           | Create a new film                            | Yes           |
| GET    | /films/{id}                      | Get film details by ID                       | Yes           |
| PUT    | /films/{id}                      | Update film by ID                            | Yes           |
| DELETE | /films/{id}                      | Delete film by ID                            | Yes           |
| GET    | /films/search?q=...              | Multi-word search by title, description, genres, etc.   | Yes           |
| GET    | /films?sort=...&order=[asc/desc] | List films sorted by rating, year or runtime | Yes           |


### Example requests:

**Register**

```
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Alice","email":"alice@example.com","password":"secret"}'
```

**Login** (returns auth token)

```
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"alice@example.com","password":"secret"}'
```

**Get all films**

```
curl -X GET http://localhost:8000/api/films \
  -H "Authorization: Bearer <TOKEN>"
```

**Search films**

```
curl -X GET "http://localhost:8000/api/films/search?q=matthew+mcconaughey+sci-fi" \
  -H "Authorization: Bearer <TOKEN>"
```

**Sort films**

```
curl -X GET "http://localhost:8000/api/films?sort=[rating/year/runtime]&order=[asc/desc]" \
  -H "Authorization: Bearer <TOKEN>"
```
