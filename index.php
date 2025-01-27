<?php 
    //connect to the database
    include "config/db_connect.php";

    // construct the querry(write query for all pizzas)
    $sql = "SELECT id, title, ingredients FROM pizzas ORDER BY created_at";

    // make the query & get result
    $result = mysqli_query($conn,$sql);

    // fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Free the query result from
    mysqli_free_result($result);

    //close commectiom to the datavase
    mysqli_close($conn); 
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "templates/header.php"; ?>

    <h4 class="center grey-text"> Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza):?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="img/pizza.svg" alt="Pizza" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza["title"]);?></h6>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ingredients):?>
                                    <li><?php echo htmlspecialchars($ingredients); ?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id']; ?>" class="brand-text">more info</a>
                        </div>
                    </div>
                </div>

            <?php endforeach;?>
        </div>
    </div>
    <?php include "templates/footer.php"; ?>
</html>