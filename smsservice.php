<?php
include "nusoap-0.9.5/lib/nusoap.php"; //Soap Library.

try {
    // Create a soap client using SoapClient class
    // Set the first parameter as null, because we are operating in non-WSDL mode.
    // Pass array containing url and uri of the soap server as second parameter.
    $client = new soapclient(null, array(
        'location' => "http://localhost/hello/HelloServer.php",
        'uri' => "http://localhost/hello"));

    // Read request parameter
    $param = $_POST['name'];

    // Invoke AddHello() method of the soap server (HelloServer)
    $result = $client->AddHello($param);
    echo $result; // Process the the result
}
catch(SoapFault $ex) {
    $ex->getMessage();
}

