document.getElementById("getAll").onclick = function () {
    location.href = "/MonkeyBusinessWP3/wp3/";
};

document.getElementById("getOne").onclick = function () {
    var eventId = document.getElementById("eventIdInput");
    location.href = "/MonkeyBusinessWP3/wp3/edit.php?id="+eventId.value;
};