<div class="errors-container">
    <?php
    if (count($errors) != 0) {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
    ?>
</div>