const t1 = document.getElementById("hourr");
const t2 = document.getElementById("min");
const t3 = document.getElementById("sec");
const ch = document.getElementById("changee");
const myDate = document.getElementById("dayy");
const monthNames = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
const dayNames = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];

function bolu() {
  let hourss = new Date().getHours();
  let minutess = new Date().getMinutes();
  let secondss = new Date().getSeconds();
  let dayyy = new Date().getDay();
  let dd = new Date().getDate();
  let monthh = new Date().getMonth();
  let yearr = new Date().getFullYear();
  if (hourss >= 12) {
    ch.innerHTML = "PM";
  } else {
    ch.innerHTML = "AM";
  }
  if (hourss > 12) {
    hourss = hourss - 12;
  }
  if (hourss > 9) {
    hourss = `${hourss}`;
  } else {
    hourss = `${0}` + `${hourss}`;
  }

  if (minutess < 10) {
    minutess = `${0}` + `${minutess}`;
  }
  if (secondss < 10) {
    secondss = `${0}` + `${secondss}`;
  }
  t1.innerHTML = hourss;
  t2.innerHTML = minutess;
  t3.innerHTML = secondss;
  myDate.innerHTML = `${dayNames[dayyy]} ${dd} ${monthNames[monthh]}, ${yearr}.`;
}
setInterval(bolu, 1000);

// greetings function
function greetMe() {
  let myGreeting = document.getElementById("greett");

  let greetingss = new Date().getHours();
  if (greetingss >= 0 && greetingss < 12) {
    myGreeting.innerHTML = "Good Morning,";
  } else if (greetingss > 11 && greetingss < 16) {
    myGreeting.innerHTML = "Good Afternoon,";
  } else {
    myGreeting.innerHTML = "Good Evening,";
  }
}
setInterval(greetMe, 1000);

let logclose = document.getElementById("logclose");

setTimeout(function(){
  logclose.style.display='none';
}, 5000);

