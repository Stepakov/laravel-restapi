<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        input {
            font-size: 30px;
        }
        .result div {
            font-size: 50px;
        }
    </style>
</head>
<body>

<div>
    <input type="text" name="input">
    <button>Send to GPT</button>
</div>
<div class="result">

</div>

<!--secret_key = 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-->
<script>
    let secret_key = "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"
    let html = "https://api.openai.com/v1/chat/completions"

    let input = document.querySelector( 'input[name=input]' )
    let button = document.querySelector( 'button' )
    let result = document.querySelector( '.result' )

    button.addEventListener( 'click', function( event ){
        let newDiv = document.createElement( 'div' )
        let message = input.value
        newDiv.innerHTML = message
        result.appendChild( newDiv )

        fetch( html, {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + secret_key,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                messages: [ { role: 'curie', content: message }],
                max_tokens: 20
            })
        })
            .then( res => res.json )
            .then( data => {
                console.log( data )
            })
            .catch( err => console.log( err ) )


    })



</script>
</body>
</html>
