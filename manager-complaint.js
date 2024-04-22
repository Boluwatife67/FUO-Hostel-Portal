let complaintForm = document.getElementById("complaintt");
let ComplaintType = document.getElementById("ComplaintType");
let ComplaintDescription = document.getElementById("ComplaintDesc");


let isValid;
function checkType() {
  if (ComplaintType && ComplaintType.value == "none") {
    ComplaintType.style.border = "2px solid red";
    isValid = false;
  }
}
function checkDesc() {
  if (ComplaintDescription.value == "") {
    ComplaintDescription.style.border = "2px solid red";
    isValid = false;
  }
}
document.getElementById("subt").addEventListener("click", function(){
  isValid = true;
  checkType();
  checkDesc();

  if (isValid) {
    // ComplaintType.style.border = "none";
    // ComplaintDescription.style.border = "none";
    let modalUp = document.getElementById("modal");
    let overlay = document.getElementById("overlay");
    // let firstPop = document.getElementById("first-modal");
    // let secondPop = document.getElementById("second-modal");
    let cancelBtn = document.getElementById("danger");
    let submitBtn = document.getElementById("proceed");
    const submitButtonValue = document.getElementById('submitButtonValue');

    overlay.classList.remove("hidden");
    modalUp.classList.remove("hidden");

    cancelBtn.addEventListener("click", function () {
        overlay.classList.add("hidden");
        modalUp.classList.add("hidden");
    });
    submitBtn.addEventListener("click", function () {
        overlay.classList.add("hidden");
        modalUp.classList.add("hidden");
      // secondPop.style.display = "block";
      submitButtonValue.value = 'submitButtonValue';
     complaintForm.submit();

    });
  }
});
