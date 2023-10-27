# Invoices Management System 
![photo_2023-10-27_08-48-28](https://github.com/HomamHaidar/Invoices_management/assets/147708704/8e5b7d27-4005-4c08-a023-e8754db6f6a2)

![image](https://github.com/HomamHaidar/Invoices_management/assets/147708704/61a5a0bf-a557-488a-92bd-3e4c154ee6fb)




## Installation

> **Warning**
> Make sure to follow the requirements first.

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone git@github.com:HomamHaidar/school_management.git
    ```

1. Go into the project root directory
    ```sh
    cd  school_management
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `school` (you can change database name)

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```


1. Run migration
    ```
    php artisan migrate
    ```
    
1. Run seeder
    ```
    php artisan db:seed
    ```
      this command will create  user (owner):
     > email: homamhaidar18@gmail.com , password: 12345678

1. Run server 

   
    ```sh
    php artisan serve
    ```  
Visit localhost:8000 in your favorite browser.
