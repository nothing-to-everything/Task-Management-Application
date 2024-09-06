<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1B1E23;
            font-family: 'Poppins', sans-serif;
        }
        .card-header {
            background-color: #7289DA;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn {
            transition: background-color 0.3s ease-in-out;
        }
        .btn:hover {
            background-color: #5D72B3;
        }
        .form-control {
            background-color: #2C2F33;
            color: #ffffff;
            border: 1px solid #495057;
            border-radius: 5px;
        }
        .form-control:focus {
            background-color: #2C2F33;
            border-color: #7289DA;
            color: #ffffff;
            box-shadow: none;
        }
        .invalid-feedback {
            color: #E57373;
        }
        .text-info {
            color: #7289DA;
        }
        .text-info:hover {
            color: #5D72B3;
        }
        .animate__fadeIn {
            animation-duration: 1s;
        }
    </style>
    @yield('styles')
</head>
<body>
@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
