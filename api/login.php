    <?php
    // Authenticate a user.

    
    // Requires. init. php.
    try {
        require_once '../utils/init.php';
    } catch (Throwable $exp) {
    }
    
    // Attempts to authenticate a user.

    
    // Checks if the request method is POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $validation = [];

        // Validates the password field if required.
        if (!isset($_POST['password'])) {
            $validation['password'] = 'Password field is required.';
        } else {
            $password = $_POST['password'];
        }

        if (isset($_POST['username'])) {
            $username = $_POST['username'];

            // Fetch all users.
            if (isset($password)) {
            
                $query = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
                $query->execute([$username, $username]);
                $user = $query->fetchAll();

                if (!is_array(($user)) || count($user) === 0) {
                    $validation['username'] = 'Username or password is incorrect.';
                    $validation['password'] = 'Username or password is incorrect.';
                } else {
                    $user = $user[0];
                    if (password_verify($password, $user['password'])) {
                        // Login successful
                        $token = bin2hex(random_bytes(64));
                        $user['auth_token'] = $token;
                        $expiration = strtotime('+1 day', time());
                        $user['auth_expire'] = date('Y-m-d H:i:s', $expiration);

                        setcookie('auth', $user['auth_token'], $expiration);

                        $query = $pdo->prepare("UPDATE users SET auth_token = ?, auth_expire = ? WHERE id = ?");
                        $query->execute([$user['auth_token'], $user['auth_expire'], $user['id']]);
                        header("Location: index.php");
                        die();
                    } else {
                        // Login failed, bad password
                        $validation['username'] = 'Username or password is incorrect.';
                        $validation['password'] = 'Username or password is incorrect.';
                    }
                }
            }
        } else {
            $validation['username'] = 'Username field is required.';
        }
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../signupstyles.css">
 <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    

    </head>
<body>
<?= include_once __DIR__ . '/../includes/nav.php' ?>


    <h1 class="nav-margin">LOGIN</h1>

    <form class="signup" method="POST">
        <div>
            <label>Username or email address</label>
            <input type="text" name="username" value="<?= isset($username) ? $username : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['username'])) {
            ?>
            <span><?= $validation['username'] ?></span>
            <?php
            }
            ?>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?= isset($password) ? $password : '' ?>" />
            <?php
            if (isset($validation) && isset($validation['password'])) {
            ?>
            <span><?= $validation['password'] ?></span>
            <?php
            }
            ?>
        </div>

        <input type="submit" value="Log in" />
    </form>
</body>
</html>