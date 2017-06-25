### Temper test application for Gapstars interview

## Setting up 

- Clone the repository 
- Run the composer update to install all the depandancies
- Run `php artisan key:generate` command to generate the APP-KEY

## Run project

- Run `php artisan serve` command to start the server and site will be available at `http://localhost:8000/`

## Special notes

- Since its for test purposes API and the front end both is written in Laravel framwork, how ever i belive i have satified the requirements of the test (Creating an api to serve the graph cordinates , Using vuejs in the front end)

- Since i have used Laravel to serve the dashboard page, and laravel uses blade template engine `{{}}` are executed by php before js, so i couldn't use  vuejs to handle the error message within the dom in case if API failure (I have used an alert to handle that)
