# NBA Store Project

**Version:** 1.0.0  
**Type:** School Project  
**Technologies Used:** PHP, MySQL, MongoDB, HTML, CSS

---

## Description

NBA Store is an e-commerce project developed as part of a school assignment. The application allows users to browse NBA product categories, add articles, and manage products, categories, and users (admin-only). It also integrates MongoDB to manage blog articles related to NBA news.

---

## Key Features

### Users
- **Client:** Access to product pages (read-only).
- **Admin:** Full access to all functionalities:
  - Category management.
  - Product management.
  - User management.
  - Article management (MongoDB).

### E-commerce Functionalities (MySQL)
- Manage products (add, edit, delete).
- Manage categories.
- Display products and their details.

### NBA Articles (MongoDB)
- Create, read, and manage NBA articles via MongoDB.

---

## Project Setup

### Prerequisites

1. **Local environment:**
   - [XAMPP](https://www.apachefriends.org/) (or any Apache server with PHP and MySQL).
   - Composer (for PHP dependency management).
   - MongoDB Compass (to manage the MongoDB database).

2. **PHP Dependencies:**
   - MongoDB Extension (PHP MongoDB Driver). [Installation Guide](https://www.php.net/manual/en/mongodb.installation.php).

---

### Installation Steps

#### Step 1: Clone the Project

Clone the Git repository to your local machine:

```bash
git clone https://github.com/LhenryAxel/projet-commerce-nba.git
cd your-repository
```

#### Step 2: Configure the MySQL Database

1. Open phpMyAdmin.
2. Create a database named `nba_store`.
3. Import the SQL script located in the root of the project: `nba_store.sql`.
4. Ensure that the data (categories, products, users, etc.) has been imported successfully.

#### Step 3: Configure MongoDB

1. Install MongoDB and start the service.
2. Use MongoDB Compass to create a database named `nba_store`.
3. Add the `nba_articles` collection and its schema using the script `setup_nba_articles.js` located at the root of the project.

To insert articles using MongoDB Compass:
- Open the `nba_store` database.
- Click on `nba_articles` collection or create it.
- Run the `setup_nba_articles.js` script to create the schema and insert example data.

#### Step 4: PHP Configuration

1. Ensure your server uses PHP 8.2 (or higher).
2. Enable the MongoDB extension in your `php.ini` file:

```ini
extension=mongodb
```

3. Restart your Apache server.

#### Step 5: Launch the Project

1. Start XAMPP (Apache + MySQL).
2. Access the project via `http://localhost/projet-commerce-nba/public`.
3. Use the following credentials to log in:

   **Admin:**
   - Email: `admin@admin`
   - Password: `admin`

   **Client:**
   - Email: `user@user`
   - Password: `user`

---

## Project Structure

```
projet-commerce-nba/
├── core/                  # Database connection files for MySQL and MongoDB
├── public/                # Publicly accessible files (index.php, CSS, etc.)
├── src/                   # Models, controllers, and views
│   ├── Models/            # Data management classes
│   ├── Controllers/       # Business logic classes
│   └── Views/             # HTML + PHP files for rendering
├── nba_store.sql          # SQL script to set up the MySQL database
├── setup_nba_articles.js  # Script to set up MongoDB articles collection
└── README.md              # Project documentation
```

---

## Technical Features

### Role Management

- `admin` and `client` roles are defined in the `users` table.
- Protected routes automatically redirect unauthorized users.

### Article Management (MongoDB)

- NBA articles are stored in the `nba_articles` collection.
- Articles include information about players, teams, and tags.

### User Interface

- **Admin Dashboard:** Manage categories, products, users, and articles.
- **Client Page:** Browse available products.

---

## Authors

**Name:** Axel LHENRY  

This project was developed as a school assignment to apply advanced concepts in PHP, MySQL, MongoDB.

