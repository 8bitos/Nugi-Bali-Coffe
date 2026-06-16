<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access change password page.
     */
    public function test_guest_cannot_access_change_password_page(): void
    {
        $response = $this->get(route('admin.password.edit'));
        $response->assertRedirect('/login'); // Assuming it goes to login page if unauthenticated
    }

    /**
     * Test non-admin user cannot access change password page.
     */
    public function test_non_admin_cannot_access_change_password_page(): void
    {
        $user = User::factory()->create([
            'role' => 'pelanggan',
        ]);

        $response = $this->actingAs($user)->get(route('admin.password.edit'));
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error', 'Anda tidak memiliki akses ke halaman ini');
    }

    /**
     * Test admin can access change password page.
     */
    public function test_admin_can_access_change_password_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.password.edit'));
        $response->assertStatus(200);
        $response->assertSee('Ganti Password');
    }

    /**
     * Test admin can successfully change password with correct credentials.
     */
    public function test_admin_can_change_password_with_correct_current_password(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('oldpassword123'),
        ]);

        $response = $this->actingAs($admin)->put(route('admin.password.update'), [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'Password berhasil diperbarui.');

        // Verify password is changed
        $admin->refresh();
        $this->assertTrue(Hash::check('newpassword123', $admin->password));
    }

    /**
     * Test admin cannot change password with incorrect current password.
     */
    public function test_admin_cannot_change_password_with_incorrect_current_password(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('oldpassword123'),
        ]);

        $response = $this->actingAs($admin)->put(route('admin.password.update'), [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['current_password']);

        // Verify password remains unchanged
        $admin->refresh();
        $this->assertTrue(Hash::check('oldpassword123', $admin->password));
    }

    /**
     * Test admin cannot change password when confirmation mismatch.
     */
    public function test_admin_cannot_change_password_when_confirmation_mismatch(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('oldpassword123'),
        ]);

        $response = $this->actingAs($admin)->put(route('admin.password.update'), [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test admin cannot change password when new password is too short.
     */
    public function test_admin_cannot_change_password_when_new_password_is_too_short(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('oldpassword123'),
        ]);

        $response = $this->actingAs($admin)->put(route('admin.password.update'), [
            'current_password' => 'oldpassword123',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }
}
