<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Laravel\Fortify\Actions\AttemptToAuthenticate;
// use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
// use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
// use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
// use Laravel\Fortify\Fortify;
// use Illuminate\Http\Request;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Fortify::loginView(function () {
		// 	return view('auth.my-login');
		// });

		// Fortify::registerView(function () {
		// 	return view('auth.my-register');
        // });

        // Fortify::authenticateUsing(function (Request $request) {
		// 	$user = User::where('email', $request->email)->first();

		// 	if ($user &&
		// 		Hash::check($request->password, $user->password)) {
		// 		return $user;
		// 	}
        // });

        // Fortify::authenticateThrough(function (Request $request) {
        //     return array_filter([
        //             config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
        //             RedirectIfTwoFactorAuthenticatable::class,
        //             AttemptToAuthenticate::class,
        //             PrepareAuthenticatedSession::class,
        //             Myclass::class
        //     ]);
        // });

    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
