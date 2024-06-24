<?php 
    //connect database
    include "config/db_connect.php";

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
        <div class="container center">
            <?php if ($pizza): ?>
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                <p>Created By: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p>Created at : <?php echo date($pizza['created_at']); ?></p>
                <h5>Ingredients:</h5>
                <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
            <?php else: ?>
                <h5>No such pizza exists!</h5>

            <?php endif; ?>

            </div>
        </div>

    <?php include "templates/footer.php"?>
    

</html>