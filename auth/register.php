<?php
require_once(__DIR__ . '/../config/config.php'); // Ensure this points to your Database class
require_once(__DIR__ . '/validation.php'); // Ensure this points to your User class
session_start();

$database = Database::getInstance();
$pdo = $database->getConnection();
$user = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $userId = $user->register($name, $email, $password);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_type'] = 'user';

            header("Location: login.php");
            exit();
        }
    } catch (Exception $e) {
        echo 'Registration failed: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register || User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100" style="background-image: url(''); background-size: cover; background-position: center;">

<div class="min-h-screen flex items-center justify-center p-4">
    <div class="flex flex-col md:flex-row bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <div class="w-full md:w-1/2 flex items-center justify-center border-b md:border-b-0 md:border-r border-gray-300 p-4">
            <h2 class="text-xl md:text-2xl font-bold text-center">Welcome to Sari-Sari Store Inventory Management System</h2>
        </div>
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-xl md:text-2xl font-bold mb-6 text-center">Create Your Account</h2>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Register</button>
                   <div class="mt-4 text-center">
                    <span class="text-gray-700">Already have an account? <a href="./login.php" class="text-blue-500 hover:text-blue-600">Login here.</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
