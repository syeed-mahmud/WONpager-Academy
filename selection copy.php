<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

$servername = "sql311.infinityfree.com";
$db_username = "if0_38190079";
$db_password = "SyeWon2025";
$dbname = "if0_38190079_wonpager";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$module_access_list = [];

$username = $_SESSION['user_name'];

// Fetch access for all modules as soon as the page is loaded
$stmt = $conn->prepare("SELECT mod1, mod2, mod3, mod4, mod5, mod6 FROM userlist WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($mod1, $mod2, $mod3, $mod4, $mod5, $mod6);
    $stmt->fetch();

    // Store access levels in an array for all modules
    $module_access_list = [
        'module1' => $mod1,
        'module2' => $mod2,
        'module3' => $mod3,
        'module4' => $mod4,
        'module5' => $mod5,
        'module6' => $mod6
    ];
}

$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $module = $_POST['module'];

    // Check module access for the requested module
    $module_access = $module_access_list[$module] ?? false;

    if ($module_access) {
        $_SESSION['module'] = $module;

        // Redirect to the appropriate module page
        header("Location: $module.php");
    exit;
} else {
        echo "<script>alert('You don\'t have access to that module.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Library</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background-image: url('images/bg image.jpg');
            background-color: aquamarine;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .custom-button:hover {
            background-color: #00233F;
            border-color: #00233F;
        }

        .custom-logo{
            /* background-color: antiquewhite; */
            position: absolute;
            top: 370px;
            right: 270px;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        /* Color styles for module access */
        .has-access {
            background-color: rgba(40, 167, 69, 0.5) !important; /* green with transparency */
        }

        .no-access {
            background-color: rgba(220, 53, 69, 0.5) !important; /* red with transparency */
        }

        .card {
            background-color: transparent !important; /* Transparent card background */
            border: solid 2px #000000;
            width: 300px;
        }

        /* Layout for two columns */
        .module-grid {
             display: grid;
             grid-template-columns: 1fr 1fr; /* Two equal-width columns */
             gap: 10px; /* Gap between both rows and columns */
            }
            /* style=" margin-left: 350px; */

        /* Reduce the size of the module name and shift it right */
        .module-title {
            font-size: 1.2rem; /* Smaller font size */
            margin-left: auto; /* Pushes the text to the right */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <a href="logout.php" class="logout-btn btn btn-danger">Logout</a>
                <img src="images/logo image.png" alt="Wonpager Logo" class="img-fluid custom-logo" width="200" >
                <h1 class="display-10 mt-2" style="font-weight: bold; color: #00233F; position: absolute; right: 60px; top:120px">Library of WONpager modules</h1>
            </div>
        </div>

        <form method="POST" action="">
            <div class="module-grid mt-5 " style=" position:absolute; top: 400px; right:50px">
                <?php
                $modules = [
                    'module1' => '1 page Strategic Plan',
                    'module2' => 'Executive Project Management',
                    'module3' => 'Executive Coaching and Leadership Development',
                    'module4' => 'Vital Diagnostics and imperatives to address',
                    'module5' => 'WONlife',
                    'module6' => 'WONworld'
                ];

                foreach ($modules as $module_key => $module_title) {
                    // Determine if the user has access to this module
                    $has_access = $module_access_list[$module_key] ?? false;
                    $access_class = $has_access ? 'has-access' : 'no-access';
                    ?>
                    <div class="card">
                        <div class="card-body d-flex align-items-center <?php echo $access_class; ?>">
                            <button type="submit" name="module" value="<?php echo $module_key; ?>" class="btn btn-secondary btn-sm custom-button"> <?php echo ucfirst($module_key); ?></button>
                            <h5 class="ms-3 mb-0 module-title"><?php echo $module_title; ?></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
