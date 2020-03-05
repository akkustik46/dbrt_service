<?php
if('shoxaey2do1Eol6' == $_GET['key']) {
    echo '<pre> Update...' . PHP_EOL;

 $dir = '/usr/www/users/dbrtac/service';
//    $dir = '/home/dbrt/dbrt.com.ua/service/';
    exec("cd $dir && /usr/bin/git pull 2>&1", $output);
    $output = [];
    //exec("cd $dir && /usr/bin/git fetch --all 2>&1", $output);
    print_r($output);
    $output = [];
    exec("cd $dir && /usr/bin/git reset --hard origin/master 2>&1", $output);
    print_r($output);

    echo '<hr> Done.' . PHP_EOL;

}
else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found.';
    exit;
}

?>
