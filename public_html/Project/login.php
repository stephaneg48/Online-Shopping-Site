<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <input type="submit" value="Login" />
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
 if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"]))
 {
     $email = se($_POST, "email", "", false);
     $password = se($_POST, "password", "", false);
     //TODO 3: validate/use
     $errors = [];
     if (empty($email))
     {
         array_push($errors, "Email must be set");
     }
     // sanitize
     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
     // validate
     if (!filter_var($email, FILTER_VALIDATE_EMAIL))
     {
         array_push($errors, "Invalid email address");
     }

     // add more later...

     if (empty($password))
     {
         array_push($errors, "Password must be set");
     }

     if (strlen($password) < 8)
     {
         array_push($errors, "Password must be 8 or more characters");
     }

     if (count($errors) > 0)
     {
         echo "<pre>" . var_export($errors, true) . "</pre>";
     }
     else
     {
         echo "Welcome, $email!";
         // lookup user by email, then select pw bc MySQL cannot do comparison
         $db = getDB();
         $stmt = $db->prepare("SELECT email, password FROM Users WHERE email = :email");
         try 
         {
             $r = $stmt->execute([":email"=> $email]);
             if ($r)
             {
                 $user = $stmt->fetch(PDO::FETCH_ASSOC);
                 // look for user; return false if no records match
                 if ($user)
                 {
                     $hash = $user["password"];
                     // now remove password from user object
                     // so it does not leave scope
                     // (avoids password leaking in code)
                     unset($user["password"]);
                     if (password_verify($password, $hash))
                     {
                         echo "Welcome, $email";
                     }
                     else
                     {
                         "Invalid password";
                     }
                }
                else
                {
                    echo "Invalid email";
                }
             }
             echo "You've been registered!";
         }
         catch (Exception $e)
         {
             echo "There was a problem registering";
             echo "<pre>" . var_export($e, true) . "</pre>";
         }
     }
 }
?>