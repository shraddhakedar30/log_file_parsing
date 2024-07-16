<?php


$logFilePath = 'C:\Users\ASUS\Desktop\php\sample.log';


if (!file_exists($logFilePath)) {
    die("Log file does not exist!");
}

$logFileContent = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$authorizedUsers = [];
$authSuccessfulUsers = [];
$invalidSessionUsers = [];
$msgCounts = [
    'Authorized access' => 0,
    'Authentication successful' => 0,
];

foreach ($logFileContent as $line) {
    preg_match('/user=(\w+)/', $line, $userMatches);
    preg_match('/msg="([^"]+)"/', $line, $msgMatches);
    
    if (!empty($userMatches[1]) && !empty($msgMatches[1])) {
        $userId = $userMatches[1];
        $msg = $msgMatches[1];
        
        if ($msg === "Authorized access") {
            $msgCounts['Authorized access']++;
            $authorizedUsers[$userId] = true;
        } elseif ($msg === "Authentication successful") {
            $msgCounts['Authentication successful']++;
            $authSuccessfulUsers[$userId] = true;
        } elseif ($msg === "Request does not have a valid session") {
            $invalidSessionUsers[$userId] = true;
        }
    }
}

$validAuthorizedUsers = array_diff_key($authorizedUsers, $invalidSessionUsers);
$validAuthSuccessfulUsers = array_diff_key($authSuccessfulUsers, $invalidSessionUsers);

echo "Authorized Access Users:\n";
foreach ($validAuthorizedUsers as $userId => $value) {
    echo "User: $userId\n";
}

echo "\nAuthentication Successful Users:\n";
foreach ($validAuthSuccessfulUsers as $userId => $value) {
    echo "User: $userId\n";
}

echo "\nMessage Counts:\n";
foreach ($msgCounts as $msg => $count) {
    echo "Message: $msg - Count: $count\n";
}

?>