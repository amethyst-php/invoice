<?php

namespace Railken\LaraOre\Tests\Invoice;

use Railken\LaraOre\Support\Testing\ApiTestableTrait;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return '/api/v1/admin/invoices';
    }

    public function signIn()
    {
        $response = $this->post('/api/v1/sign-in', [
            'username' => 'admin@admin.com',
            'password' => 'vercingetorige',
        ]);

        $access_token = json_decode($response->getContent())->data->access_token;

        $this->withHeaders(['Authorization' => 'Bearer '.$access_token]);

        return $response;
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->signIn();
        $this->commonTest($this->getBaseUrl(), $parameters = $this->getParameters());
    }
}
