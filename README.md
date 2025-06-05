# ToDo List API With Laravel

RESTful API to manage personal and team tasks with roles, filtering, search, and invitation system.

---

## Features

- User authentication with JWT
- Role-based access (owner & guest)
- Task CRUD (create, read, update, delete)
- Search, filter, and categorize todos
- Invite users to the platform via email
- Toggle task completion status

---

## Tech Stack

- Laravel 12
- MySQL
- JWT (php-open-source-saver/jwt-auth)
- Laravel Mailer (Gmail SMTP)

---

## Installation

1. Clone the project:
   `bash
   git clone https://github.com/soaadhallak/To-Do-List.git
   cd To-Do-List

2. Install dependencies:
    composer install 

3. Copy .env file:
    cp .env.example .env

4. Generate app key:
   php artisan key:generate 

5. Configure database and mail settings in .env

6. Run migrations and seeders:
   php artisan migrate --seed 

7. Serve the app:
   php artisan serve 

   ----

  ## Authentication 

  Login:
  POST /api/login
   {
     "email": "owner@ow.com", "password": "123456" 
    } 
  Requires token for protected routes:
  Authorization: Bearer <JWT> 

  ---

  ## User Invitation Flow

  Owner sends invitation:
  POST /api/invite-user
   { "email": "newuser@example.com" 
   } 
  Email is sent with a registration link.
  Guest registers using the token:
  POST /api/users/register
   {
     "name": "Soad",
     "password": "123456",
     "token": "<token-from-email>"
    } 


   ##  API Endpoints

| Method | Endpoint                  | Description                          | Parameters                          | Access     |
|--------|---------------------------|--------------------------------------|-------------------------------------|------------|
| POST | /api/users/register      | Register via invitation token       | token, email, password , name       | Public     |
| POST | /api/users/login         | Login to get JWT token               | email, password                 | Public     |
| POST | /api/invite-user       | invite new user (Owner only)     | email                             | Owner      |
| GET  | /api/todo              | Get all tasks (with search,filter,paginated)            | ?page=1, ?priority=high         | All Users  |
| POST | /api/todo             | Create new task                      | title, priority, category     | Owner      |
| PUT  | /api/todo/{todo}/completed| Mark task as completed               |                                         | All Users     | 
| GET  | /api/todo/{todo}             | show single task           |                                 | All Users  |
| POST | /api/todo/{todo}             | update task                |                                     | Owner      |
| delete | /api/todo/{todo}             | delete task                |                                     | Owner      |

  ---

  ## Filtering Example

  GET /api/todos?search=math&priorityId=2&categoryId=3&page=1 


 ## Download the Postman Collection to test the API:  
  [To-Do List.postman_collection.json]

