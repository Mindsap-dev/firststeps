<?php
// Generate options for dropdowns
function generateOptions($start, $end, $suffix = "", $step = 1) {
    $options = "";
    for ($i = $start; $i <= $end; $i += $step) {
        $value = $suffix ? number_format($i, 0, '.', ',') . $suffix : $i;
        $options .= "<option value=\"$i\">$value</option>";
    }
    return $options;
}

// Generate percentage options
function generatePercentageOptions($start, $end, $default) {
    $options = "";
    for ($i = $start; $i <= $end; $i++) {
        $selected = ($i == $default) ? " selected" : "";
        $options .= "<option value=\"$i\"$selected>{$i}%</option>";
    }
    return $options;
}
?>
