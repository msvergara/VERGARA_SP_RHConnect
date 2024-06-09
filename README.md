# RHConnect: A Web-Based EMR for a Rural Health Center.
##### Marian Stephanie C. Vergara and Asst. Prof. Rizza DC. Mercado
###### 2nd Semester A.Y. 2023 - 2024
This system is created using XAMPP (with Laravel as Framework) in partial fulfilment for the course CMSC190 Special Problem.

# Getting Started
#### After Cloning
1. ```composer install ```
- If errors occur, try:
``` composer clearcache ``` and ``` composer selfupdate ```
2. ``` php artisan storage:link ```
- Create .env file using the .env.example provided
3. ``` php artisan key:generate ```
4. ``` php artisan migrate:fresh --seed ```
5. ``` php artisan optimize:clear ```
6. ``` php artisan route:cache ```
7. ``` php artisan route:clear ```

#### Ciphersweet
1. Add "CIPHERSWEET_KEY=" at the lowest part of the .env.
2. Run on terminal: ``` php artisan ciphersweet:generate-key ```


