<?php
/**
 * devindex
 * A simple PHP tool to place in your development environment's 
 * public_html directory.
 * 
 * Assume's installation of:
 *  webgrind - git clone https://github.com/jokkedk/webgrind.git
 *  adminer  - git clone https://github.com/vrana/adminer/
 *             git submodule update --init
 * 
 * @version 0.0.1
 * @author https://github.com/webworker01
 * @link https://github.com/webworker01/devindex
 * @since PHP 7.0.25
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$special = [
    'phpinfo.php' => 'PHP Info',
    'memcache.php' => 'Memcache Stats',
    'ocp.php' => 'OPCache Stats 3',
    'op.php' => 'OPCache Stats 2',
    'opcache.php' => 'OPCache Stats',
    'webgrind' => 'Webgrind',
    'adminer' => 'Adminer - Database Tool',
];

$ignorefiles = [
    'index.php',
    '.gitignore',
    'composer.phar',
];

$dir_open = opendir('.');
$files = [];
$dirs = [];
$tools = [];

while(false !== ($filename = readdir($dir_open))){
    if($filename != "." && $filename != ".."){
        if (is_dir($filename) && !array_key_exists($filename, $special)) {
            $dirs[] = $filename;
        } elseif (!array_key_exists($filename, $special) && !in_array($filename, $ignorefiles)) {
            $files[] = $filename;
        } elseif (array_key_exists($filename, $special)) {
            $tools[] = $filename;
        }
    }
}

closedir($dir_open);
?>
<!doctype html>
<html>
    <head>
        <style>
            body {
                background-color: #0A0A0A;
                color: #EBEBEB;
                margin:0;
                padding:0;
            }

            a {
                color: #4298B5;
            }
            
            .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: flex-start;
                margin:0;
            }
            
            ul {
                flex: 1;
                flex-direction: column;
                flex-grow: 1;
                border-left: 1px solid rgba(255, 255, 255, 20);
                border-right: 1px solid rgba(255, 255, 255, 20);
                padding-left: 10%;
                height: 100vh;
                
                margin: 0 auto;
            }
            
            ul li:first-child {
                font-weight:900;
                font-size:1.1em;
            }  
            
            ul li {
                list-style-type:none;
            }


        </style>
    </head>
    <body>
        <div class="row">
            <ul>
                <li>Tools</li>
                <?php foreach ($tools as $file): ?>
                    <li><a href="<?= $file; ?>"><?= $special[$file]; ?></a></li>
                <?php endforeach; ?>
            </ul>

            <ul>
                <li>Directories</li>
                <?php foreach ($dirs as $file): ?>
                    <li><a href="<?= $file; ?>"><?= $file; ?></a></li>
                <?php endforeach; ?>
            </ul>
            
            <ul>
                <li>Files</li>
                <?php foreach ($files as $file): ?>
                    <li><a href="<?= $file; ?>"><?= $file; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>
