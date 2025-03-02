Book Manager Application

![image](https://github.com/user-attachments/assets/fe95a458-7a7c-4312-a636-e7b653cd56ca)


The Book Manager Application is a web-based platform for managing a collection of books. It allows users to view, add, edit, and delete books, with additional features for searching and filtering. The application is built using Symfony and Twig, with a focus on simplicity and usability.

Features

1. Book Management
View Books: Browse the complete list of books with details like title, author, year of publication, and ISBN.
Add Books: Admins can add new books to the collection. Duplicate titles or ISBNs are prevented.
Edit Books: Admins can update book details.
Delete Books: Admins can remove books from the collection.

2. Search Functionality
Search for books by title using a simple search bar.

3. User Authentication
Registration: Users can create an account with a unique email address.
Login: Registered users can log in to access the application.
Admin Role: Admins have additional privileges to manage books.

4. Validation
Book Validation: Ensures that book details (e.g., title, author, year, ISBN) are valid and unique.
User Validation: Ensures that email addresses are unique and passwords meet security requirements.

Prerequisites

Before running the application, ensure you have the following installed:
- PHP (>= 8.1)
- Composer (for dependency management)
- Symfony CLI (optional but recommended)
- MySQL

Installation
Clone the Repository
- git clone https://github.com/your-repo/booklist.git
- cd booklist

Install Dependencies
- composer install

Set Up the Database
Create a database (e.g., books).
Update the .env file with your database credentials:
- DATABASE_URL="mysql://db_user@127.0.0.1:3306/books?serverVersion=8.0"

Run Migrations
- php bin/console doctrine:migrations:migrate

Load Fixtures (Optional)
To populate the database with sample data:
- php bin/console doctrine:fixtures:load

Start the Development Server
- symfony server:start

Access the Application
Open your browser and navigate to:
- http://localhost:8000   

Usage

For Users
- Register: Create an account to access the application.
- Login: Log in to view and search books.
For Admins
- Add Books: Navigate to the "Add New Book" page to add books.
- Edit Books: Click the "Edit" button on any book to update its details.
- Delete Books: Click the "Delete" button to remove a book.

Screenshots

Book List (User account)

![image](https://github.com/user-attachments/assets/ca4cb53b-960e-4073-952f-a103fd8515c0)

Book List (Admin account)

![image](https://github.com/user-attachments/assets/5b4593bc-67f6-4d0b-99d8-2872c3118228)


Login page

![image](https://github.com/user-attachments/assets/d82a672d-c7d5-4fa5-8b79-ec23d6e6d884)


Register page

![image](https://github.com/user-attachments/assets/b0c9e8d7-2cb6-4828-a6b6-f945e0f45d03)


Add book page

![image](https://github.com/user-attachments/assets/6b603281-1546-44af-bd66-547b7f876c84)


Search Results

![image](https://github.com/user-attachments/assets/3e64157d-1b2a-41b5-ae29-5bdce5cde345)


Database schema

![image](https://github.com/user-attachments/assets/bee42822-ab44-4137-8704-535d0363314e)
