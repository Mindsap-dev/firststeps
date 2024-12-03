<!Doctype html>
<html lang="en">

<head>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewerport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./section-3/simple.css" />
        <title>Document</title>
    </head>    <title>Document</title>
</head>

<body>
    <pre><?php
include 'vars.php';

    if ($serverStatus === 'ok') {
        echo 'Welcome to our shit show!';
        }
else if ($serverStatus === 'error') {
    echo 'Sorry, something went wrong!';
}
else  {
        echo 'Then you already know about the shit show!!!';
    }

    ?></pre>
</body>
</html>