<?php 

namespace Geekbrains\Application1\Models;

class SiteInfo {
    private string $webServer;
    private string $phpVersion;
    private string $userAgent;

    function __construct() {
        $this->webServer = $_SERVER['SERVER_SOFTWARE'];
        $this->phpVersion = phpversion();
        $this->userAgent = $_SERVER["HTTP_USER_AGENT"];
    }

    function getWebServer() {
        return $this->webServer;
    }

    function getPhpVersion() {
        return $this->phpVersion;
    }
    function getUserAgent() {
        return $this->userAgent;
    }

    function getInfo() {
        return [
            "server" => $this->webServer,
            "phpversion" => $this->phpVersion,
            "userAgent" => $this->userAgent
        ];
    }
}