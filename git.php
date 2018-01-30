<?php
/*if('AhnieZ5ooh5D' == $_GET['key']) {
    echo '<pre> Update...' . PHP_EOL;

    $dir = '~/dbrt.com.ua/service';
    exec("cd $dir && /usr/bin/git pull 2>&1", $output);
    $output = [];
    //exec("cd $dir && /usr/bin/git fetch --all 2>&1", $output);
    print_r($output);
    $output = [];
    exec("cd $dir && /usr/bin/git reset --hard origin/stage 2>&1", $output);
    print_r($output);

    echo '<hr> Done.' . PHP_EOL;

}
else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found.';
    exit;
}
*/
 $dir = '~/dbrt.com.ua/service';
//exec("cd ~ && ssh-keygen -t rsa -N \"\"", $output);
exec("cd ~/.ssh/ && cat id_rsa.pub", $output);
print_r($output);
?>