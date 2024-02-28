// declaring the switch buttons
let studentBut = document.getElementById('studentlog');
let managerBut = document.getElementById('managerlog');
let worksBut = document.getElementById('workslog');

// declaring the login
let studentLogin = document.getElementById('studentlogin');
let ManagersLogin = document.getElementById('managerslogin');
let worksLogin = document.getElementById('workslogin');

let firstfill = document.getElementById('fill1');
let secondfill = document.getElementById('fill2');
let thirdfill = document.getElementById('fill3');

studentBut.addEventListener('click', function(){
    studentLogin.style.display = 'block';
    ManagersLogin.style.display = 'none';
    worksLogin.style.display = 'none';
    studentBut.style.background = '#6AAF07';
    managerBut.style.background = '#003b1f';
    worksBut.style.background = '#003b1f';
    firstfill.style.color = 'white';
    secondfill.style.color = '#6AAF07';
    thirdfill.style.color = '#6AAF07';
});
managerBut.addEventListener('click', function(){
    studentLogin.style.display = 'none';
    ManagersLogin.style.display = 'block';
    worksLogin.style.display = 'none';
    studentBut.style.background = '#003b1f';
    managerBut.style.background = '#6AAF07';
    worksBut.style.background = '#003b1f';
    firstfill.style.color = '#6AAF07';
    secondfill.style.color = 'white';
    thirdfill.style.color = '#6AAF07';
});
worksBut.addEventListener('click', function(){
    studentLogin.style.display = 'none';
    ManagersLogin.style.display = 'none';
    worksLogin.style.display = 'block';
    studentBut.style.background = '#003b1f';
    managerBut.style.background = '#003b1f';
    worksBut.style.background = '#6AAF07';
    firstfill.style.color = '#6AAF07';
    secondfill.style.color = '#6AAF07';
    thirdfill.style.color = 'white';
});
