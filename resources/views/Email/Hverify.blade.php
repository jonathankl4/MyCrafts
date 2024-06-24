<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
    <style>
        body{
            background-color: #bafc8e;
            background-image: linear-gradient(62deg, #8efc92 0%, #c3fccc 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Please Check Your Email!</h1>
        <p>Please verify the email by clicking verify button in your email</p>
        <form action="{{ url('/') }}">
            @csrf
            <button class="btn btn-danger" type="submit">Go Back</button>
        </form>
    </div>
</body>
</html>
