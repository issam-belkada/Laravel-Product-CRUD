# ⚡ ElectroStore Inventory

ElectroStore is a modern and responsive inventory management system built with **Laravel** and **Bootstrap 5**. It helps you manage products and categories with ease using a clean UI and robust backend logic.

---

## 🚀 Features

- 🛍️ Product CRUD (Create, Read, Update, Delete)
- 🗂️ Category CRUD with Trash support
- 🔍 Search functionality for products and categories
- 🔐 Authentication (Sign In / Sign Up)
- 📦 Soft Delete & Permanent Delete with confirmation modal
- 📊 Pagination for long lists
- ✨ Modern UI using Bootstrap 5

---

## 🛠️ Tech Stack

- **Laravel 10+**
- **PHP 8+**
- **Bootstrap 5**
- **MySQL**
- **FontAwesome**


---

## ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/electrostore-inventory.git
   cd electrostore-inventory
Install dependencies

composer install
npm install && npm run dev
Configure environment

cp .env.example .env
php artisan key:generate

Set up database:
Create a MySQL database
Update .env with your DB credentials

bash
php artisan migrate --seed
Run the app

bash
php artisan serve

🔐 Default Credentials (for testing)

Email: admin@example.com
Password: password


📁 Folder Structure (Highlights)
/app - Laravel application logic

/resources/views - Blade templates (UI)

/public - Public assets (CSS, JS, Images)

/routes/web.php - Route definitions



🙋‍♂️ Contributing
Pull requests are welcome! If you'd like to improve the UI, add features, or fix bugs, please fork the repo and submit a PR.


📄 License
This project is open-sourced under the MIT License.

🌐 Author
issam-belkada
[GitHub Profile](https://github.com/issam-belkada)
