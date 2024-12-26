# task_management_system

# installation

git clone https://github.com/Tamim556/task_management_system.git

cd task_management_system

compoer update

copy and paste .evn_example

rename .env_example to .env

create a database in your MySQL server 

give database name and other credentials  in .env file 

run command : php artisan migrate
run command : php artisan key:generate
run command : npm install
run command : npm run dev
run command : php artisan storage:link
run command : php artisan serve



for authentication used Laravel/brizze 
for API uses used laravel/sanctum 

# Functionality

user can login, Registration, logout

Task CRUD Operations

and 1 Api 

for all tasks get 
http://127.0.0.1:8000/api/tasks

