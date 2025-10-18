<?
$lines = file('log/log.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    list($dt, $page, $ref) = explode('|', $line);
    echo "<li>" . htmlspecialchars("$dt - $page -> $ref") . "</li>";
}
?>
