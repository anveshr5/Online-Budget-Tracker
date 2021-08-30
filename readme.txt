Hello! 

This a guide to simple expense manager created by Satya Anvesh Ranganadham as a part Internshala's training project.

Please download the entire 'Balance.zip' folder to the 'www' folder present in the 'wamp64' of your computer.
Create a database named 'budgettracker' in phpmyadmin
Import the 'budgettracker.sql' into budgettracker database before running the website 
I have included the MySQLi structure in 'buggettracker.sql' file, It has the following contents:

THe username is 'root' and password is nothing.
The name of the database is 'buggettracker'
The database has the following tables:

1) User's table(users): It stores the basic information of the user. It has the following:
                    user_id,First name, last name, email, phone number, profile photo(if uploaded), encrypted password.

2) Plan Details table(plandetails): It stores the details of the plans created by users. It has the following:
                    plan_id, Plan title, plan starting date, plan ending date, Initial Budget, Amount Spent(Initailly 0), 
                    Number of people in the plan, Id of the creator of the plan(Foriegn Key to User's Table).

3) Plan's users table(planusers): It stores the names of all users in a particular plan. It has the following:
                    plan_user_id, Plan id(Foriegn Key to Plan details's Table'), Plan user name.

4) Expenses table(expenses): It stores all the expenses added to each plan. It has the following:
                    expense_id, Plan id(Foriegn Key to Plan details's Table), Expense Title, Expense date, 
                    Expense Amount, Expense made by id, Image of the bill(If provided)

The explanation for the remaining of the files is:

1) index.php: It contains the index or landing page of the site.
2) index.css: It contains the CSS for theindex.php file
3) aboutus folder: It contains the aboutus.php and aboutus.css files
4) bills folder: All the bill images uploaded by user for expenses are stored here.
5) changepassword folder: It contains the changepassword.php, change_password_script.php and changepassword.css files, 
                            It allows the user to change the password in changepassword.php and change_password_script.php
                            helps in updating the password column in user's table
6) createNewPlan folder: It contains the createNewPlan.php and createNewPlan.css that help in setting the initial 
                            budget and no.of people, when will then go to planDetails.php where the remaining detials 
                            are filled and finally sent to the database using add_plan_script.php
7) homepage folder: It contains the homepage.php and homepage.css. Here the user can view all his plans and navigate to
                    them using the view plan button or create a new plan using the '+' symbol at the bottom right
8) images folder: This foler is used to store all the images used on this site.
9) includes folder: It contains the footers and header of all the pages that are used with php require function;
10) login folder: It contains the login.php, login.css which allows the user to enter their detials, These are then 
                    sent to user_validation_page.php to verify the details. It will redirect to homepage if details are 
                    correct or else it redirect to login.php and show the error.
11) profile folder: It contains the profile.php and profile.css, That display the user details and his profile 
                    image(default image if nothing is uploaded), It also contains a folder profilephotos where
                    all the user profile pictures are stored.
12) signup folder:It contains the signup.php and signup.css that which allows the user to create an account in the site
                    The information is sent to user_registration_form.php which verifies the details and then adds them 
                    to the database or going back to signup shows the respective error
13) viewplan folder: It contains the viewplan.php and viewplan.css that show the basic plan details and all the expenses 
                        in that plan Each expense has an additional button that shows us the bill(If uploaded, else the 
                        button is diabled). It has 2 buttons i) Expense distribution and ii) Add expense button denoted by '+' 
                        The expense distribution takes us to expensedistribution.php which show us the requied information and
                        '+' symbol takes us to addexpense.php which allows us to fill details for a new expense in that plan.
                        These details are then sent to add_expense_script.php which updates the database accordingly.      