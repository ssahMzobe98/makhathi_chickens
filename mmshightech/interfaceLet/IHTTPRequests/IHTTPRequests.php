<?php
namespace Mmshightech\interfaceLet\IHTTPRequests;
interface IHTTPRequests{
	public function getHttpData(): array;
    public function getUri(): string;
    public function getMethod(): string;
    public function getBody(): string;
    public function getHeaders(): array;
    public function addData(array $data): bool;
    public function getCookies(): array;
    public function addTokenData($data): void;
    public function getTokenData(): \stdClass;
}
?>