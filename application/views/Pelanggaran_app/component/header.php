<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelanggaran SMP IT Asy-Syadzili</title>
    <link href="<?= base_url('inc/component/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('inc/component/select2.min.css'); ?>" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #f39c12, #3498db, #2ecc71, #e74c3c);
            background-size: 400% 400%;
            animation: gradientAnimation 12s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(30, 144, 255, 0.8);
            border-color: #1e90ff;
        }

        .card-header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            border-bottom: 0;
            padding: 1rem;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #bdc3c7;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
        }
    </style>
</head>
<body>