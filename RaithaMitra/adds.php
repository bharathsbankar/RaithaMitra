<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .video-wrapper {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .video-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding: 5px 10px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="video-wrapper">
            <video autoplay loop muted>
                <source src="v1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-wrapper">
            <video autoplay loop muted>
                <source src="v2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-wrapper">
            <video autoplay loop muted>
                <source src="v3.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <a href="KYM.php" class="back-button">&#8678; Back</a>
    </div>
</body>
</html>
