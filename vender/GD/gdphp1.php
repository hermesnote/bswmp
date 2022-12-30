<!DOCTYPE html>
<html>

<head>
    <title>Sample script for uploading file to Google Drive without authorization</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
</head>

<body>
    <form action="https://script.google.com/macros/s/AKfycby1vMXvjrDmxS_7NIUjT2xV_LuOBkjpnAaU5sDIP88wTeql20ev/exec" id="form" method="post">
        Upload a file
        <div id="data"></div>
        <input name="file" id="uploadfile" type="file">
        <input id="submit" type="submit">
    </form>
    <script>
    $('#uploadfile').on("change", function() {
        var file = this.files[0];
        var fr = new FileReader();
        fr.fileName = file.name;
        fr.onload = function(e) {
            e.target.result
            html = '<input type="hidden" name="data" value="' + e.target.result.replace(/^.*,/, '') + '" >';
            html += '<input type="hidden" name="mimetype" value="' + e.target.result.match(/^.*(?=;)/)[0] + '" >';
            html += '<input type="hidden" name="filename" value="' + e.target.fileName + '" >';
            $("#data").empty().append(html);
        }
        fr.readAsDataURL(file);
    });
    </script>
</body>

</html>