<?php
highlight_file(__FILE__);
// var_dump($_POST);
if (isset($_POST["s_1.1"])) {
    echo "level 1"."<br>";
    if (';' === preg_replace('/[^\W]+\((?R)?\)/', '', $_POST['cmd'])) {
        if (!preg_match('/high|get_defined_vars|scandir|var_dump|read|file|php|curent|end/i', $_POST['cmd'])) {
            echo 'success!'.'<br>';
            eval($_POST['cmd']);
        }
    }
} else {
    echo "nonono 1";
}
