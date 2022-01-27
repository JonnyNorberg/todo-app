<?php

require 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <title>To do app in php</title>
</head>
<body>

    <!--Main content -->
    <div class="main">
        <div class="add-section">
            <form action="add.php" method="POST" autocomplete="off">

            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" name="title" style="background-color: #FF6B82"  placeholder="Required field" />
                <button type="submit">Add +</button>

            <?php }else{ ?>
                <input type="text" name="title" placeholder="Add something here" />
                <button type="submit">Add +</button>
                <?php } ?>

            </form>
        </div>

        <?php
            $todos = $conn ->query("SELECT * FROM todos ORDER BY id DESC");
        ?>

        <!--Show todo list -->
        <div class="show-todos">

            <?php if($todos->rowCount() > 0){ ?>

            <!--item-->
            <div class="todo-item">
            <input type="checkbox">
            <h2>School test</h2>
            <p class="text">Prepare fot the test</p>
            <h5>Created 2022/01/22</h5>
            </div>
            <!--item-->
            <?php } ?>


            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>

            <!--item-->
            <div class="todo-item">
                <span id="<?php echo $todo['id']; ?>" class="remove">X</span>

                    <?php if($todo['checked']){ ?>
                    <input type="checkbox" class="check-box" checked />
                    <h2 class="checked"> <?php echo $todo['title'] ?> </h2>
                        <?php }else { ?> 

                    <input type="checkbox" class="check-box" />
                    <h2> <?php echo $todo['title'] ?> </h2>
                        <?php } ?>

                <p class="text">Buy milk, sås, bread, butter and meat.</p>
                <h5>Created: <?php echo $todo['date_time'] ?> </h5>

            </div>
            <!--item-->
            <?php } ?>

        </div>
    </div>
    <!--Main content -->

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
    
</body>
</html>