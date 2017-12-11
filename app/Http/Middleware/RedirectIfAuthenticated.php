<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    protected $authorizeRequestService;

    public function __construct(AuthorizeRequestServiceInterface $authorizeRequestService)
    {
        $this->authorizeRequestService = $authorizeRequestService;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        $response = $this->authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/role/get-role-names',
            config('app.source_name')
        );
        if ($response->status == 200 && $response->data) {
            if (in_array('admin', $response->data) || in_array('moderator', $response->data)) {
                return redirect()->route('dashboards.index');
            } else {
                return redirect('/');
            }
        }
        return $next($request);
    }
}
