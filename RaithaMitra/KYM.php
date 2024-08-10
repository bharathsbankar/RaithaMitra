<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Know Your Market</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url('https://w0.peakpx.com/wallpaper/849/471/HD-wallpaper-turbines-among-fields-and-vineyards-in-fog-vineyards-turbines-colors-fields-fog.jpg'); /* Replace 'background-image.jpg' with your actual image file */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            color: #333;
            animation: slideInDown 1s ease-in-out;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .input-field {
            margin-bottom: 20px;
            animation: slideInRight 1s ease-in-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            animation: slideInLeft 1s ease-in-out;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Know Your Market</h1>
        
        <div class="input-field">
            <label for="location">Select Location:</label>
            <select id="location" onchange="showCrops()" style="animation-delay: 0.5s;">
                <option value="Chinthamani">Chinthamani</option>
                <option value="Pandavapura">Pandavapura</option>
            </select>
        </div>

        <div class="input-field" id="cropField" style="display: none;" style="animation-delay: 1s;">
            <label for="cropGrown">Select Crop Grown:</label>
            <select id="cropGrown">
                <!-- Options for Location 1 -->
                <option value="crop1">Crop 1</option>
                <option value="crop2">Crop 2</option>
            </select>
        </div>

        <button class="btn" id="kypBtn" style="animation-delay: 1.5s;" onclick="redirectToFile()">KYP</button>
    </div>

    <script>
        function showCrops() {
            var location = document.getElementById("location").value;
            var cropField = document.getElementById("cropField");

            // Reset the options
            document.getElementById("cropGrown").innerHTML = "";

            if (location === "Chinthamani") {
                // Show options for Location 1
                cropField.style.display = "block";
                var cropSelect = document.getElementById("cropGrown");
                var crops = ["Onion", "Capsicum"];
                for (var i = 0; i < crops.length; i++) {
                    var option = document.createElement("option");
                    option.text = crops[i];
                    option.value = crops[i].toLowerCase(); // Use lowercase for filenames
                    cropSelect.add(option);
                }
            } else if (location === "Pandavapura") {
                // Show options for Location 2
                cropField.style.display = "block";
                var cropSelect = document.getElementById("cropGrown");
                var crops = ["SugarCane", "Raagi"];
                for (var i = 0; i < crops.length; i++) {
                    var option = document.createElement("option");
                    option.text = crops[i];
                    option.value = crops[i].toLowerCase(); // Use lowercase for filenames
                    cropSelect.add(option);
                }
            } else {
                // Hide the crop field for other locations
                cropField.style.display = "none";
            }
        }

        function redirectToFile() {
            var location = document.getElementById("location").value.toLowerCase();
            var crop = document.getElementById("cropGrown").value;
            var fileName = location + "_" + crop + ".php";
            window.location.href = fileName;
        }
    </script>
</body>
</html>
