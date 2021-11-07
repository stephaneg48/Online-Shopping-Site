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

- Milestone 2

- Milestone 3

- Milestone 4

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