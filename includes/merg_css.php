<?php
$css_files = array(
    "styles/header.css",
    "styles/scroll.css",
    "styles/index.css",
    "styles/footer.css",
    "styles/login-signup.css"
);

// Loop through the array and include each CSS file dynamically
foreach ($css_files as $css_file) {
    echo '<link rel="stylesheet" href="' . $css_file . '">' . "\n";
}
?>