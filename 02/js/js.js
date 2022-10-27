"use strict";

const cars = document.querySelector("#cars");
const form = document.querySelector("form");

cars.addEventListener("change", function () {
  console.log("rood");
  if (cars.value === "follow") {
    form.setAttribute("action", "followers/result.php");
  } else {
    form.setAttribute("action", "repositories/result.php");
  }
});
