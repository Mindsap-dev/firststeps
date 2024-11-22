<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewerport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./simple.css" />
    <title>Document</title>
</head>

<body>
    <pre><?php

        $greeting= 'I\'m a string';
    echo $greeting . '!!!' . $greeting;
    echo '<br>';

    $name='Dennis';
    $subject='PHP';
    echo 'I\'m ' . $name . ' and I am learning to develop in ' . $subject;

    echo '<br>';
    echo "I'm {$name} and I am learning to develop in {$subject}";

  ?>  </pre>
</body>
</html>