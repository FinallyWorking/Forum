<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Testing base functionality of repo using user repository
 */
class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->count(3)->create();
        $this->userRepo = new UserRepository;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_repo_all()
    {
        $countUsers = User::all()->count();
        $this->assertEquals($countUsers, $this->userRepo->all()->count());
    }

    public function test_user_repo_find()
    {
        $firstUser = User::first();
        $lastUser = User::latest('id')->first();
        $this->assertEquals($firstUser->id, $this->userRepo->find($firstUser->id)->id);
        $this->assertEquals($lastUser->id, $this->userRepo->find($lastUser->id)->id);
    }

    public function test_user_repo_create()
    {
        $userData = [
            'name' => 'test user',
            'email' => 'random@email.com',
            'password' => 'some password',
        ];

        $createdUser = $this->userRepo->create($userData);

        $this->assertEquals($createdUser->name, 'test user');
        $this->assertEquals($createdUser->email, 'random@email.com');
        $this->assertEquals($createdUser->password, 'some password');
    }

    public function test_user_repo_update()
    {
        $user = User::first();

        $this->userRepo->update($user->id, [
            'name' => 'random name',
            'email' => 'random@email.com',
        ]);

        $user->refresh();

        $this->assertEquals($user->name, 'random name');
        $this->assertEquals($user->email, 'random@email.com');
    }

    public function test_user_repo_delete()
    {
        $user = User::first();
        $this->assertEquals(3, User::count()); // user count is 3

        $this->userRepo->delete($user->id);

        $this->assertFalse(User::where('id', $user->id)->exists());

        $this->assertEquals(2, User::count()); // now user count is 2
    }
}
