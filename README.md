# 📝 To-Do List API with Laravel

A robust task management system with role-based access control (Owner/Guest), invitation system, and advanced features.

## 🚀 Features

- User Roles:
  - Owner: Full permissions (CRUD tasks, invite users)
  - Guest: Read-only access (view tasks only)
  
- Core Functionalities:
  - ✉️ Invitation-only registration
  - ✅ Task CRUD operations
  - 🔍 Filtering/Searching (by priority, category)
  - 📖 Pagination
  - 🏷️ Task categorization (priority, category)

- Technical Stack:
  - Laravel 10
  - PostgreSQL/SQLite
  - JWT Authentication
  - Repository Pattern
  - Docker Support

## 🔧 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Docker (optional)

### Steps
1. Clone repo:
   `bash
   git clone https://github.com/yourusername/todo-api.git