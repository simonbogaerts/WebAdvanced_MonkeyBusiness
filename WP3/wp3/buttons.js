document.getElementById("getAll").onclick = function () {
    location.href = "http://172.16.17.129/~user/MonkeyBusinessWP3/wp3/";
};

document.getElementById("getOne").onclick = function () {
    var eventId = document.getElementById("eventIdInput");
    location.href = "http://172.16.17.129/~user/MonkeyBusinessWP3/wp3/edit.php?id="+eventId.value;
};