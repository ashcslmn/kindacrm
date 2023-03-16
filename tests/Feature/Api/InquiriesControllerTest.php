<?php

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});

it('can list all inquiries', function () {
    $inquiries = Inquiry::factory()->count(3)->create();

    $response = $this
        ->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->createToken('test')->plainTextToken
        ])
        ->get(route('inquiries.index'));

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'subject',
                    'description',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);
});

it('can create a new inquiry', function () {
    $inquiryData = Inquiry::factory()->make()->toArray();

    $response = $this->post(route('inquiries.store'), $inquiryData);

    $response->assertStatus(201)
        ->assertJsonFragment($inquiryData);
});

it('can show a single inquiry', function () {
    $inquiry = Inquiry::factory()->create();

    $response = $this->get(route('inquiries.show', $inquiry));

    $response->assertStatus(200)
        ->assertJsonFragment($inquiry->toArray());
});

it('can update an inquiry', function () {
    $inquiry = Inquiry::factory()->create();
    $updatedData = Inquiry::factory()->make()->toArray();

    $response = $this->put(route('inquiries.update', $inquiry), $updatedData);

    $response->assertStatus(200)
        ->assertJsonFragment($updatedData);
});

it('can delete an inquiry', function () {
    $inquiry = Inquiry::factory()->create();

    $response = $this->delete(route('inquiries.destroy', $inquiry));

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Inquiry deleted successfully.']);
});
