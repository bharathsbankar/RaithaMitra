<!DOCTYPE HTML>
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .fetch-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
    }
    .fetch-btn:hover {
        background-color: #0056b3;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<script>
function fetchData() {
    const formData = new FormData();
    formData.append('crop', 'sugarcane');

    fetch('fetch_data.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        displayTable(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function displayTable(data) {
    let table = document.getElementById('data-table');
    table.innerHTML = '';

    let headerRow = table.insertRow(0);
    headerRow.insertCell(0).innerText = 'Market';
    headerRow.insertCell(1).innerText = 'Date';
    headerRow.insertCell(2).innerText = 'Month';
    headerRow.insertCell(3).innerText = 'Quantity';

    data.forEach(row => {
        let tr = table.insertRow();
        tr.insertCell(0).innerText = row.market;
        tr.insertCell(1).innerText = row.date;
        tr.insertCell(2).innerText = row.month;
        tr.insertCell(3).innerText = row.quantity;
    });
}
</script>
</head>
<body>
<button class="fetch-btn" onclick="fetchData()">Fetch Data</button>
<table id="data-table"></table>
</body>
</html>
