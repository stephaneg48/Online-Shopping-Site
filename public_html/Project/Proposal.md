# Project Name: Simple Shop
## Project Summary: This project will create a simple e-commerce site for users. Administrators or store owners will be able to manage inventory and users will be able to manage their cart and place orders.
## Github Link: (Prod Branch of Project Folder)
## Project Board Link: https://github.com/stephaneg48/it202-009/projects/1
## Website Link: https://sag48-prod.herokuapp.com/Project/index.php
## Your Name: Stephane Gilles

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] (mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1

  - [x] (10/7/2021) User will be able to register a new account
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/register.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/15
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140638264-d7a98754-c2bb-4786-a70e-d12c1f4dc2e6.png)
          - Screenshot #1 description: Shows basic registration page with required forms filled in
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140638276-db57534d-41a8-47dd-afc8-7b08156d9310.png)
          - Screenshot #2 description: Same page after clicking "Register", verification message on top of Email form confirms successful registration
        - Screenshot #3: ![image](https://user-images.githubusercontent.com/90262925/140995528-2b37cf3b-36b8-461d-94a2-1f7175b0e0ae.png)
          - Screenshot #3 description: Same page after clicking "Register" for a user that has attempted to register with an unavailable username; error message displays on top, but email and username forms do not clear so the user knows what was previously put in
          - ## Please see the first commit to the Feat-ProductsTable branch or the most recent commit to the Milestone1 branch for any concerns on why the page's appearance differs from any of the other screenshots.

  - [x] (10/7/2021) User will be able to login to their account (given they enter the correct credentials)
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/login.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/15
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140638647-dc6fba90-9c98-497f-9f72-43c46a8c45e1.png)
          - Screenshot #1 description: Basic login page with user info from Issue 1 filled in
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140638664-997e4e30-8fe3-4c48-bafa-9ad9f7fca809.png)
          - Screenshot #2 description: Home page after successful login as user registered in Issue 1

  - [x] (10/7/2021) User will be able to logout
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/logout.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/15
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140638735-4c33735c-3e89-4908-888a-8efe9c283336.png)
          - Screenshot #1 description: Showing successful logout message (logout.php redirects the user to login.php)

  - [x] (10/7/2021) Basic security rules implemented
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/home.php, https://sag48-prod.herokuapp.com/Project/admin/assign_roles.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/16
        - PR link #2: https://github.com/stephaneg48/it202-009/pull/28
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140638858-e441ccc1-e0a8-42a9-9e3a-f69141cac612.png)
          - Screenshot #1 description: User that is not logged in attempting to access the home page (home.php) by changing the URL
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140638911-eedf37cc-5da4-4148-a5d6-f29ddeb6539c.png)
          - Screenshot #2 description: User that is not logged in being redirected to the login page after attempting to access the home page while logged out, message on top of "Username/Email" form relays this to the user
        - Screenshot #3: ![image](https://user-images.githubusercontent.com/90262925/140639037-e25ad81c-a1de-4f95-853e-0d7038714550.png)
          - Screenshot #3 description: User attempting to access admin-only page (if it exists) while logged out
        - Screenshot #4: ![image](https://user-images.githubusercontent.com/90262925/140639068-09c1c8c8-fe1e-4c14-9eec-decbc4e76a22.png)
          - Screenshot #4 description: User being redirected to the login page after attempting to access admin-only page, two messages on top of "Username/Email" form confirm this

  - [x] (10/28/2021) Basic Roles implemented
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/admin/list_roles.php, https://sag48-prod.herokuapp.com/Project/admin/assign_roles.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/33
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140639145-d5cc8150-4ccb-4b05-a3db-a291ab2fd179.png)

          - Screenshot #1 description: Shows current list of roles (can only be viewed by admins)
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140639244-b4952a50-9313-4298-a52d-719729fb721d.png)
          - Screenshot #2 description: Shows page for assigning roles that reflects part of the User Roles table for one user ("ilikehoney")

  - [x] (11/4/2021) Site should have basic styles/theme applied; everything should be styled
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/styles.css
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/37
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140639351-40ec1698-1804-4e71-810d-9d75c015ab30.png)
          - Screenshot #1 description: Shows the styling that was added to the PHP pages (previous/following screenshots show the styling...)

  - [x] (10/7/2021) Any output messages/errors should be “user friendly”
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/register.php, https://sag48-prod.herokuapp.com/Project/home.php, https://sag48-prod.herokuapp.com/Project/admin/assign_roles.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/16
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140639630-b958ba32-c2d5-4335-b84f-78959ae066cc.png)
          - Screenshot #1 description: New user attempting to register sees warning message stating the required format for passwords
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140638664-997e4e30-8fe3-4c48-bafa-9ad9f7fca809.png)
          - Screenshot #2 description: Shows user that has logged in receiving a welcome message that properly fetches their username
        - Screenshot #3: ![image](https://user-images.githubusercontent.com/90262925/140639711-32693a82-bc27-47cf-8a43-3484d7bf17d8.png)
          - Screenshot #3 description: Shows admin receiving error message on role assignment page, stating that the username for the search field cannot be empty for assigning roles to users

  - [x] (10/14/2021) User will be able to see their profile
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/profile.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/28
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140639811-1873935a-0370-4287-b94a-be701bf9af02.png)
          - Screenshot #1 description: Shows the basic user profile and relevant info

  - [x] (10/14/2021) User will be able to edit their profile
    -  List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: https://sag48-prod.herokuapp.com/Project/profile.php
      - Pull Requests
        - PR link #1: https://github.com/stephaneg48/it202-009/pull/28
      - Screenshots
        - Screenshot #1: ![image](https://user-images.githubusercontent.com/90262925/140639882-5783026b-1263-4da3-b784-b746f05bc285.png)
          - Screenshot #1 description: Shows user changing password from 10 characters to 8 characters...
        - Screenshot #2: ![image](https://user-images.githubusercontent.com/90262925/140639897-c66b2cad-226a-4459-afca-504f67f48eb6.png)
          - Screenshot #2 description: Shows successful password change for the user with verification message


