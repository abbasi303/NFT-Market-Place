<?php

$dbconn = [
    'host' => 'localhost',
    'db' => 'nft_users',
    'port' => '3306',
    'username' => 'abbasi303_prime',
    'password' => 'Abbasi303@A12'
];

// Error handler.
$error = new stdClass();
$error->type = 'none';

// Creates a new PDO instance
try {
    $dsn = 'mysql:host=' . $dbconn['host'] . ';dbname=' . $dbconn['db'] . ';port='.
        $dbconn['port'] . ';charset=utf8mb4';

    $pdo = new PDO($dsn, $dbconn['username'], $dbconn['password'], [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    if (isset($_COOKIE['auth'])) {
        $query = $pdo->prepare("SELECT * FROM users WHERE auth_token = ?");
        $query->execute([$_COOKIE['auth']]);
        $users = $query->fetchAll();

        if (is_array($users) && count($users) > 0) {
            if (count($users) > 1) {
                // We messed up branch
                $query = $pdo->prepare("UPDATE users SET auth_token = null, auth_expire = null WHERE id = ?");
                foreach ($users as $baduser) {
                    $query->execute([$baduser['id']]);
                }
                //TODO: scream for help!
            } else {
                $user = $users[0];
            }
        }

        // Cleanup
        unset($query);
        unset($users);
    }

} catch (PDOException $pex) {
    $error->type = 'db';
} catch (Throwable $exc) {
    $error->type = 'server';
}
