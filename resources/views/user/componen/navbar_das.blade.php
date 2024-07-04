<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #fff;
            border-bottom: 2px solid #00f;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar .logo span {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }
        .navbar .logo span span {
            color: #00f;
        }
        .navbar a {
            text-decoration: none;
            color: #333;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .navbar a:hover {
            color: #00f;
        }
        .navbar .cta {
            background-color: #00f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .navbar .cta:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src={{ asset('assets/img/logo.jpg') }} alt="Logo">
            <span><span></span>Home Clean</span>
        </div>
        <div>``
            <a href="#order" class="cta">Pesan Sekarang!</a>
        </div>
    </nav>
</body>
</html>`
