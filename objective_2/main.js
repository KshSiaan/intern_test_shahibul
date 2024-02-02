// Access of all the elements and variables here (0)
let carname = document.getElementById("name");
let model = document.getElementById("model");
let year = document.getElementById("year");
let battCap = document.getElementById("battCap");
let fuel = document.getElementById("fuel");
let cardBox = document.getElementById("cardBox");
let electric = document.getElementById("electric");
let gas = document.getElementById("gas");

let electricCar;
let gasCar;

//Creating objects out of Datas from Data.js (1)
//data recieved from (0)

function createObject() {
  if (electric.checked) {
    electricCar = new ElectricCar(
      parseInt(year.value),
      carname.value,
      model.value,
      parseInt(battCap.value)
    );
    return {
      x: electricCar,
    };
  }
  if (gas.checked) {
    gasCar = new GasCar(
      parseInt(year.value),
      carname.value,
      model.value,
      parseInt(fuel.value)
    );
    return {
      x: gasCar,
    };
  }
}

//Form submit operation
// gets output object from (1) -> Placed Datas in html from Cardbox from (0)

function carformSubmit() {
  let Data = createObject().x;
  cardBox.innerHTML = `
    <p>${Data.year} ${Data.name} ${Data.model}</p>
      <br />
  `;
  if (Data instanceof ElectricCar) {
    cardBox.innerHTML += `Battery Capacity: ${Data.batteryCapacity}`;
  } else {
    cardBox.innerHTML += `Fuel Efficiency:  ${Data.fuelEfficiency}`;
  }

  prepareData(Data);
}

//External DOM manipulation in case of Car type switching
function typeSelected(x) {
  let cap = document.getElementById("Cap");
  let fuelCap = document.getElementById("FuelCap");
  if (x == "electric") {
    carType = "electric";
    cap.style.display = "flex";
    fuelCap.style.display = "none";
    if (!battCap.hasAttribute("required")) {
      battCap.setAttribute("required", "required");
    }
    fuel.removeAttribute("required");
  } else {
    carType = "gas";
    cap.style.display = "none";
    fuelCap.style.display = "flex";
    if (!fuel.hasAttribute("required")) {
      fuel.setAttribute("required", "required");
    }
    battCap.removeAttribute("required");
  }
}

//preparing data for PHP

function prepareData(x) {
  //AJAX request
  console.log("Data to be sent:", x);

  $.ajax({
    url: "script.php",
    type: "POST",
    data: { action: JSON.stringify(x) },
    success: function () {
      //If needed
    },
    error: function (error) {
      console.log(error);
    },
  });
}
new DataTable("#example");
