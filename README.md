# Authentication

## login.html
1. User will input their username and apssword to log in.
2. Once username and password is authenticated user will be redirected to the student form so that they can submit new student information

##register.php
1. If user is not yet rgistered user may create a new account
2. User need to give username and password
3. Once username is insert it will be compared with the username existing in the database
4. If same username is found, user needs to put another username
5. If no username found then it will be registered and stored in database
6. The password will be hashed and stored in the database
7. Input will be sanitized from any symbol that is not needed

## login.php
1. From the [login.html](login.html) username and password will be compared from database
2. If username exist password will be verified
3. Once verification is done user will be redirected to the student form
