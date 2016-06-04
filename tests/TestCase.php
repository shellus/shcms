<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://laravel.localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    /**
     * @return mixed
     * @throws Exception
     */
    public function getJson()
    {
        $content = $this->response->getContent();

        $json = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('no json!');
        }

        return $json;
    }

    /**
     * @param $url
     * @param string $method
     * @param array $data
     * @param array $headers
     * @return \anlutro\cURL\Request
     */
    public function curl($url, $method = 'GET', $data = [], $headers = []){
        return curl($this -> baseUrl . $url, $method, $data, $headers);
    }
}
