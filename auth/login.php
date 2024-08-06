<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . 'validation.php');
session_start();

$database = new Database();
$pdo = $databse->getPDO();
$user = new User($pdo);

//check if user already aacount
 if (isset($_SESSION['user_id'])) {
  //location if user or admin
  header("location:  ");
  exit();
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userData = $user->validateLogin($email,$password);
        if ($userData) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['name'];
            $_SESSION['user_type'] = $userData['type'];

        if($userData['type'] == 'admin') {
            header("location");
        } else {
            header("location");
        }
        }
    }
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || user</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100" style="background-image: url(''); background-size: cover; background-position: center";>

<div class="min-h-screen flex items-center justify-center">
    <div class="flex bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <div class="w-1/2 flex items-center justify-center border-r border-gray-300">
            <h2 class="text-2xl font-bold  text-center">Welcome to Sari-Sari store <br> Inventory managament system</h2>


        </div>
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Login your account</h2>
            <form action="" method="POST">
                <!-- <div class="mb-4">
                    <label for="name" class="block text-gray-700">Username</label>
                    <input type="text" name="name" id="name" placeholder="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div> -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" placeholder="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" placeholder="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <span class="" >if you have alrready account? </span><a href="login.php">login here.</a>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Login</button>
                 <div class="mt-4 text-center">
                    <span class="text-gray-700">I you have not account <a href="./register.php" class="text-blue-500 hover:text-blue-600">Register here.</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
