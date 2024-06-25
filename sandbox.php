<?php 

    if(isset($_POST['submit'])){

        //set cookies for gender
        setcookie('gender', $_POST['gender'], time() + 86400);

        // start session
        session_start();

        //save inputed value to session array
        $_SESSION['name'] = htmlspecialchars($_POST['name']);

        //Redirect user to index page
        header('Location: index.php');

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandbox Tutorial</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="post">
        <input type="text" name="name" value="" id="">
        <select name="gender" id="">
            <option value="male">male</option>
            <option value="female">female</option>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>