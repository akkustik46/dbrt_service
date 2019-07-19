<?php
if('Chie6kahquieteih' == $_GET['key']) {
    echo '<pre> Update...' . PHP_EOL;

    $dir = '/home/dbrt/dbrt.com.ua/shamans-bike/';
    exec("cd $dir && /usr/bin/git pull 2>&1", $output);
    $output = [];
    //exec("cd $dir && /usr/bin/git fetch --all 2>&1", $output);
    print_r($output);
    $output = [];
    exec("cd $dir && /usr/bin/git reset --hard origin/shamans-bike 2>&1", $output);
    print_r($output);

    echo '<hr> Done.' . PHP_EOL;

}
else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found.';
    exit;
}

?>
