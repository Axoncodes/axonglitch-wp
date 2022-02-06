<html>
<head>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>

<form method="post" id="testform">
    <input type="text" name="test" />
    <button type="submit" id="testform_sub">submit</button>
</form>

    <script>
        $(function () {
            $('#testform').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'http://pilotscollege.com/caspian/regex_form.php',
                data: $('#testform').serialize(),
                
                // beforeSend: function() {
                // 	alert("Please wait..");
                // },
                success: function () {
                    alert('form was submitted');
                },
                error: function (e) {
                    alert("Failed to save");
                }
            });
            });
        });
    </script>


</body>
</html>
