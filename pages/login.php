<!-- <?php session_start(); ?> -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIDOKU</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Body */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('pages/Tubankab.png') no-repeat center center fixed;
            background-size: contain;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Container */
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Input */
        .login-container input[type="username"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        /* Button */
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #218838;
        }

        .login-container small {
            display: block;
            margin-top: 10px;
            color: #666;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-container">
        <h2><i class="fas fa-user-lock"></i> Login</h2>
        <form action="index.php?page=cek_login" method="post">
            <label for="username" class="form-label">Username</label>
            <input type="username" name="username" required>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <small>SIDOKU Kabupaten Tuban</small>
    </div>

</body>

</html>