<table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - User with an admin role or shop owner role will be able to add products to inventory (2021-11-28)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/admin/add_product.php](https://sag48-prod.herokuapp.com/Project/admin/add_product.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/77](https://github.com/stephaneg48/it202-009/pull/77)</p></td></tr><tr><td><table><tr><td>F1 - Table should be called Products (id, name, description, category, stock, created, modified, unit_price, visibility [true, false])<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144793623-26ce671f-9d57-406e-b6b1-6991d7cdbae5.png"><p>Screenshot of Products table in VS Code</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144794034-2e68820f-fde0-44bd-8ea8-dce3237748d8.png"><p>Screenshot of Add Product page with information for a new product filled in</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144794149-c4d0da87-334a-4473-83a9-3826746845d6.png"><p>Screenshot of Add Product page after successfully adding the new product to the Shop</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144794297-cd924f21-23f8-470e-ba62-6847c154cc1c.png"><p>Screenshot of shop page verifying that the new product now exists</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144794385-4d7f0cea-7532-4fb1-a55b-a98d4baf7b73.png"><p>Screenshot of home page revealing the Add Product page while logged in as an admin/shop owner</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144794486-02bc9bed-add6-44d9-9480-d45365166d27.png"><p>Screenshot of home page while logged in as a regular user to verify that regular users cannot add products</td></tr></td></tr></table></td></tr><table><tr><td>F2 - Any user will be able to see products with visibility = true on the Shop page (2021-12-04)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/shop.php](https://sag48-prod.herokuapp.com/Project/shop.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/79](https://github.com/stephaneg48/it202-009/pull/79)</p></td></tr><tr><td><table><tr><td>F2 - Product list page will be public (i.e. doesn’t require login)<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144848889-34f8c236-48da-4164-ae07-668eb7040496.png"><p>Screenshot to verify that shop page can be viewed without being logged in, see navigation bar</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F2 - For now limit results to 10 most recent<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144852381-cffc5dad-68a1-4a3c-a03f-46b7785d49ce.png"><p>Screenshot of VS Code database to verify that the 10 most recent entries in the Products table are the products that have been displayed in previous screenshots</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F2 - User will be able to filter results by category<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144852610-a3921877-9154-4e8c-8959-02e399b49eaf.png"><p>Screenshot of the shop page after filtering by category "Technical Machine", it includes the newly added item from previous screenshots because it was created under this category</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F2 - User will be able to filter results by partial matches on the name<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144852916-20631b6e-67b2-468b-85f7-9dfc42097f09.png"><p>Screenshot of the shop page after filtering by name with the string "pot", leading to only products that have "pot" in the name</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F2 - User will be able to sort results by price<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144853205-4b0129f7-d48a-4603-a015-a94d34a6fb92.png"><p>Screenshot that shows the shop being sorted by price in descending order, previous screenshots of the shop with default filters show it in ascending order</td></tr></td></tr></table></td></tr><table><tr><td>F3 - Admin/Shop owner will be able to see products with any visibility (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/admin/edit_product.php](https://sag48-prod.herokuapp.com/Project/admin/edit_product.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/78](https://github.com/stephaneg48/it202-009/pull/78)</p></td></tr><tr><td><table><tr><td>F3 - This should be a separate page from Shop, but will be similar<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144854741-63f97d01-3ccd-4154-85d4-ecd445916562.png"><p>Screenshot to show the Edit Product page, which lists all existing products to admin/shop owner regardless of visibility</td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F3 - This page should only be accessible to the appropriate role(s)<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144855066-160819f6-966f-47d1-87b3-9fb82fc5824e.png"><p>Screenshot to show a regular user being redirected upon attempting to view the Edit Product page while it is accessible only to admin/shop owner</td></tr></td></tr></table></td></tr><table><tr><td>F4 - Admin/Shop owner will be able to edit any product ()</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/admin/edit_product.php](https://sag48-prod.herokuapp.com/Project/admin/edit_product.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/78](https://github.com/stephaneg48/it202-009/pull/78)</p><p>

 [https://github.com/stephaneg48/it202-009/pull/80](https://github.com/stephaneg48/it202-009/pull/80)</p></td></tr><tr><td><table><tr><td>F4 - Edit button should be accessible for the appropriate role(s) anywhere a product is shown (Shop list, Product Details Page, etc)<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144855479-942c5b6e-a6f0-4376-ace2-59e57652ad9f.png"><p>Screenshot to show the Edit button being accessible for admin/shop owner on the Shop page</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144855626-c83e87d7-13d3-4616-b8f6-49fbd0efd9d1.png"><p>Screenshot to show the Edit button being accessible for admin/shop owner on a product details page</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144855707-8810fe41-c58e-4dc7-9537-e79411ca924d.png"><p>Screenshot to show the Edit Product page after clicking Edit Product for "Revive" in the previous screenshot; page successfully filters this one product</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144863122-80ca8fb9-7223-4fd7-b685-ec3d61b3f45a.png"><p>Screenshot to show product "Revive" and the successful update of its price</td></tr></td></tr></table></td></tr><table><tr><td>F5 - User will be able to click an item from a list and view a full page with more info about the item (Product Details Page) (2021-12-05)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/product.php](https://sag48-prod.herokuapp.com/Project/product.php)</p></td></tr><tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/80](https://github.com/stephaneg48/it202-009/pull/80)</p></td></tr><tr><td><table><tr><td>F5 - Demonstration<tr><td>Status: completed</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144863722-392ccd47-6207-4a4e-82e6-0b1a19945f92.png"><p>Screenshot to show product details page for one product, only additional info at this moment is the product's current stock, note the URL indicating the product ID</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144863878-b4811258-613f-4ace-8cb5-4fcd304b8ade.png"><p>Screenshot to show product details page for another product, note that the URL has changed to indicate that the product ID has changed and corresponds to the ID for the product in the table</td></tr><tr><td><img width="600px" src="https://user-images.githubusercontent.com/90262925/144864705-c9869b42-2a86-4464-88a1-d4f3ccf9ee2d.png"><p>Screenshot to show product details for another product while logged out, note that the URL has changed again</td></tr></td></tr></table></td></tr>

<table>
<tr><td>Milestone 2 (cont.)</td></tr><tr><td>
<table>
<tr><td>F6 - User must be logged in for any Cart related activity below (2021-12-09)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/cart.php](https://sag48-prod.herokuapp.com/Project/cart.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/86](https://github.com/stephaneg48/it202-009/pull/86)</p></td></tr>
<tr><td>
<table>
<tr><td>F1 - Demonstration</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145662770-f72fc871-d136-4671-87ba-ed7911de1306.png">
<p>Screenshot of user on login page attempting to view cart page without being logged in</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145662790-c973674f-b223-4574-95d9-851d1e9519b3.png">
<p>Screenshot of user being redirected to login screen after attempt with warning message</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145662871-a60a74de-1608-446a-b349-3970e96dbaac.png">
<p>Screenshot of VS Code with code preventing user from accessing cart highlighted</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145662906-b07cd5e3-c829-4d90-83af-17c8870f1f10.png">
<p>Screenshot of shop page while logged out (user cannot add to cart)</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145662933-a7083ae8-b1da-4a29-8e59-400c0b2b4e9e.png">
<p>Screenshot of random product details page while logged out (user cannot add to cart)</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F7 - User will be able to add items to Cart (2021-12-09)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/shop.php](https://sag48-prod.herokuapp.com/Project/shop.php)</p><p>

 [https://sag48-prod.herokuapp.com/Project/product.php](https://sag48-prod.herokuapp.com/Project/product.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/86](https://github.com/stephaneg48/it202-009/pull/86)</p></td></tr>
<tr><td>
<table>
<tr><td>F7 - Cart will be table-based (id, product_id, user_id, desired_quantity, unit_cost, created, modified)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663114-a98a21b1-1d74-4f6c-a1f9-52d1b557e108.png">
<p>Screenshot of VS Code showing Cart table</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F7 - Adding items to Cart will not affect the Product's quantity in the Products table</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663162-2c79601f-42e7-4256-b522-6f26190b41bd.png">
<p>Screenshot of user about to add 10 of product "Ultra Ball" to their cart</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663191-e83f5071-50a2-4677-bffa-6b27c23ab5f8.png">
<p>Screenshot of shop page after user adds 10 of product "Ultra Ball" to their cart</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663227-501652c5-cc92-4660-a151-42967ced98d3.png">
<p>Screenshot of product details page for product "Hyper Potion" before user adds 5 of the product to their cart</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663250-6005f80e-ecd8-488b-8437-302e6030ee2f.png">
<p>Screenshot of product details page for product "Hyper Potion" after user adds 5 of the product to their cart</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663274-9745505a-294c-4f30-a1a4-dc14d2631d77.png">
<p>Screenshot of VS Code showing Cart table to verify that the products have actually been added, note the prices and desired quantities for user_id "5"</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663311-9b3e80a1-9963-4782-8393-efed8237106d.png">
<p>Screenshot of VS Code showing Products table after adding to cart, note the stocks have not changed from what was displayed in the product details page</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F8 - User will be able to see their cart (2021-12-09)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/cart.php](https://sag48-prod.herokuapp.com/Project/cart.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/86](https://github.com/stephaneg48/it202-009/pull/86)</p></td></tr>
<tr><td>
<table>
<tr><td>F8 - List all the items</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663413-d1f188c8-9fca-454d-9941-d5375b69c9cb.png">
<p>Screenshot of cart page, listing all of the items</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663438-7403c473-4f0d-4f9c-aad6-2d926b7c7c35.png">
<p>Screenshot of VS Code to verify cart for current user, note prices and desired quantities</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F8 - Show subtotal for each line item based on desired_quantity * unit_cost</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663413-d1f188c8-9fca-454d-9941-d5375b69c9cb.png">
<p>Screenshot of cart page, note the subtotal on the bottom of each listed product</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F8 - Show total cart value (sum of line item subtotals)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663413-d1f188c8-9fca-454d-9941-d5375b69c9cb.png">
<p>Screenshot of cart page, note the total value listed below the product cards</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F8 - Will be able to click an item to see more details (Product Details Page)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663413-d1f188c8-9fca-454d-9941-d5375b69c9cb.png">
<p>Screenshot of cart page, note the bottom left of the browser when mousing over the product "Ultra Ball"; previews link that will redirect the user to the product details page for "Ultra Ball"</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F9 - User will be able to change quantity of items in their cart (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/cart.php](https://sag48-prod.herokuapp.com/Project/cart.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/87](https://github.com/stephaneg48/it202-009/pull/87)</p></td></tr>
<tr><td>
<table>
<tr><td>F9 - Quantity of 0 should also remove from cart</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663413-d1f188c8-9fca-454d-9941-d5375b69c9cb.png">
<p>Screenshot of shop page</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663564-2ac727ce-0291-4e37-8d9a-d1f08c0b7352.png">
<p>Screenshot of shop page after user modifies quantity of product "Ultra Ball" from 10 to 5</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663627-08c6c22d-6d13-40c1-aed3-3815c94a1f88.png">
<p>Screenshot of shop page after user modifies quantity of product "Ultra Ball" from 5 to 0</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F10 - User will be able to remove a single item from their cart via button click (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/cart.php](https://sag48-prod.herokuapp.com/Project/cart.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/87](https://github.com/stephaneg48/it202-009/pull/87)</p></td></tr>
<tr><td>
<table>
<tr><td>F10 - Demonstration</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663687-06c52411-1c07-4a73-acb5-727e3688da00.png">
<p>Screenshot of cart page</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663701-cfaea13f-fae9-4bed-bb7b-d438d23af573.png">
<p>Screenshot of cart page after clicking "Remove from Cart" under product "Hyper Potion"</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F11 - User will be able to clear their entire cart via a button click (2021-12-10)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/cart.php](https://sag48-prod.herokuapp.com/Project/cart.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/87](https://github.com/stephaneg48/it202-009/pull/87)</p></td></tr>
<tr><td>
<table>
<tr><td>F11 - Demonstration</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663763-93668ee1-5807-4d82-9aed-2e20eb124d06.png">
<p>Screenshot of cart page with four products</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663805-1532b865-77ec-48b9-a57d-4d362c4e0877.png">
<p>Screenshot of cart page after clicking "Remove All" button</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663832-8fd44e02-b579-404b-9418-84c6a67bd999.png">
<p>Screenshot of VS Code with PHP code to remove all products from a user's cart highlighted</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/145663857-e821dfd3-45c5-4b69-a0de-29d7f3a892fe.png">
<p>Screenshot of VS Code with HTML to remove all products from a user's cart highlighted</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr></td></tr></table>




<table>
<tr><td>Milestone 3</td></tr><tr><td>
<table>
<tr><td>F1 - User will be able to purchase items in their Cart (2021-12-19)</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/checkout.php](https://sag48-prod.herokuapp.com/Project/checkout.php)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/94](https://github.com/stephaneg48/it202-009/pull/94)</p></td></tr>
<tr><td>
<table>
<tr><td>F1 - Create an Orders table (id, user_id, created, total_price, address, payment_method)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146817819-87b9971a-984e-44bb-b282-db313b45c9f5.png">
<p>Screenshot of VS Code showing Orders table in database</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Create an OrderItems table (id, order_id, product_id, quantity, unit_price)</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146817924-2110a546-f4f7-4527-9c86-08197ce60702.png">
<p>Screenshot of VS Code showing OrderItems table in database</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Checkout Form</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146819805-0f9ebd29-dc47-47b8-8ff6-1daf32eb080d.png">
<p>Screenshot showing checkout form (fields do not properly validate or get sanitized)</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - User will be asked for their Address for shipping purposes</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146819805-0f9ebd29-dc47-47b8-8ff6-1daf32eb080d.png">
<p>Screenshot showing checkout form (fields do not properly validate or get sanitized)</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<tr><td>
<table>
<tr><td>F1 - Order process</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F2 - Order Confirmation Page ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F2 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F3 - User will be able to see their Purchase History ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F3 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F4 - Store Owner will be able to see all Purchase History ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F4 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr></td></tr></table>


<table>
<tr><td>Milestone 4</td></tr><tr><td>
<table>
<tr><td>F1 - User can set their profile to be public or private (will need another column in Users table) (2021-12-19)</td></tr>
<tr><td>Status: complete</td></tr>
<tr><td>Links:<p>

 [https://sag48-prod.herokuapp.com/Project/profile.php](https://sag48-prod.herokuapp.com/Project/profile.php)</p><p>

 [https://sag48-prod.herokuapp.com/Project/profile.php?edit=true](https://sag48-prod.herokuapp.com/Project/profile.php?edit=true)</p><p>

 [https://sag48-prod.herokuapp.com/Project/profile.php?id=](https://sag48-prod.herokuapp.com/Project/profile.php?id=)</p></td></tr>
<tr><td>PRs:<p>

 [https://github.com/stephaneg48/it202-009/pull/93](https://github.com/stephaneg48/it202-009/pull/93)</p></td></tr>
<tr><td>
<table>
<tr><td>F1 - If public, hide email address from other users</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/009955/fff?text=completed"></td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146850564-0847d482-57d8-4b70-9d3e-2b6e3aee77d0.png">
<p>Screenshot of profile, contains edit features behind edit button now and has some basic info about the user</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146850700-6c4b6eca-903e-49fd-ac39-19a2a82c72ff.png">
<p>Screenshot of profile while editing, now has public/private functionality; user has just set their profile to public</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146850800-a22b1aae-eae9-4dbf-bbfe-50476abbe277.png">
<p>Screenshot of profile of another user to verify that the previous user has been logged out</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146850851-0bb2801f-e5ca-43f0-8f7f-dae7adec9b02.png">
<p>Screenshot of VS Code to show all existing user IDs before demonstrating public profile, note the new visibility column and the IDs of the two users in the previous screenshots</p>
</td></tr>

<tr><td>
<img width="768px" src="https://user-images.githubusercontent.com/90262925/146850941-f87b2fa7-f701-4cac-91cc-e6e558e42014.png">
<p>Screenshot of the public profile of user "goose" while logged in as another user; the URL has changed, the Edit button is now missing and the public profile does not display the email of user "goose"</p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F2 - User will be able to rate a product they purchased ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F2 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F3 - User’s Purchase History Changes ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F3 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F4 - Store Owner Purchase History Changes ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F4 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F5 - Add pagination to Shop Page (and any other product lists not yet mentioned) ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F5 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F6 - Store Owner will be able to see all products out of stock ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F6 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr>
<table>
<tr><td>F7 - User can sort products by average rating on the Shop Page ()</td></tr>
<tr><td>Status: incomplete</td></tr>
<tr><td>Links:</td></tr>
<tr><td>PRs:</td></tr>
<tr><td>
<table>
<tr><td>F7 - item 1</td></tr>
<tr><td>Status: 
<img width="100" height="20" src="https://via.placeholder.com/400x120/ff0000/000000?text=incomplete"></td></tr>

<tr><td>
<img width="768px" src="">
<p></p>
</td></tr>

</td>
</tr>
</table>
</td>
</tr></td></tr></table>

### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board