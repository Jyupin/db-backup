<?php
/**
 * Created by PhpStorm.
 * User: jyupinkukadiya
 * Date: 21/7/22
 * Time: 9:53 AM
 */
require_once "config.php";
?>
<h2> Welcome to MySql Backup Center </h2>

<ul>
    <li>Backup all databases in Single .sql file => <a href="all.php">Click here...</a></li>
    <li>Backup all database in individual file for each database => <a href="individual.php">Click here...</a></li>
    <li>Backup a specific database<b>("<?php echo DB_DATABASE; ?>")</b> => <a href="single.php">Click here...</a></li>
</ul>
