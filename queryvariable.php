<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewerport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./section-3/simple.css" />
    <title>Document</title>
    <style> h1 {width: 25rem; height: 10rem; background: lightgray; }</style>
</head>

<body>
<pre><?php

    $pageTitle = 'PHP is amazing!';
//    $pageTitle = '';
    var_dump(isset($pageTitle));
    ?>

    </pre>
<?php
    if(!empty($pageTitle)){
        echo '<h1>'.$pageTitle.'</h1>';
    }
?>

<?php
if(empty($selectedCoffee)){
    $selectedCoffee = 'espresso';
}
?>

<div class="coffee-info">
    <?php if ($selectedCoffee === 'espresso'): ?>
        <div id="espresso-info">
            <h1>Espresso ☕</h1>
            <p>Espresso is a concentrated coffee drink with a bold flavor. It pairs perfectly with a chocolate croissant. 🍫🥐</p>
        </div>

    <?php else: ?>
        <div id="drip-coffee-info">
            <h1>Drip Coffee ☕</h1>
            <p>Drip coffee, a staple in many routines, is known for its straightforward brewing process and comforting, familiar taste. Perfect for starting your morning or as a midday pick-me-up. ☕️🌅</p>
        </div>

    <?php endif; ?>
</div>
</body>
</html>