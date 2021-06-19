<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;

class UserMgmtController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new UserCollection(User::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved users'
        ]);
    }

    public function show(Request $request, $account_id) {
        $account = User::find($account_id);

        if (is_null($account)) {
            return $this->sendError('Invallid user', ['user_id' => $account_id]);
        }

        return $this->sendResponse(new UserResource($account), 'Successfully fetched user details.');
    }

    public function update(Request $request, $account_id)
    {
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
        $account->sendActivity('Account details has been changed', 'The profile details has been changed through an admin');

        return $this->sendResponse(new UserResource($account), 'Successfully updated user details.');
    }

    public function sendPasswordResetNotification(Request $request, $account_id) {
        $account = User::find($account_id);

        if (is_null($account)) {
            return $this->sendError('Invallid user', ['user_id' => $account_id]);
        }

        $response = Password::sendResetLink([
            'email' => $account->email
        ]);
        $account->sendActivity('Password-Reset-Email has been sent.', 'A mail to reset the password has been sent to ' . $account->email, $account);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : 'Whoops... Something went wrong...';

        return $this->sendResponse([], $message);
    }

    public function sendEmailVerificationNotification(Request $request, $account_id) {
        $account = User::find($account_id);

        if (is_null($account)) {
            return $this->sendError('Invallid user', ['user_id' => $account_id]);
        }

        $account->sendEmailVerificationNotification();
        $account->sendActivity('Email-Verification-Email has been sent.', 'A mail to verify the email has been sent to ' . $account->email, $account);

        return $this->sendResponse([], 'Mail send successfully');
    }

    public function changePassword(Request $request, $account_id) {
        $account = User::find($account_id);

        if (is_null($account)) {
            return $this->sendError('Invallid user', ['user_id' => $account_id]);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $account->password = Hash::make($request->input('password'));
        $account->save();
        $account->sendActivity('Password has been changed', 'The account\'s password has been changed trough an admin', $account);

        return $this->sendResponse([], 'Password changed successfully');
    }

    public function delete($account) {
        $account->delete();
        return $this->sendResponse([], 'Account soft-deleted successfully.');
    }
}
