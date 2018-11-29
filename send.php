<?php
    define('SERVER_API_KEY','AIzaSyDOQo6-5LT8FMwTKz5NQO-aMkm2aDKWaXM');
    $tokens = ['ePOSh5QzzHc:APA91bEt23SFH-G3MCThQP-
        _Oj1KcSL7FmHKhh862eVF3X0SBButVSQROXC1wRFE2j0eGhUVoUFW0IgKeeGNybIOzLjc_QbArH
        onS6MQVph8-sFl_Kat8NbRROQ_LvVruVFv6xUQe2LZ'];
    $header =[
        'Authorization: key='.SERVER_API_KEY,
        'Content-Type: Application/json'
    ];
    $msg =[
        'title' => 'Se acabó el semestre',
        'body' => 'Espero hayas aprendido cosas nuevas en esta materia',
        'icon' => 'img/educ-app.png',
        'img' => 'img/image.png',
    ];
    $payload = array(
        'registration_ids' => $tokens,
        'data' => $msg
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode( $payload ),
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => $header
       ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
?>
       