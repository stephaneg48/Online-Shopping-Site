
> # Online Shopping Site  
## Based on the area "Shopping Mall Nine" from Pokémon

---

This project was created for the Internet Applications course at NJIT in the Fall 2021 semester.

The purpose of this project was to create a simple e-commerce site for users. 

**Users** are able to manage their cart, browse through pages of products, place orders, and rate & review products.

**Site administrators** or **store owners** are elevated users; they are able to manage old and new product inventory & details. Site administrators can additionally view all purchase history, list currently existing roles for users and create & assign new roles for users.

Site functionality was implemented through SQL, PHP, JavaScript, and HTML. 
# [The site can be viewed here (redirects to Heroku deploy).](https://sag48-prod.herokuapp.com/Project/index.php)
> # Additional Heroku Setup

- 08/30/2021: removed .htaccess and updated Procfile to use public_html as docroot
- Profile tells Heroku how to deploy
- Composer.json mentions what libraries will be used 
- public_html contains all public facing content
- partials will be templates/partial pages that will NOT be accessed directly (still can reference via code)
- lib will be custom functions/libraries/etc that will NOT be accessed directly (still can be referenced via code)
- All work will be subfolders inside public_html (for the most part), lib will contain reusable functionality, partials will contain reusable templates, nothing else should change.
