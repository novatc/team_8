<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
<div class="result">
    <p>Test</p>
</div>
<script type="text/javascript">
    var start = 0;
    var limit = 30
    var reachedMax = false

    $(window).scroll(function () {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight){
            getData()
        }

    })

    $(document).ready(function () {
        getData()
    });

    function getData() {
        if (reachedMax) return
        $.ajax({
            url: 'php/actions/inf_data.php',
            method: 'POST',
            dataType: 'text',
            data: {
                getData: 1,
                start: start,
                limit: limit
            },
            success: function (response) {
                if (response === 'reachedMax') {
                    reachedMax = true
                } else {
                    start += limit
                    $(".result").append(response)
                }
            }
        })
    }
</script>
</body>
