# Taxi-Service

Creating this project as a part of enriching my laravel knowledge through practical experience

This Project is based on these process:

**Step 1: Setting up the project **
• Create a new Laravel project using the command line "composer 
create-project --prefer-dist laravel/laravel projectname" 
• Set up the database and configure the .env file with your database 
credentials. 
• Run the command "php artisan make:auth" to generate the basic 
authentication scaffolding or Use the built-in Laravel authentication 
scaffolding to set up user registration and login. 


**Step 2: User Authentication **
• Create a new migration file for creating the drivers table, with fields 
such as name, email, password, and phone number. 
• Create a new migration file for creating the customers table, with fields 
such as name, email, password, and phone number. 
• Run the migration files using the command "php artisan migrate" 
• Modify the authentication controllers and views accordingly to handle 
the driver and customer registration and login. 
• Create a separate login and registration views for drivers and 
customers using blade templating engine. 
• Create a new controller for handling the driver and customer's profile, 
with methods for updating and displaying the profile. 


**Step 3: Ride Request and Acceptance **
• Create a new migration file for creating the ride requests table, with 
fields for the customer's pickup location, destination, and requested 
time, status of the ride, driver_id and etc. 
• Run the migration file using the command "php artisan migrate" 
• Create a new controller for handling the ride requests, with methods for 
creating, listing, updating and deleting ride requests. 
• Create views using blade templating engine for customers to request 
rides, and a separate views for drivers to view, accept, and decline ride 
requests. 


**Step 4: Payment System **
• Create a new migration file for creating the payments table, with fields 
for the payment details such as amount, ride_id, and payment status. 
• Run the migration file using the command "php artisan migrate" 
• Create a new controller for handling the payment process, with 
methods for creating, listing, updating and deleting payments. 
• Create views using blade templating engine for handling the payment 
process, and integrate it with the ride request process. 


**Step 5: Driver Matching **
• Create an algorithm for matching the nearest available driver to a 
customer's pickup location. 
• Get the distance between the customer's pickup location and the 
driver's current location. 
• Create a method in the ride request controller that uses the driver 
matching algorithm to assign a driver to a ride request or We will check 
through Task Scheduling. 
• Create a method in the driver controller that allows the driver to update 
their location 


**Step 6: User Interface **
• Create a user-friendly interface for customers to request and track 
rides, and for drivers to view and accept them. 
• Use Bootstrap with blade templating engine to create a responsive and 
dynamic interface. 
• Create views using blade templating engine to show the status of a ride 
request, the driver's details and the payment details. 


**Step 7: Rating system **
• Create a migration file for creating the rating table, and run it using the 
command "php artisan migrate" 
• Create views using blade templating engine to display the ratings on 
the driver's and customer's profile. 
• Create a method in the controllers to handle the rating submission, 
retrieve the ratings and display them in the views.


**Step 8: Fare calculation **
• Create a fare calculation system based on distance, time
