<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    // public function testLoginPageForMember()
    // {
    //     $this->withSession([
    //         "user" => "john"
    //     ])->get('/login')
    //         ->assertRedirect("/");
    // }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "john",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "john");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "john"
        ])->post('/login', [
            "user" => "john",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])
            ->assertSeeText("User and Password is Required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or Password is Wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "john"
        ])->post('/logout')
            ->assertRedirect("/login")
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/login");
    }
}
