<?php
require(__DIR__ . "/../../partials/nav.php");
reset_session();
$email = se($_POST, "email", "", false);
$username = se($_POST, "username", "", false);

?>

<style>
  .center {
        padding: 280px 0;
        text-align:center;
    }
</style>

<form class="center" onsubmit="return validate(this)" method="POST">
    <h2>Create Account</h2>
    <div>
        <label style="width:126px" for="email">Email</label>
        <input type="email" name="email" required value="<?php se($email); ?>"/>
    </div>
    <div>
        <label style="width:126px" for="username">Username</label>
        <input type="text" name="username" required maxlength="30" value="<?php se($username); ?>" />
    </div>
    <div>
        <label style="width:126px" for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm Password</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <br>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $confirm = se($_POST, "confirm", "", false);
    $username = se($_POST, "username", "", false);
    //TODO 3


    //$errors = [];
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty");
        $hasError = true;
    }
    //$email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = sanitize_email($email);
    //validate
    //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (!is_valid_email($email)) {
        flash("Invalid email");
        $hasError = true;
    }
    if (!preg_match('/^[a-z0-9_-]{3,30}$/i', $username)) // the /i allows uppercase letters 
                                                         // in addition to the regex restricting this to lowercase letters
    {
        flash("Username must only be alphanumeric and can only contain - or _");
        $hasError = true;
    }
    if (empty($password)) {
        flash("password must not be empty");
        $hasError = true;
    }
    if (empty($confirm)) {
        flash("Confirm password must not be empty");
        $hasError = true;
    }
    if (strlen($password) < 8) {
        flash("Password too short");
        $hasError = true;
    }
    if (strlen($password) > 0 && $password !== $confirm) {
        flash("Passwords must match");
        $hasError = true;
    }
    if ($hasError) {
        //flash("<pre>" . var_export($errors, true) . "</pre>");
    } else {
        //flash("Welcome, $email"); //will show on home.php
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password, username) VALUES(:email, :password, :username)");
        try {
            $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
            flash("You've registered, yay...");
        } catch (Exception $e) {
            /*flash("There was a problem registering");
            flash("<pre>" . var_export($e, true) . "</pre>");*/
            users_check_duplicate($e->errorInfo);
        }
    }
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>