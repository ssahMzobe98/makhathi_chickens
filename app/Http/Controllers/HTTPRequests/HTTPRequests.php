<?php
namespace App\Http\Controllers\HTTPRequests;
use Mmshightech\interfaceLet\IHTTPRequests\IHTTPRequests;
class HTTPRequests implements IHTTPRequests{
	protected $headers;
    protected $uri;
    protected $method;
    protected $body;
    protected $data;
    protected $tokenData;
    protected $cookies;
    public function __construct()
    {
        $data = (empty($_REQUEST)) ? [] : $_REQUEST;
        $body = file_get_contents("php://input");
        $this->body = $body;
        $json = [];
        try {
            $json = json_decode($body, true);
        } catch (\JsonDecodingException $e) {
            $json = [];
        }
        if (!empty($json)) {
            $data = array_merge($data, $json);
        }
        $this->data = $data;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders();
        $this->cookies = $_COOKIE;
    }
    public function getHttpData(): array
    {
        return $this->data;
    }
    public function getUri(): string
    {
        return $this->uri;
    }
    public function getMethod(): string
    {
        return $this->method;
    }
    public function getBody(): string
    {
        return $this->body;
    }
    public function getHeaders(): array
    {
        return $this->headers;
    }
    public function addData(array $data): bool
    {
        $this->data = array_merge($this->data, $data);
        return true;
    }
    public function getCookies(): array
    {
        return $this->cookies;
    }
    public function addTokenData($data): void
    {
        $this->tokenData = $data;
    }
    public function getTokenData(): \stdClass
    {
        return $this->tokenData;
    }
}

?>