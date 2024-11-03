<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Hello, world!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" href="favicon.png">
    <style>
        .body-1 {background-color: red;}
        .body-2 {background-color: green;}
        .body-3 {background-color: aqua;}
        .body-4 {background-color: yellow;}
        .body-5 {background-color: magenta;}
        .body-6 {background-color: gray;}
    </style>
</head>
<body class="body-<?php echo rand(1,6); ?>">
<?php echo '<H1>Hello from PHP!</h1>'; ?>
</body>
</html>