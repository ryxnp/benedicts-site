
function lettersonly(input) {
    var regex = /[^a-z]/gi;
    input.value = input.value.replace(regex, "");
}

function numbersonly(input) {
    var regex = /[^0-9.]/g;
    input.value = input.value.replace(regex, "");
}

var today = new Date();
var dd = today.getDate() + 3;
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("visitDate").setAttribute("min", today);