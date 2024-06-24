<?php 
    //connect database
    include "config/db_connect.php";

    // how to delete a record
    // step 1 : check to see if there is a value im the
    // suvmit actiom im the POST method

    if(isset($_POST['delete'])){
        // if there is a value them we must get the id 
        // value passed im the hiddem form 

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        //use the id to delete the record
        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
        
        // Check to see if the query was executed
        if(mysqli_query($conn,$sql)){
            //success
            header('Location: index.php');
        }  else {
            //error
            echo 'Query error: ' .mysqli_error($conn);
        }
    }

// Check GET request id param (check if we have this parameter)
// isset() is how we check if the variable is set.
    if (isset($_GET['id'])){

        /* Before we make any query with any user entered 
           information we have to pass it through the
           mysqli_real_escape_string() fumctiom 
        */
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // make sql we would use to make a query
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        //get the query result
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        /*  mysqli_fetch_all() is used when we are trying
            to get all of the rows in the database to
            array while mysqli_fetch_assoc() is 
            used when trying to get a single associative
            array, and there is no need to add MYSQLI_ASSOC
            as a parameter in the function
        */
        $pizza = mysqli_fetch_assoc($result);

        //free result
        mysqli_free_result($result);

        //close connection
        mysqli_close($conn);
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "templates/header.php"?>
        <div class="container center grey-text">
            <?php if ($pizza): ?>
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                <p>Created By: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p>Created at : <?php echo date($pizza['created_at']); ?></p>
                <h5>Ingredients:</h5>
                <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
                
                <!-- Delete Form -->
                <form action="details.php" method="post">
                    <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($pizza['id'])?>">
                    <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
                </form>
            <?php else: ?>
                <h5>No such pizza exists!</h5>
            <?php endif; ?>
            </div>
        </div>
    <?php include "templates/footer.php"?>
</html>