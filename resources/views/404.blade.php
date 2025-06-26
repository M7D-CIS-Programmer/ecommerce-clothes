<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #222;
            color: #f4f4f4;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            font-size: 8rem;
            margin: 0;
            color: #ff4747;
        }
        p {
            font-size: 1.5rem;
            margin: 10px 0 20px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 1.2rem;
            color: #222;
            background: #f4f4f4;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }
        .btn:hover {
            background: #ff4747;
            color: #fff;
            transform: scale(1.05);
        }
        img {
            max-width: 400px;
            width: 80%;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Page Not Found!</p>
        <img src="/images/Error.jpg" alt="Modern fashion error illustration">
        <a href="/" class="btn">Take Me Home</a>
    </div>
</body>
</html>
