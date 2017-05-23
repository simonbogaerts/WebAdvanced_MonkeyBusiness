fetch('http://localhost/MonkeyBusinessWP3/events/'
).then(function(response) {
    // Convert to JSON
    return response.json();
}).then(function(jsonObject) {
    var text = "<tr><th>Event ID</th><th>Name ID</th><th>Start date</th><th>End date</th></tr>";
    for(var i in jsonObject) {
        text = text + "<tr>" +
                "<td>"+jsonObject[i].id+"</td>" +
                "<td>"+jsonObject[i].person_id+"</td>" +
                "<td>"+jsonObject[i].start_date+"</td>" +
                "<td>"+jsonObject[i].end_date+"</td>" +
            "</tr>";
    }
    text = text + "</ul>"
    var el = document.getElementById("content");
    el.innerHTML = text;
    console.log(jsonObject);
});