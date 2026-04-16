<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_peserta_login()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $response = $this->post('/login', [
            'username' => 'peserta01',
            'password' => 'peserta',
        ]);

        $response->assertStatus(302);
        
        // Cek kemana arah redirectnya
        $redirectUrl = $response->headers->get('Location');
        echo "Redirect to: " . $redirectUrl . "\n";
        
        // Cek apakah user ada di session
        echo "Auth check: " . (auth()->check() ? 'Yes' : 'No') . "\n";
        
        if (auth()->check()) {
            echo "Logged in User Role: " . auth()->user()->role . "\n";
        }
    }
}
