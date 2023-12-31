<?php

namespace Mmshightech\interfaceLet;

interface ICleanData
{
    public function OMO(string $string);
    public function cleanAll(array $data =[]);
    public function login(string $email=null,string $pass=null);
    public function login2App(string $email=null, string $pass=null,string $app="app");
    public function lockPassWord(string $pass);
    public function verifyClientMenuStore(array $cleanData=[]);
    public function userInfo(string $agent=null);
    public function updateDomeBackground(int $dome=0,int $id=0);
}
