<?php

namespace App\Http\Controllers\Markdown;

use App\Http\Controllers\Controller;
use App\Markdown\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return View
     */
    public function __invoke(Request $request)
    {
        $termsFile = Utils::localizedMarkdownPath('privacy-policy.md');

        return view('privacy_policy', [
            'privacyPolicy' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}
