<?php 
$reuseables = array(
    "XIMAGE" => array('jpg', 'jpeg', 'png', 'gif'),
    "XVIDEO" => array('mp4', 'mkv', 'avi', '3gp'),
    "XAUDIO" => array('mp3', 'm4a', 'wav', 'opus'),
    "XFILE" => array('txt', 'pdf', 'docx'),
    "XMAIL" => array(
                        'top' =>   '<!DOCTYPE html><html lang="en"><link href="'. FAVI . '" rel="icon">
                                    <body style="background: #eee;"><div style="background-color: white; margin: auto; border-radius: 7px;">
                                            <div style="background-color: #323232; padding: 10px; font-family: '. "'Quicksand'" . ', sans-serif; text-align: center;">
                                                <img src="' . LOGO .'" width="150px" style="margin: auto;" alt="zilotrade">
                                            </div>
                                            <div style="min-width: 200px; max-width: 600px; margin: 0 auto; background: #ffffff; text-align: left; padding: 35px; color: black; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 15px;">',

                        'bottom' => '</div><footer style="font-size: 11px; margin-top: 10px; font-family: sans-serif; text-align: center;">
                                        <div style="background: linear-gradient(
                                            45deg
                                            , #673ab7, #9c27b0); color: #fff; padding: 15px;">
                                            <span>Citylounge Nord, Messepli 4005 Basel, Switzerland</span>
                                        </div>
                                        <div style="background: linear-gradient(
                                            45deg
                                            , #673ab7, #9c27b0); padding: 10px; color: #0e3c00;">
                                            <p style="margin: 0; color: #ffffff; display: block;">support@zilotrade.com</p>
                                        </div></footer></div></body></html>'
                    ),
    "MUSER" => 'support@zilotrade.com',
    "MPASS" => 'Chibuike2020',
    "MFROM" => 'ZiloTrade',
    "MHOST" => 'smtp.titan.email',
    "MCC" => 'support@zilotrade.com'

                );

foreach($reuseables as $key => $value){
    define($key, $value);
}

$header = $title1 = $page = '';
?>
