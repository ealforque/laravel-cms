<?php

namespace Tests\Feature\Domains\Contact;

use App\Domains\Contact\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ContactEndpointsTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetContacts()
    {
        Contact::factory()->count(20)->create();

        $this->json('GET', '/api/v1/contacts', [])
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonStructure([
            'data' => [[
                'resource',
                'ruid',
            ]],
        ])
        ->assertJson(
            function (AssertableJson $json) {
                return $json
                    ->has('data', 15)
                    ->has(
                        'data.0',
                        function (AssertableJson $json) {
                            return $json
                                ->where('resource', 'contact')
                                ->whereType('ruid', 'string');
                        }
                    )
                    ->has('meta');
            }
        );
    }

    public function testGetContactsWithFields()
    {
        Contact::factory()->count(20)->create();

        $this->json('GET', '/api/v1/contacts?fields=login.username,firstname,lastname,email_address,contact_no&filter=email_address:@gmail.com&search=la', [])
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonStructure([
            'data' => [[
                'resource',
                'ruid',
                'firstname',
                'lastname',
                'contact_no',
                'email_address',
                'login',
            ]],
        ])
        ->assertJson(
            function (AssertableJson $json) {
                return $json
                    ->has(
                        'data.0',
                        function (AssertableJson $json) {
                            return $json
                                ->where('resource', 'contact')
                                ->whereType('ruid', 'string')
                                ->whereType('firstname', 'string')
                                ->whereType('lastname', 'string')
                                ->whereType('contact_no', 'string')
                                ->whereType('email_address', 'string')
                                ->has(
                                    'login',
                                    function (AssertableJson $json) {
                                        return $json
                                            ->where('resource', 'user')
                                            ->whereType('ruid', 'string')
                                            ->whereType('username', 'string');
                                    }
                                );
                        }
                    )
                    ->has('meta');
            }
        );
    }

    public function testGetContactsWithFieldsCursorPaginated()
    {
        Contact::factory()->count(20)->create();

        $this->json('GET', '/api/v1/contacts?pagination=cursor&fields=login.username,firstname,lastname,email_address,contact_no&filter=email_address:@gmail.com&search=la', [])
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonStructure([
            'data' => [[
                'resource',
                'ruid',
                'firstname',
                'lastname',
                'contact_no',
                'email_address',
                'login',
            ]],
        ])
        ->assertJson(
            function (AssertableJson $json) {
                return $json
                    ->has(
                        'data.0',
                        function (AssertableJson $json) {
                            return $json
                                ->where('resource', 'contact')
                                ->whereType('ruid', 'string')
                                ->whereType('firstname', 'string')
                                ->whereType('lastname', 'string')
                                ->whereType('contact_no', 'string')
                                ->whereType('email_address', 'string')
                                ->has(
                                    'login',
                                    function (AssertableJson $json) {
                                        return $json
                                            ->where('resource', 'user')
                                            ->whereType('ruid', 'string')
                                            ->whereType('username', 'string');
                                    }
                                );
                        }
                    )
                    ->has('meta');
            }
        );
    }

    public function testGetContactsWithFieldsCursorPaginatedSorted()
    {
        Contact::factory()->count(20)->create();

        $this->json('GET', '/api/v1/contacts?sort=-firstname,lastname&pagination=cursor&fields=login.username,firstname,lastname,email_address,contact_no&filter=email_address:@gmail.com&search=la', [])
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonStructure([
            'data' => [[
                'resource',
                'ruid',
                'firstname',
                'lastname',
                'contact_no',
                'email_address',
                'login',
            ]],
        ])
        ->assertJson(
            function (AssertableJson $json) {
                return $json
                    ->has(
                        'data.0',
                        function (AssertableJson $json) {
                            return $json
                                ->where('resource', 'contact')
                                ->whereType('ruid', 'string')
                                ->whereType('firstname', 'string')
                                ->whereType('lastname', 'string')
                                ->whereType('contact_no', 'string')
                                ->whereType('email_address', 'string')
                                ->has(
                                    'login',
                                    function (AssertableJson $json) {
                                        return $json
                                            ->where('resource', 'user')
                                            ->whereType('ruid', 'string')
                                            ->whereType('username', 'string');
                                    }
                                );
                        }
                    )
                    ->has('meta');
            }
        );
    }
}
