<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use mysqli;
use Swift_SmtpTransport;

class EnvironmentController extends BaseController
{
    public function update_mysql(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'hostname' => 'required',
            'port' => 'required|integer|min:1|max:99999',
            'database' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        try {
            $tmp_con = new mysqli($input['hostname'], $input['username'], $input['password'], $input['database'], $input['port']);

            if ($tmp_con->connect_error) {
                return $this->sendError('Error while connecting to the database.', [
                    'db_response' => $tmp_con->connect_error
                ]);
            }

            mysqli_close($tmp_con);
            $tmp_con = null;
        } catch (Exception $e) {
            return $this->sendError('Error while connecting to the database.', [
                'db_response' => $tmp_con->connect_error
            ]);
        }

        // HOSTNAME
        config(['database.connections.mysql.host' => $input['hostname']]);
        $this->putPermanentEnv('DB_HOST', $input['hostname']);

        // PORT
        config(['database.connections.mysql.port' => $input['port']]);
        $this->putPermanentEnv('DB_PORT', $input['port']);

        // DATABASE
        config(['database.connections.mysql.database' => $input['database']]);
        $this->putPermanentEnv('DB_DATABASE', $input['database']);

        // USERNAME
        config(['database.connections.mysql.username' => $input['username']]);
        $this->putPermanentEnv('DB_USERNAME', $input['username']);

        // PASSWORD
        config(['database.connections.mysql.password' => $input['password']]);
        $this->putPermanentEnv('DB_PASSWORD', $input['password']);

        return $this->sendResponse([
            "config" => config('database.connections.mysql'),
        ], "Successfully changed mysql connection");
    }

    function putPermanentEnv($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}
