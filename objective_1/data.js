// Creating a simple Car class that includes attributes like name, model, and year.

class Car {
  constructor(year, name, model) {
    this.year = year;
    this.name = name;
    this.model = model;
  }
}

// Creating two derived classes, ElectricCar and GasCar, which inherit from the Car class.

class ElectricCar extends Car {
  constructor(year, name, model, batteryCapacity) {
    super(year, name, model);
    this.batteryCapacity = batteryCapacity;
  }
}

class GasCar extends Car {
  constructor(year, name, model, fuelEfficiency) {
    super(year, name, model);
    this.fuelEfficiency = fuelEfficiency;
  }
}
