<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Custom button styles */
        .btn-gradient {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(45deg, #0056b3, #00a2cc); /* Darker shade on hover */
            color: white;
        }

        .btn-danger:hover {
            background-color: #b02a37; /* Darker red for danger button on hover */
        }

        /* Adjustments for button hover */
        .btn-warning:hover {
            background-color: #ffca2b; /* A brighter yellow for edit button */
            color: white;
        }

        /* Make sure table looks more appealing */
        .table-hover tbody tr:hover {
            background-color: #2c2c2c;
        }
        /* Add this to your CSS file or <style> section */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
    @yield('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Task Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">

            </li>
            <li class="nav-item">

            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </div>
</nav>

@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
