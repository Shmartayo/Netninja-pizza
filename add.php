<?php 
    //connect to the database
    include "config/db_connect.php";

    //Initialization of the form variables
    $email = $title = $ingredients = "";
    $errors = array("email"=> "","title"=> "","ingredients"=> "");

    //On submit check it there are errors
    if(isset($_POST["submit"])){

        //check email
        if (empty($_POST["email"])){
             $errors["email"] = "An email is required";
        } else{
            $email = htmlspecialchars($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] = "Email address must be valid <br>";
            } 
        }

        //check title
        if (empty($_POST["title"])){
            $errors["title"] = "A title is required <br>";
        } else{
            $title = htmlspecialchars($_POST["title"]);
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors["title"] = "Title must be letters and spaces only <br>";
            }
        }

        //check ingredients
        if(empty($_POST["ingredients"])){
            $errors["ingredients"] = "At least one ingredient is required";
        } else{
            $ingredients = htmlspecialchars($_POST["ingredients"]);
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors["ingredients"] =  "Ingredients must be a comma separated list";
            }
        }

        /*check if the errors array doesn't consist of any 
          errors and redirect if there are no errors
          do nothing if there are no errors */ 
        if(array_filter($errors)){
            //echo errors in forms
        }  else {
            //override the values and make insertion of values into the database secure
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            //create sql query variable
            $sql ="INSERT INTO pizzas (email,title,ingredients) VALUES('$email','$title','$ingredients')";

            //save to db and check
            if(mysqli_query($conn,$sql)){
                //success
                //Redirect to the index page
                header("Location: index.php");
            } else {
                //error
                echo "Query error: " . mysqli_error($conn);
            }
        }      
    }

?>

<!DOCTYPE html>
<html lang="en">
<?php include "templates/header.php"; ?>
    <section class="container grey-text">
        <h4 class="center"> Add a Pizza</h4>
        <form class="white" action="add.php"  method="post">
            <label for="email">Your Email:</label><br>
            <input type="text" name="email" value="<?php echo $email; ?>"><br>
            <div class="red-text"><?php echo $errors["email"]; ?></div>
            <label for="name">Pizza Title:</label><br>
            <input type="text" name="title" value="<?php echo $title; ?>"><br>
            <div class="red-text"><?php echo $errors["title"];?></div>
            <label for="ingredients">Ingredients (comma separated):</label><br>
            <input type="text" name="ingredients" value="<?php echo $ingredients; ?>"><br>
            <div class="red-text"><?php echo $errors["ingredients"]; ?></div>
            <div class="center">
                <input type="submit" value="Submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include "templates/footer.php"; ?>
</html>