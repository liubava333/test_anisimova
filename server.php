<?php
include "nusoap-0.9.5/lib/nusoap.php";
// Описание функции Web-сервиса
// На полках a, b, c, d, e храниться определенное кол-во товара.
function getStock($id) {
    $stock = [
        "a" => 100,
        "b" => 200,
        "c" => 300,
        "d" => 400,
        "e" => 500
    ];
    if (isset($stock[$id])) {
        $quantity = $stock[$id];
        return $quantity;
    } else {
        //return 0;
        throw new SoapFault("Server", "Несуществующий id товара");
    }
}

/* // Тестируем перед тем, как отдать клиенту в виде ответа.
echo getStock("b");
echo getStock("z");
exit; */

// Отключение кэширования WSDL-документа
ini_set("soap.wsdl_cache_enabled", "0"); // отключаем для тестирования, т.к файлы очень хорошо кешируются
// Создание SOAP-сервер
$server = new SoapServer("http://localhost/stock.wsdl");
// Добавить класс к серверу
$server->addFunction("getStock"); // эта функция будет видна клиенту
// Запуск сервера
$server->handle();
?>