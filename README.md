
# QIT Test

This solution was created for a test at QIT Company, focusing on a web application for a shop and implementing a Role-Based Access Control (RBAC) system.

## Steps to Run the Application

1. Install the required dependencies:
    ```bash
    composer install
    ```

2. Run database migrations:
    ```bash
    php artisan migrate
    ```

3. Seed the database:
    ```bash
    php artisan db:seed
    ```

4. Start the application:
    ```bash
    php artisan serve
    ```

5. Build assets with npm:
    ```bash
    npm run dev
    ```

## Credentials

To have full control, log in as 'super admin':

- Email: `admin@admin.com`
- Password: `password`

- Home: `http://127.0.0.1:8000/`
- Dashboard: `http://127.0.0.1:8000/dashboard`
