# IT202-009 - Internet Applications, Fall 2021
## Stephane Gilles
### BS CS Student @ NJIT
#### last update 9/12/21 11:36 for HW additions
=======
# Heroku Setup

- 08/30/2021 removed .htaccess and updated Procfile to use public_html as docroot
- Profile tells Heroku how to deploy
- Composer.json mentions what libraries will be used 
- public_html contains all public facing content
- partials will be templates/partial pages that will NOT be accessed directly (still can reference via code)
- lib will be custom functions/libraries/etc that will NOT be accessed directly (still can be referenced via code)
- All work will be subfolders inside public_html (for the most part), lib will contain reusable functionality, partials will contain reusable templates, nothing else should change.

# Post-Heroku Setup

- this edit has been made at 9:23 PM to verify that the commit has worked successfully
