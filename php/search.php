<?php
include '..\php\db_connection.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM events WHERE name LIKE ? OR description LIKE ? 
                            UNION 
                            SELECT * FROM programs WHERE name LIKE ? OR description LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
   <style>
    .container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
   
}

input[type="text"] {
    width: 70%;
    padding: 10px;
    margin-right: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    

}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.result {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
}

.result h2 {
    margin: 0;
    color: #333;
}

.result p {
    color: #555;
}

.result img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 4px;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Search Results</h1>

        <?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='result'>";
        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        if (!empty($row['picture'])) {
            // Corrected the path to ensure it's fetching the image properly
            $imagePath = '../img/' . htmlspecialchars($row['picture']);
            
            // Check if the file exists before displaying
            if (file_exists($imagePath)) {
                echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($row['name']) . "'>";
            } else {
                echo "<p>Image not found.</p>"; // Error message if the image file is not found
            }
        }
        echo "</div>";
    }
} else {
    echo "<p>No results found for your search query.</p>";
}
?>


        <a href="..\html\home.html">Back to Home</a>
    </div>
</body>
</html>
