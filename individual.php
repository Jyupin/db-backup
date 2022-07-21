<?php
/**
 * Created by PhpStorm.
 * User: jyupinkukadiya
 * Date: 21/7/22
 * Time: 9:54 AM
 */

require_once "config.php";

$dbHost = DB_HOST;
$dbUser = DB_USERNAME;
$dbPass = DB_PASSWORD;
?>

<h2>Backup all database in individual file for each database</h2>
<a href="index.php">< Back</a>
<br/>
<br/>

<?php
$dbConnection = mysqli_connect($dbHost, $dbUser, $dbPass);
$result = mysqli_query($dbConnection, "SHOW DATABASES");

$dateStr = date('Y-m-d');
$timeStr = date('_H-i-s');
function removeWarning()
{
    return "grep -v 'mysqldump: [Warning] Using a password on the command line interface can be insecure.'";
}

while ($row = mysqli_fetch_array($result)) {
    if ($row[0] == 'information_schema' || $row[0] == 'mysql' || $row[0] == 'sys' || $row[0] == 'performance_schema')
        continue;
    $database = $row[0];

    print_r("Process started for: $database");
    print_r("<ol>");
    $filePath = EXPORT_PATH;
    if (!file_exists($filePath)) {
        mkdir($filePath);
    }
    $filePath .= date('Y-m-d') . '/';
    if (!file_exists($filePath)) {
        mkdir($filePath);
    }
    $filePath .= $database . $timeStr . '.sql';

    try {
        unset($output);
        exec("mysqldump --user={$dbUser} --password={$dbPass} --host={$dbHost} {$database} --result-file={$filePath} 2>&1 | " . removeWarning(), $output);
        echo "<li style='color: orange'>";
        print_r($output);
        echo "</li>";
    } catch (Exception $e) {
        print_r("<li style='color: #FF0000;'>" . $e->getMessage() . "</li>");
        echo "<li style='color: #FF0000;'>Failed...</li>";
        echo "</ol><br/>============================<br/>";
        continue;
    }

    print_r("<li>Exported file => $filePath </li>");
    print_r("<li style='color: green;'>Completed!</li>");
    echo "</ol><br/>============================<br/>";
    continue;
}
?>
<br>
<br>
All databased exported...

