<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agricultural Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('https://uppercrust.com/products/plant-based/plant-based-header_hufe359559874e65c3041f3e0e38d95ee6_575595_500x500_fill_q40_box_center.jpg') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        nav {
            background: rgba(0, 0, 0, 0.8);
            width: 100%;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .blog-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            max-width: 800px;
            width: 90%;
            text-align: justify;
            line-height: 1.6;
            margin-top: 20px;
        }

        h1 {
            color: #f9bf77;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
            color: #ddd;
            font-size: 1.1em;
            line-height: 1.8;
        }

        form {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
        }

        input, select {
            width: calc(100% - 22px); /* Adjusted width for consistency */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="date"] {
            width: calc(100% - 26px); /* Adjusted width for consistency */
        }

        button {
            background-color: #ffc107;
            color: #222;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button:hover {
            background-color: #ffa000;
        }
    </style>
</head>
<body>

<div class="blog-container">
    <h1>Form</h1>
    <form action="store.php" method="post">
        <table>
            <tr>
                <td><label for="name">Farmer Name:</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="location">Location</label></td>
                <td><input type="text" id="location" name="location" required></td>
            </tr>
            <tr>
                <td><label for="surveynumber">Survey Number:</label></td>
                <td><input type="number" id="surveynumber" name="surveynumber" required></td>
            </tr>
            <tr>
                <td><label for="crop">Crop Grown:</label></td>
                <td><input type="text" id="crop" name="crop" required></td>
            </tr>
            <tr>
                <td><label for="acers">Number of Acres:</label></td>
                <td><input type="number" id="acers" name="acers" required></td>
            </tr>
            <tr>
                <td><label for="market">Market</label></td>
                <td><input type="text" id="market" name="market" required></td>
            </tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" id="date" name="date" required></td>
            </tr>
        </table>

        <button type="submit" name="submit" value="submit" onclick="navigateToKYM()">Submit</button>

<script>
function navigateToKYM() {
    window.location.href = "KYM.html";
}
</script>
    </form>
</div>

</body>
</html>
