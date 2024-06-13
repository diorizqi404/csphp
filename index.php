<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Table Example</title>
</head>

<?php
    require 'connect.php';
    $conn = getConnection();
    $getData = $conn->prepare("SELECT * FROM users");
    $getData->execute();
    $result = $getData->get_result();
?>

<body>
    <?php
        session_start();
        $username = $_SESSION['user'];
        echo "<p>" . $username . "</p>";
    ?>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">Username</th>
                <th class="py-2 px-4 border-b border-gray-200">Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($result->num_rows > 0){
                    while($r = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td class='py-2 px-4 border-b border-gray-200'>".$r['username']."</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-200'>".$r['password']."</td>";
                        echo "</tr>";
                    }
                }
            ?>
            <!-- <tr>
                <td class="py-2 px-4 border-b border-gray-200">John Doe</td>
                <td class="py-2 px-4 border-b border-gray-200">25</td>
                <td class="py-2 px-4 border-b border-gray-200">john@example.com</td>
            </tr> -->
        </tbody>
    </table>
</body>

</html>