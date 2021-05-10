<?php

namespace Anax\View;

/**
 * Geolocation
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($di);
?><h1><?= $title ?></h1>

<p>
    The documentation behind this service can be found <a href="<?= url("documentation/weather"); ?>">here</a>
</p>

<div class="form-wrapper">
    <form method="post">
        <label class="label">Location:</label>
        <input type="text" name="location" value=""><br><br>
        <input class="button save" type="submit" name="doSubmit" value="SUBMIT">
    </form>
</div>

<?php if ($location) : ?>
    <?php include "result.php" ?>
<?php endif ?>