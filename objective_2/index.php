<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Objective 2</title>
  <script src="data.js"></script>
  <script defer src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/jquery-3.7.0.js">
  <link rel="stylesheet" href="style/normalize.css" />
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <form id="carForm" onsubmit="carformSubmit();">
    <section>
      <div class="">
        <label for="name">Enter Name: </label>
        <input type="text" id="name" name="name" required />
      </div>
      <div class="">
        <label for="model">Enter model:</label>
        <input type="text" id="model" name="model" required />
      </div>
    </section>
    <section>
      <div class="">
        <label for="year">Enter year: </label>
        <input type="number" id="year" name="year" required />
      </div>
      <div class="Cap" id="Cap">
        <label for="battCap">Enter battery capacity (kWh): </label>
        <input type="number" id="battCap" name="battCap" />
      </div>
      <div class="FuelCap" style="display: none" id="FuelCap">
        <label for="fuel">Enter fuel efficiency (MPG):</label>
        <input type="number" id="fuel" name="fuel" />
      </div>
    </section>
    <section>
      <div class="carType">
        <p>Enter car type:</p> &nbsp; <input type="radio" name="carType" id="electric" value="Electric" onclick="typeSelected('electric')" checked />
        <label for="electric">Electric</label> &nbsp; <input type="radio" name="carType" id="gas" value="Gas" onclick="typeSelected('gas')" />
        <label for="gas">Gas</label>
      </div>
    </section>
    <button type="submit">Submit</button>
  </form>
  <h3>Card information:</h3>
  <div class="cardBox" id="cardBox"></div>
  <!-- <button onclick="callPhpFunction()">Call PHP Function</button> -->
  <div class="tablePLace">
    <table id="example" class="table table-striped" style="width: 100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>Year</th>
          <th>Name</th>
          <th>Model</th>
          <th>Capacity/Efficiency</th>
          <th>Type</th>
        </tr>
      </thead> <?php

                $conn = new mysqli("localhost", "root", "", "car_db");

                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                } else {
                  $query = "SELECT * FROM cars";
                  $res = $conn->query($query);

                  if (!$res) {
                    die("INVALID QUERY: " . $conn->error);
                  }

                  while ($row = $res->fetch_assoc()) {
                    echo "
                            <tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["year"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["model"] . "</td>
                                <td>" . $row["capacity"] . "</td>
                                <td>" . $row["type"] . "</td>
                            </tr>
                        ";
                  }
                }

                ?>
      <tbody>
    </table>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="main.js"></script>

</html>