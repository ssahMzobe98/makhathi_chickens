<?php

namespace Mmshightech\interfaceLet;

interface IDaoFactory
{
    public static function make(string $daoClass, array $array);

}
