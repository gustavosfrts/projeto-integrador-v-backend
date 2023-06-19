<!doctype html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificação</title>
</head>
<body>

<select id="produtos">
    <option value="1">KAILANI REVERB</option>
    <option value="2">NARCISO DELAY</option>
    <option value="3">HELIOS OVERDRIVE</option>
</select>

<button id="btn">Enviar notificação para este produto</button>

<script type="text/javascript">

    let btn = document.getElementById("btn");
    btn.addEventListener('click', event => {
        let produto_id = document.getElementById("produtos")
        console.log(produto_id)
        enviar(produto_id);
    });

    async function enviar(produto) {
        const url = window.location.href;

        const response = await fetch(url+"api/notificacao/enviar", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: `{
                "produto_id": ${produto.value}
            }`,
        });

        response.json().then(data => {
            console.log(JSON.stringify(data));
        });
    }

</script>

</body>
</html>
