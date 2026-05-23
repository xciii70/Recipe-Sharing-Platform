<?php

$db = new PDO("sqlite:private/members.db");

$result = $db->query("SELECT * FROM Member");

foreach ($result as $row) {
    echo $row['name'] . PHP_EOL;
    echo $row['email'] . PHP_EOL;
    echo $row['bio'] . PHP_EOL;
    echo "-------------------" . PHP_EOL;
}

?>
