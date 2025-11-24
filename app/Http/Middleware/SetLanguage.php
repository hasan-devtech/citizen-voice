<?php

namespace App\Http\Middleware;

use App\Enums\LanguageEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->query('lang');
        if (!$lang || !in_array($lang, array_column(LanguageEnum::cases(), 'value'))) {
            $lang = LanguageEnum::EN->value;
        }
        $request->attributes->set('lang', $lang);
        return $next($request);
    }
}
