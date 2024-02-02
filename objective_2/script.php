<?php
if (isset($_POST["action"])) {
    $data = json_decode($_POST["action"], true);

    if (isset($data["year"], $data["name"], $data["model"])) {
        $year = $data["year"];
        $name = $data["name"];
        $model = $data["model"];

        // Check if it's an electric or gas car based on the presence of batteryCapacity or fuelEfficiency
        if (isset($data["batteryCapacity"])) {
            $capacity = $data["batteryCapacity"];
            $type = "Electric";
        } elseif (isset($data["fuelEfficiency"])) {
            $capacity = $data["fuelEfficiency"];
            $type = "Gas";
        } else {
            header("Content-Type: application/json");
            echo json_encode([
                "status" => "error",
                "message" => "Missing batteryCapacity or fuelEfficiency",
            ]);
            exit(); // Stop further execution
        }
        header("Content-Type: application/json");
        echo json_encode(["status" => "success"]);

        $conn = new mysqli("localhost", "root", "", "car_db");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            //SQL injection
            $stmt = $conn->prepare(
                "INSERT INTO cars (year, name, model, type, capacity) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("issss", $year, $name, $model, $type, $capacity);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode([
            "status" => "error",
            "message" => "Missing fields in the JSON object",
        ]);
    }
}
