fetch('http://172.16.17.129/~user/MonkeyBusiness/events/'
).then(function(response) {
    // Convert to JSON
    return response.json();
}).then(function(jsonObject) {
    var text = "<ul>";
    for(var i in jsonObject) {
        text = text + "<li> Event "+jsonObject[i].id+"</li>"
            +"<ul>"
            +"<li> Person "+jsonObject[i].person_id+"</li>"
            +"<li> Start Date "+jsonObject[i].start_date+"</li>"
            +"<li> End Date "+jsonObject[i].end_date+"</li>"
            +"</ul>"
    }
    text = text + "</ul>"
    var el = document.getElementById("content");
    el.innerHTML = text;
    console.log(jsonObject);
});