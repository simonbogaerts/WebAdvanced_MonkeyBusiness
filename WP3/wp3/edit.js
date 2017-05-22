function validateFormOnSubmit() {
    var formId = document.forms["eventForm"]["id"].value;
    var formPerson = document.forms["eventForm"]["person_id"].value;
    var formStart = document.forms["eventForm"]["start_date"].value;
    var formEnd = document.forms["eventForm"]["end_date"].value;

    fetch('http://172.16.17.129/~user/MonkeyBusinessWP3/events/'+formId+'/', {
        method: 'POST',
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded'
        }),
        body: 'id=' + formId + '&person_id=' + formPerson + '&start_date=' + formStart + '&end_date=' + formEnd
    }).then(function(response) {
    }).then(function(jsonObject) {
        console.log(jsonObject);
    });
    location = "edit.php?id="+formId;
    return false;
};



fetch('http://172.16.17.129/~user/MonkeyBusinessWP3/events/'+eventId+'/'
).then(function(response) {
    // Convert to JSON
    return response.json();
}).then(function(jsonObject) {
    text = '<h2>Edit event</h2>'
        + '<form name="eventForm" onsubmit="return validateFormOnSubmit(this)">'
            + 'Event id: <input type="text" name="id" value="'+ eventId +'" disabled><br>'
            + 'Person id: <input type="text" name="person_id" value="'+ jsonObject.person_id +'" ><br>'
            + 'Start Date: <input type="text" name="start_date" value="'+ jsonObject.start_date +'" ><br>'
            + 'End Date: <input type="text" name="end_date" value="'+ jsonObject.end_date +'" ><br>'
            + '<input type="submit" value="Submit">'
        + '</form>';
    text = text + "</ul>"
    var el = document.getElementById("content");
    el.innerHTML = text;
    console.log(jsonObject);
});


