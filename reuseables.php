<?php 
$reuseables = array(
                    "XIMAGE" => array('jpg', 'jpeg', 'png', 'gif'),
                    "XVIDEO" => array('mp4', 'mkv', 'avi', '3gp'),
                    "XAUDIO" => array('mp3', 'm4a', 'wav', 'opus'),
                    "XFILE" => array('txt', 'pdf', 'docx'),
                    "XMAIL" => array(
                                        'top' =>   '<!DOCTYPE html> <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--> <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--> <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--> <!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]--> <html> <head>         <meta charset="utf-8">         <meta http-equiv="X-UA-Compatible" content="IE=edge">         <title></title>         <meta name="description" content="">         <meta name="viewport" content="width=device-width, initial-scale=1"> <style> body{     background: #000000; color: white; padding: 5px; min-width: 250px; max-width: 700px; margin: auto; overflow: scroll } header{ text-align: center; margin-bottom: 10px; } main{ padding: 5px; background: #eeeeee; color: black; } .text-center{ text-align: center; } .dis{ display: block; width: 70%; text-align: center; margin: auto; } footer{ text-align: center; color: white; } a{ text-decoration: none; } footer a{ color: white; }         </style>     </head>     <body>         <!--[if lt IE 7]> <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>         <![endif]-->                  <header> <img src="' . LOGO . '" width="100px" alt="mazydap.com logo">         </header>         <main>',
                                        'bottom' => '</main> <footer>     <div>         <a href="https://mazzydap.com/works">Designs</a> | <a href="https://mazzydap.com/contact">Support</a> | <a href="https://mazzydap.com/about">Offices</a>     </div>     <div>         support@mazzydap.com / ticket@mazzydap.com / info@mazzydap.com <br> +123455678     </div> </footer></body></html>'
                                    ),
                    "MUSER" => 'support@mazzydap.com',
                    "MPASS" => 'MazzyDap12',
                    "MFROM" => 'MazzyDap',
                    "MHOST" => 'mazzydap.com',
                    "MCC" => 'support@mazzydap.com'

                );

foreach($reuseables as $key => $value){
    define($key, $value);
}

$header = $title1 = $page = '';
?>
