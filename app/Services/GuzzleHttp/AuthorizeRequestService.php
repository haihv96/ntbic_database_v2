<?php

namespace App\Services\GuzzleHttp;

use GuzzleHttp;

class AuthorizeRequestService implements AuthorizeRequestServiceInterface
{
    public function send($method, $url, $source = null, $name = null): \stdClass
    {
        $http = new GuzzleHttp\Client;
        $request = $http->request($method, $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . session('access_token')
            ],
            'form_params' => [
                'source' => $source,
                'name' => $name
            ],
            'http_errors' => false
        ]);

        $response = json_decode((string)$request->getBody(), true);
        $object = new \stdClass();
        $object->status = $request->getStatusCode();
        isset($response['message']) ? $object->message = $response['message'] : null;
        isset($response['data']) ? $object->data = $response['data'] : null;
        return $object;
    }

    public function authorizeActions(array $actions): array
    {
        $results = [];
        foreach ($actions as $action) {
            $response = $this->send(
                'post',
                config('sso.root_server.url.root') . '/api/permission/has-any-permissions-to',
                $action
            );
            if ($response->status === 200) {
                $results[$action] = $response->data;
            }
        }
        return $results;
    }

    public function checkPermissionInList($source, $name, array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!is_array($permission)) {
                return false;
            }
            if ($permission['source'] == $source && $permission['name'] == $name) {
                return true;
            }
        }
        return false;
    }
}
