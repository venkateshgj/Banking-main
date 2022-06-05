<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home Page</title>
</head>

<body>
    
    <div class="bg-img"></div>
    <div align="center">
        <h1>Basic Banking System</h1>
    </div>
    <a href="/Banking/customers.php">
    <button type="button" class="btn btn-info">View Customers</button>
    </a>

    
</body>
<style>
    * {
        margin: 0;
        padding: 0;
      
    }
    .btn
    {
        width:24%;
        height:9%;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 40%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-48%, 116%);
        background-color: rgb(1, 1, 37);
        border: 2px solid rgb(1,1,37);
        font-weight:bold;
    }
    h1
    {
        width:-12%;
        height:9%;
        margin: 0;
        position: absolute;
        top: -10%;
        left: 40%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-48%, 116%);
        color:white;
    }
    .bg-img {
        background-image: url('./bg.webp');
        background-size: cover;
        background-repeat: no-repeat;
        /* width: 200px; */
        height: 100vh;
        top: -10%;
        left: 40%;
    }
</style>

</html>