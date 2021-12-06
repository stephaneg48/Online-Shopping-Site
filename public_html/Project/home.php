<?php
require(__DIR__."/../../partials/nav.php");
?>

<h1>Home</h1>
<?php
if(is_logged_in(true))
{
 // echo "Welcome, " . get_user_email(); 
 flash("Welcome to Shopping Mall Nine, " . get_username());
 // comment below out if session variables do not have to be seen
 // echo "<pre>" . var_export($_SESSION, true) . "</pre>";
}
else
{
  // echo "You're not logged in";
  flash("You're not logged in");
}
?>

<?php
require(__DIR__."/../../partials/flash.php");
?>