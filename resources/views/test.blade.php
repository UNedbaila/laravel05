<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<script>function test(event){
        // event.preventDefault()
        // console.log(event)
        // alert(Hello_World!)
        axios.get('/api/categories').then((res) => {
            let categories = res.data
            console.log(categories.data)

        })
    }
</script>
<body>

    <button onclick="test()">Start!</button>

</body>
</html>
