<?php

class DatabaseClient
{
    private $name;
    private $password;
    private $port;
    private $host;
    private $data;

    public function __construct($host, $port, $name, $password)
    {
        $this->name = $name;
        $this->password = $password;
        $this->port = $port;
        $this->host = $host;
        $this->data = array();
    }

    private function makeId($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        $result = '';
        $counter = 0;
        while ($counter < $length) {
            $result .= $characters[rand(0, strlen($characters) - 1)];
            $counter += 1;
        }
        return $result;
    }

    private function sendRequest($payload)
    {
        $client = stream_socket_client($this->host . ':' . $this->port, $errno, $errstr);
        $processId = $this->makeId(5);

        stream_set_blocking($client, 0);

        $requestData = json_encode($payload) . "\n";
        fwrite($client, $requestData);

        $response = '';
        $timeout = 3; 
        $start = time();

        while ((time() - $start) < $timeout) {
            $response .= fread($client, 8192);
            if (strpos($response, "\n") !== false) {
                break;
            }
            usleep(1000);
        }

        fclose($client);

        return json_decode(trim($response), true);
    }

    public function createTable($name)
    {
        $payload = [
            'action' => 'create_table',
            'table' => ['name' => $name],
            'login' => [
                'name' => $this->name,
                'password' => $this->password
            ],
            'process' => $this->makeId(5)
        ];

        return $this->sendRequest($payload);
    }

    public function set($table, $name, $value)
    {
        $payload = [
            'action' => 'set_variable',
            'table' => ['name' => $table],
            'variable' => [
                'name' => $name,
                'value' => $value
            ],
            'login' => [
                'name' => $this->name,
                'password' => $this->password
            ],
            'process' => $this->makeId(5)
        ];

        return $this->sendRequest($payload);
    }

    public function delete($table, $name)
    {
        $payload = [
            'action' => 'remove_variable',
            'table' => ['name' => $table],
            'variable' => [
                'name' => $name
            ],
            'login' => [
                'name' => $this->name,
                'password' => $this->password
            ],
            'process' => $this->makeId(5)
        ];

        return $this->sendRequest($payload);
    }
}
