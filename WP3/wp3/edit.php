<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WP3</title>
    <link rel="stylesheet" type="text/css" href="layout.css">
</head>
<body>

<div class="topnav">
    <a class="active" href="#home">Home</a>
    <a href="#about">About</a>
</div>

<div id="container">
    <h2>Test table</h2>
    <label for="eventIdInput">Event ID</label>
    <input type="text" id="eventIdInput" placeholder="Geef Event ID in..">
    <div id="formInput">
        <button id="getOne">Get one</button>
        <button id="getAll">Get all</button>
    </div>

    <div id="content"></div>

</div>
<script type="text/javascript">
    var eventId = <?php echo $_GET["id"]; ?>
</script>
<script type="text/javascript" src="edit.js"></script>
<script type="text/javascript" src="buttons.js"></script>
</body>
</html>