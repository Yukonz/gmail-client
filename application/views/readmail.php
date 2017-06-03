<div id='readmail'>
    <h4><?php echo $mail['header']?></h4>
    <hr>

    Получатель:  <?php echo $mail['to'][0]->mailbox . "@" . $mail['to'][0]->host        ?>  <br>
    Отправитель: <?php echo $mail['from'] . " " .  $mail['fromaddress'] ?>  <br>
    Дата:        <?php echo $mail['date']                               ?>  <br>

    <?php
    echo "<hr>";
    echo $mail['body'];
    ?>

</div>