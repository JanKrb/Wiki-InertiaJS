<?php

namespace App\Http\Controllers\API\User;

use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends BaseController
{
    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:name',
            'name' => 'required_without:email',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $credentials = ['password' => $request->password];

        if ($request->has('email')) {
            $credentials['email'] = $request->email;
        } else {
            $credentials['name'] = $request->name;
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('PersonalAccessToken')-> accessToken;
            $success['user'] =  $user;

            $now = now();
            $user->sendActivity('Successful login.', "$user->name [$user->id] logged in on $now", $user);

            return $this->sendResponse($success, 'User login successfully.');
        }

        Activity::create([
            'issuer_type' => 0, // 0 => Unknown/Undefined
            'issuer_id' => 1,
            'short' => 'Failed login.',
            'details' => "{$request->ip()} failed to log in into account",
            'attributes' => json_encode($credentials)
        ]);

        return $this->sendError('Unauthorised.', ['error' => 'Login failed.']);
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'pre_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['email_verification_code'] = Str::random(40);
        $user = User::create($input);

        $user->sendActivity('User Account has been created via registering.', '', $user);
        $user->sendEmailVerificationNotification();
        $user->sendActivity('Email-Verification-Email has been sent.', 'A mail to verify the email-adress has been sent to ' . $user->email, $user);


        $success['token'] =  $user->createToken('PersonalAccessToken')->accessToken;
        $user->sendActivity('Session token has been created.', 'A session token for login and api requests has been created and passed.');

        $success['user'] =  $user;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Get current user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        if (Auth::user() == null) {
            Activity::create([
                'issuer_type' => 0, // 0 => Unknown/Undefined
                'issuer_id' => 1,
                'short' => 'Tried to fetch unauthenticated user',
                'details' => "IP {$request->ip()} tried to fetch his user, but is unauthenticated.",
                'attributes' => json_encode($request)
            ]);
        } else {
            Auth::user()->sendActivity('Fetched user');
        }

        return $this->sendResponse([
            'user' => Auth::user()
        ], 'User returned successfully.');
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::user()->sendActivity('Logged out', 'User has logged out and token has been revoked.');
        Auth::user()->token()->revoke();
        return $this->sendResponse([], 'User Logged Out');
    }

    /**
     * Recover password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function recover_password(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input = $request->all();
        $user = User::where('email', $input['email']);

        if (!$user->exists()) {
            return $this->sendError('This email does not belong to any users', ['email' => $input['email']]);
        }

        $response = Password::sendResetLink($input);
        $user->sendActivity('Password-Reset-Email has been sent.', 'A mail to reset the password has been sent to ' . $user->email, $user);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : 'Whoops... Something went wrong...';

        return $this->sendResponse([], $message);
    }

    /**
     * Reset password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reset_password(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $response = Password::reset($request->all(), function ($user, $password) {
            $user->sendActivity('Password-Reset has been performed', 'The password has been changed through a reset-email.');

            $user->password = Hash::make($password);
            $user->save();
        });

        $message = $response == Password::PASSWORD_RESET ? 'Password reset successfully' : 'Whoops... Something went wrong...';

        return $this->sendResponse([], $message);
    }

    /**
     * Change password
     * @param Request $request
     * @return JsonResponse
     */
    public function change_password(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', ['errors' => $validator->errors()]);
        }

        $user = Auth::user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return $this->sendError('Invalid credentials.', []);
        }

        $user->password = Hash::make($request['password']);
        $user->save();
        $user->sendActivity('Password-Reset has been performed', 'The password has been changed through the profile or an admin.');

        return $this->sendResponse([], 'Password changed successfully');
    }

    /**
     * Confirm email address
     * @param Request $request
     * @return JsonResponse
     */
    public function confirm_email(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', ['errors' => $validator->errors()]);
        }

        $user = User::where('email_verification_code', $request->input('token'))->first();

        if (!$user) {
            return $this->sendError('Invalid token.', []);
        }

        $user->email_verification_code = '';
        $user->email_verified_at = now();
        $user->save();
        $user->sendActivity('Email-Verification passed', 'The email has been verified trough the email-verification.');

        return $this->sendResponse([], 'Email confirmed successfully');
    }

    public function update_details(Request $request, $account_id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $account_id,
            'pre_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $account_id,
            'profile_picture' => ''
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', ['errors' => $validator->errors()]);
        }

        $account = User::find($account_id);

        if (is_null($account)) {
            return $this->sendError('Invallid user', ['user_id' => $account_id]);
        }

        $account->update($request->all());
        $account->sendActivity('Account details has been changed', 'The profile details has been changed through the profile or an admin');

        return $this->sendResponse($account, 'Successfully updated user details.');
    }
}
