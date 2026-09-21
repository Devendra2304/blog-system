# 📝 Personal Blog System

A modern, scalable Content Management System (CMS) built with **Laravel 11**, **PostgreSQL**, and **Tailwind CSS**. Designed for effortless article publishing, multi-taxonomy management (Categories & Tags), SEO-friendly URLs, real-time search, and an administrative control panel.

---

## 📸 Key Features

### 🌐 Public Reader Interface
* **Dynamic Paginated Feed:** Displays published articles with clean URL parameter preservation during page jumps.
* **Full-Text & Keyword Search:** Case-insensitive search across article titles and content powered by PostgreSQL `ilike` operations.
* **Taxonomy Filtering:** Filter articles by category or multi-select tag parameters via custom Eloquent query scopes.
* **SEO-Friendly Slugs:** Human-readable URLs (e.g., `/posts/building-a-laravel-cms`) using Route Model Binding instead of numeric IDs.
* **Responsive Layout:** Mobile-first user interface built with Tailwind CSS and custom Blade layouts.

### 🛡️ Administrative Panel (CRUD)
* **Secure Authentication:** Protected admin control panel backed by **Laravel Breeze**.
* **Post Lifecycle Management:**
  * **Create:** Draft or publish posts with automatic unique slug collision resolution.
  * **Read:** Tabular overview of draft and published posts with category tags and publication dates.
  * **Update:** In-place post editor with tag multi-selection and instant title re-slugging.
  * **Delete:** Cascading deletion that cleans up database links without breaking integrity.
* **Taxonomy Control:** Dedicated management dashboards to create and prune Categories and Tags.

---

## 🛠️ Tech Stack

| Domain | Technology |
| :--- | :--- |
| **Backend Framework** | Laravel 11 (PHP 8.3+) |
| **Database** | PostgreSQL |
| **Database ORM** | Eloquent ORM |
| **Authentication** | Laravel Breeze |
| **Frontend Templates** | Blade Templating Engine |
| **Styling** | Tailwind CSS |
| **Asset Bundler** | Vite |

---

## 🗄️ Database Architecture & ER Diagram

The database utilizes relational integrity constraints with foreign keys and cascade rules across four primary tables and a pivot junction table:


+------------------+          +-------------------+          +------------------+
|    categories    |          |       posts       |          |       tags       |
+------------------+          +-------------------+          +------------------+
| id (PK)          | 1      m | id (PK)           | m      m | id (PK)          |
| name             |<---------| user_id (FK)      |----------| name             |
| slug (UNIQUE)    |          | category_id (FK)  |          | slug (UNIQUE)    |
| created_at       |          | title             |          | created_at       |
| updated_at       |          | slug (UNIQUE)     |          | updated_at       |
+------------------+          | summary           |          +------------------+
| content           |                   ^
| status            |                   |
| published_at      |                   |
| created_at        |                   |
| updated_at        |                   |
+-------------------+                   |
|                             |
| 1                           |
|                             |
v M                          |
+-------------------+                   |
|     post_tag      |                   |
+-------------------+                   |
| id (PK)           |                   |
| post_id (FK)      |-------------------+
| tag_id (FK)       |
+-------------------+

---

## 🛣️ API & Web Route Specifications

### Public Routes
| Method | URI | Controller Action | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | `PostController@index` | Display paginated feed, search, and taxonomy filters |
| `GET` | `/posts/{post:slug}` | `PostController@show` | View full post content by unique slug |

### Protected Admin Routes (`auth` Middleware)
| Method | URI | Controller Action | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/admin/posts` | `PostController@adminIndex` | Display admin post management table |
| `GET` | `/admin/posts/create` | `PostController@create` | Render new post creation form |
| `POST` | `/admin/posts` | `PostController@store` | Validate, slugify, and save new post |
| `GET` | `/admin/posts/{post}/edit` | `PostController@edit` | Render post edit form with pre-filled data |
| `PUT` | `/admin/posts/{post}` | `PostController@update` | Update post details and sync tag relationships |
| `DELETE` | `/admin/posts/{post}` | `PostController@destroy` | Remove post from database |
| `GET/POST/DEL` | `/admin/categories` | `CategoryController` | Category management resource |
| `GET/POST/DEL` | `/admin/tags` | `TagController` | Tag management resource |

---

## 🚀 Installation & Local Setup

### 1. Prerequisites
Ensure you have the following installed locally:
* **PHP** >= 8.3 with `pdo_pgsql` extension enabled
* **Composer**
* **Node.js** (v18+) & **NPM**
* **PostgreSQL** database service running

### 2. Repository Setup
```bash
# Clone the repository
git clone [https://github.com/your-username/personal-blog-system.git](https://github.com/your-username/personal-blog-system.git)
cd personal-blog-system

# Install PHP dependencies
composer install

# Install NPM packages
npm install
3. Environment Configuration
Duplicate the environment template file:

Bash
cp .env.example .env
Open .env and configure your PostgreSQL database credentials:

Code snippet
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=blog_db
DB_USERNAME=postgres
DB_PASSWORD=your_postgres_password
Generate the Laravel application key:

Bash
php artisan key:generate
4. Database Setup & Migrations
Ensure an empty PostgreSQL database named blog_db exists, then run:

Bash
php artisan migrate
5. Running the Application
Launch the Vite asset bundler in one terminal:

Bash
npm run dev
In a second terminal, start the local development server:

Bash
php artisan serve
Visit the application in your browser:

Public Blog: http://127.0.0.1:8000/

Admin Registration: http://127.0.0.1:8000/register

Admin Dashboard: http://127.0.0.1:8000/admin/posts

📂 Project Structure Overview
Plaintext
blog-system/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CategoryController.php
│   │       ├── PostController.php
│   │       └── TagController.php
│   │
│   └── Models/
│       ├── User.php
│       ├── Post.php
│       ├── Category.php
│       └── Tag.php
│
├── database/
│   └── migrations/
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   └── app.js
│   │
│   └── views/
│       ├── admin/
│       │   ├── posts/
│       │   ├── categories/
│       │   └── tags/
│       │
│       ├── blog/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       │
│       ├── auth/
│       │
│       └── components/
│           └── layouts/
│
├── routes/
│   ├── web.php
│   └── auth.php
│
├── public/
│
├── .env
├── composer.json
├── package.json
├── vite.config.js
└── README.md


🚧 Future Improvements

The project can be extended with additional features such as:

🖼️ Featured images for posts
📝 Rich text / Markdown editor
💬 Comment system
❤️ Like and reaction system
🔖 Bookmarking
🔎 Advanced search
👤 Public author profiles
📊 Admin analytics dashboard
📈 Post view statistics
🌓 Light/Dark theme switching
📧 Email notifications
🔔 Admin notifications
📰 Newsletter subscription
🔐 Role-based admin permissions
☁️ Image storage using cloud services
🚀 Production deployment



🧪 Development Environment

The project was developed and tested using:

Operating System : Windows
Backend          : Laravel / PHP
Database         : PostgreSQL
Database Host    : Neon PostgreSQL
Frontend         : Blade + Tailwind CSS
Build Tool       : Vite
Authentication   : Laravel Breeze




👨‍💻 Developer

Devendra Ahire

MET Institute of Management, Nashik
