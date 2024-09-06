<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1B1E23;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .welcome-container {
            text-align: center;
        }
        .welcome-header {
            font-size: 3rem;
            font-weight: bold;
            color: #7289DA;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }
        .welcome-subtitle {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 30px;
            color: #b0b3b8;
            animation: fadeIn 2s ease-in-out;
        }
        .welcome-buttons .btn {
            margin: 0 10px;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out;
            animation: fadeInUp 2s ease-in-out;
        }
        .welcome-buttons .btn-primary {
            background-color: #7289DA;
            border: none;
        }
        .welcome-buttons .btn-primary:hover {
            background-color: #5D72B3;
        }
        .welcome-buttons .btn-outline-light:hover {
            background-color: #5D72B3;
            color: #fff;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <h1 class="welcome-header animate__animated animate__fadeInDown">Welcome to Task Manager</h1>
    <p class="welcome-subtitle animate__animated animate__fadeIn">Organize your tasks effortlessly and boost your productivity!</p>
    <div class="welcome-buttons">
        <a href="{{ route('login') }}" class="btn btn-primary animate__animated animate__fadeInUp">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-light animate__animated animate__fadeInUp">Register</a>
    </div>
</div>
</body>
</html>
