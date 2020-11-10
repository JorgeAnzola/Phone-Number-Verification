<?php

namespace JorgeAnzola\PhoneNumberVerification\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use JorgeAnzola\PhoneNumberVerification\Contracts\MustVerifyPhoneNumber;

class EnsurePhoneNumberIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $redirectToRoute
     *
     * @return Response|RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = NULL)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyPhoneNumber && !$request->user()->hasVerifiedPhoneNumber())) {
            return $request->expectsJson() ? abort(403, 'Your phone number is not verified.') : Redirect::to(URL::route($redirectToRoute ?: 'phone_number_verification.notice'));
        }

        return $next($request);
    }
}
