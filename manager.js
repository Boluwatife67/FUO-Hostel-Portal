var toggle = document.getElementById("nav-toggle");
var nav = document.getElementById("nav");
var html = document.documentElement;
var body = document.body;

toggle.addEventListener("click", function () {
  nav.classList.toggle("is-open");
  if (nav.classList.contains("is-open")) {
    html.style.overflow = "hidden";
    body.style.overflow = "hidden";
  } else {
    html.style.overflow = "";
    body.style.overflow = "";
  }
});

// Get all div elements with id starting with "status"
let divElements = document.querySelectorAll('[id ="statuss"]');

// Loop through all div elements
for (let i = 0; i < divElements.length; i++) {
    let divElement = divElements[i];

    // Check the text inside the div
    if (divElement.innerText == "Pending") {
      
        divElement.style.backgroundColor = "Orange";
    } else if (divElement.innerText == "Completed") {
        // If the text is "completed", set the background color to green
        divElement.style.backgroundColor = "green";
    }
    else if (divElement.innerText == "Rejected") {
       // If the text is "completed", set the background color to green
       divElement.style.backgroundColor = "red";
   }
   else if (divElement.innerText == "Approved") {
       // If the text is "completed", set the background color to green
       divElement.style.backgroundColor = "#6AAF07";
   }
}




