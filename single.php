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
$database = DB_DATABASE;
?>

    <h2>Backup a specific database(<?php echo $database; ?>)</h2>
    <a href="index.php">< Back</a>
    <br/>
    <br/>

    <ol>
<?php
$filePath = EXPORT_PATH;
if (!file_exists($filePath)) {
    mkdir($filePath);
}
$filePath .= date('Y-m-d') . '/';
if (!file_exists($filePath)) {
    mkdir($filePath);
}
$filePath .= $database . date('_H-i-s') . '.sql';

print_r("<li>Process started...</li>");
try {
    exec("mysqldump --user={$dbUser} --password={$dbPass} --host={$dbHost} {$database} --result-file={$filePath} 2>&1", $output);
    if ($output[0] == 'mysqldump: [Warning] Using a password on the command line interface can be insecure.') {
        array_splice($output, 0, 1);
    }
    if (count($output) !== 0) {
        echo "<li style='color: orange'>";
        print_r($output);
        echo "</li>";
    }
} catch (Exception $e) {
    print_r("<li style='color: #FF0000;'>" . $e->getMessage() . "</li>");
    echo "<li style='color: #FF0000;'>Failed...</li>";
    return;
}

print_r("<li>Exported file => $filePath </li>");
print_r("<li style='color: green;'>Completed!</li>");
return;