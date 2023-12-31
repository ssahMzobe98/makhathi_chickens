<?php

namespace Mmshightech\interfaceLet;

interface IDBConnect
{
    public function getConnection();
    public function rollBack();
    public function getConnectionClass();
    public function DBClose();
}
