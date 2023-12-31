<?php

namespace Classes\DBConnect;

use Classes\traits\DBConnectTrait;
use Mmshightech\interfaceLet\IDBConnect;
use Mmshightech\mmshightech;

class DBConnect implements IDBConnect
{
    use DBConnectTrait;

    public function getConnection()
    {
        return $this->connect->connection;
    }

    public function rollBack()
    {
        return $this->connect->connection->rollBack();
    }

    public function getConnectionClass():mmshightech
    {
        return $this->connect;
    }
    public function DBClose(){
        return $this->connect->connection->close();
    }
}
