<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PaymentsTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected string $token = '';

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->token = $user->createToken('test')->plainTextToken;
    }

    /**
     * @test
     *
     * @group api
     */
    public function unauthenticatedUserCannotAccessEndpoints(): void
    {
        $this->getJson(route('api.v1.payments.index'))->assertUnauthorized();
        $this->getJson(route('api.v1.payments.signature'))->assertUnauthorized();
        $this->postJson(route('api.v1.payments.store'))->assertUnauthorized();
    }

    /**
     * @test
     *
     * @group api
     */
    public function indexWorks(): void
    {
        $response = $this->withToken($this->token)->getJson(route('api.v1.payments.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([]);
    }

    /**
     * @test
     *
     * @group api
     */
    public function signatureWorks(): void
    {
        $response = $this->withToken($this->token)->getJson(route('api.v1.payments.signature'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['url']);
    }

    /**
     * @test
     *
     * @group api
     */
    public function storeWorks(): void
    {
        $response = $this->withToken($this->token)->getJson(route('api.v1.payments.signature'));

        $url = $response['url'];
        $data = [
            'payer_name' => '::test::',
            'payer_email' => 'test@test.com',
            'payer_address' => '::test::',
            'amount' => 123.45,
            'currency' => 'eur',
            'provider' => 'test',
        ];

        $response = $this->withToken($this->token)->postJson($url, $data);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'data' => $data,
        ]);
    }
}