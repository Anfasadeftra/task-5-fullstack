<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;
    protected $faker;

    public function setUp(): void{
      parent::setUp();
      $this->faker = Factory::create();
      
    }
}
