<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Discordian Poker</title>
</head>

<body>
    
    <div class="container" id="main_div">

        <h4>Input Format:</h4>
        <p style="margin: 0px"> Test Case </p>
        <p>Bet-amount <span><i>space</i></span> Round</p>

        <div>
            <label for="textarea">Enter Number of rounds: </label>
            <textarea name="test_case" id="textarea" cols="30" rows="" class="mt-3" placeholder="Test Cases 
Bet Rounds" style="white-space: pre-wrap;"></textarea>
        </div>
    
        <div>
            <button type="button" id="submit">Place Bet</button>
        </div>

        <div id="output_div" class="mb-5">
            <label for="score">Your bet</label>
            <div id="score"></div>
        </div>

    </div>
    
    <script>

        let test_cases = $('#test_cases').val();
        $(document).on('click', '#submit', function() {
            let bet_info = $('#textarea').val();
            $.ajax({
                url: "{{ url('place-bet') }}",
                type: 'GET',
                data: {
                    'bet_info': bet_info,
                },
                success: function(response) {
                    if(response.status == 1) {
                        let result = response.response;
                        let html = '';
                        result.map(function(value, key) {
                            html += `<strong>Test Case ${key+1}:</strong> Result = ${value}<br>`;
                        });
                        $('#score').html(html);
                    }
                },
                error: function(response) {

                }
            })
        })
    </script>
</body>
</html>