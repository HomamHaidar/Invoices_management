# Invoices Management System 

![IMG_20231027_084118](https://github.com/HomamHaidar/Invoices_management/assets/147708704/d3072a29-d4d3-410f-a66b-553a21b1862b)

![IMG_20231027_084340](https://github.com/HomamHaidar/Invoices_management/assets/147708704/6f75f805-60c0-404c-8cff-b43a35e8a32d)

![IMG_20231027_084132](https://github.com/HomamHaidar/Invoices_management/assets/147708704/f597c2d3-20a7-4056-8e1c-095d1b890588)

![IMG_20231027_084148](https://github.com/HomamHaidar/Invoices_management/assets/147708704/31617ec9-76c2-4425-bde5-c1dfed9270f4)

![IMG_20231027_084236](https://github.com/HomamHaidar/Invoices_management/assets/147708704/c1ecf548-d261-47b9-8b8e-b1067363b274)

![IMG_20231027_084257](https://github.com/HomamHaidar/Invoices_management/assets/147708704/ff4b83d4-9c20-4259-a57f-e5cb19e8059c)

![IMG_20231027_084309](https://github.com/HomamHaidar/Invoices_management/assets/147708704/e427d6b8-61d3-47f1-94f6-20a7b90e5000)

![IMG_20231027_084327](https://github.com/HomamHaidar/Invoices_management/assets/147708704/03fe660c-fa63-458f-93ed-698a1a8c8975)

![IMG_20231027_084205](https://github.com/HomamHaidar/Invoices_management/assets/147708704/781550fa-33f6-4b58-9eb6-535da00a9d7f)

![IMG_20231027_084220](https://github.com/HomamHaidar/Invoices_management/assets/147708704/847f647d-8abe-4638-8205-a2dc9e9bed87)

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
