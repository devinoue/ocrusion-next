<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    ];

    /**
     * 特定のリファラーの場合に、特定ページの CSRF チェックを迂回するために handle をオーバーライドする
     */
    public function handle($request, Closure $next)
    {
        // リクエストが特定 URI から始まるものであれば
        if (\Str::startsWith($request->headers->get('referer'), 'https://localhost:3000/')) {
            // いくつかの画面では CSRF チェックをしないようにする (配列への追加)
            $this->except = array_merge($this->except, ['/auth/password-reset']);
        }
        if (\Str::startsWith($request->headers->get('referer'), 'http://13.230.137.249:8080/')) {
            // いくつかの画面では CSRF チェックをしないようにする (配列への追加)
            $this->except = array_merge($this->except, ['/auth/password-reset']);
        }
        return parent::handle($request, $next);
    }
}
