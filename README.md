# IMT3851---Assignment-2
School Assignment at NTNU Gjøvik

###1 OBJECTIVES
Students should be able to:
- access and manipulate MySQL databases using PHP,
- create and use HTML forms to interact with MySQL and PHP,
- keep track of users via cookies, sessions, and authentication,
- take security measures against XSS and SQL injection,
- and create a basic dynamic website.

###2 DESCRIPTION

In this assignment, you are expected to develop an online newspaper allowing its users to
provide fun news originating from both real and fake events.


A visitor accessing the main page of the website should the summaries of recent news, should
be able to read any news item, make a boolean search in the news pool, and rate news items.
The visitor should be able to choose whether he wants news to be listed according to the
chronological order or popularity (e.g., news with higher ratings). The visitor’s choice should
also be respected for her/his subsequent visits. The visitor should be able to login, if she/he
is a registered user, and a registration form should be provided for the visitors wishing to register.
All registered user should also be able to post news items. A logged user could also edit and
delete items created by him, and update his registration data (including the password). If the
user logs in as an admin, in addition to what a normal user can do, she/he should be able to
delete users, add/delete news categories (e.g., politics, sports etc.), delete any news item, and
see a summary (i.e., a list presenting the number of news under each category).
###3 OTHER REQUIREMENTS
- You should add indexes to your tables as necessary.
- It is sufficient to combine search keywords only with the ‘AND’ operator.
- You should use cookies to keep track of users’ preferences for topic ordering.
- You should use hashing to protect passwords.
- You should sanitise the user input and make a simple check against empty fields.
- Provide a ‘setup.php’ file to create the database.
- Create a sensible folder structure.
- Provide a ‘readme.txt’ file explaining how to get started.
- Your code should be well indented and commented.
- Your code should use proper variable names for readability.
- Look and feel of the pages is under your discretion.
- Zip all your code into a single zip file.
- This assignment has to be done individually!
