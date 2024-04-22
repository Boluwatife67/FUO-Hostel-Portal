let complaintForm = document.getElementById("Complaint");
let ComplaintType = document.getElementById("ComplaintType");
let ComplaintDescription = document.getElementById("ComplaintDesc");
let complaintRoom = document.getElementById("roomNO");

let isValid;
function checktype() {
  if (ComplaintType.value == 0) {
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
function checkRoom() {
  if (complaintRoom.value == "") {
    complaintRoom.style.border = "2px solid red";
    isValid = false;
  }
}
document.getElementById("subt").addEventListener("click", function(){
  isValid = true;
  checktype();
  checkDesc();
  checkRoom();

  if (isValid) {
    ComplaintType.style.border = "none";
    ComplaintDescription.style.border = "none";
    let modalUp = document.getElementById("modal");
    let firstPop = document.getElementById("first-modal");
    let secondPop = document.getElementById("second-modal");
    let cancelBtn = document.getElementById("danger");
    let submitBtn = document.getElementById("proceed");
    const submitButtonValue = document.getElementById('submitButtonValue');

    modalUp.style.display = "flex";
    firstPop.style.display = "block";
    secondPop.style.display = "none";

    cancelBtn.addEventListener("click", function () {
      modalUp.style.display = "none";
      firstPop.style.display = "none";
      secondPop.style.display = "none";
    });
    submitBtn.addEventListener("click", function () {
      firstPop.style.display = "none";
      // secondPop.style.display = "block";
      submitButtonValue.value = 'submitButtonValue';
     complaintForm.submit();

    });
  }
});
