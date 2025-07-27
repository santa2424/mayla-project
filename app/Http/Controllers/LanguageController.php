<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{

    public function switchLanguage(Request $request)
    {
        $locale = $request->input('locale');

        if (in_array($locale, ['en', 'ar'])) {
            if (Auth::check()) {
                $user = Auth::user();
                $user->preferred_language = $locale;
                $user->save();
            } else {
                session(['locale' => $locale]);
            }

            // تعيين اللغة مؤقتاً لهذا الطلب فقط
            App::setLocale($locale);

            return redirect()->back()->with('language_switched', $locale == 'ar' ? 'العربية' : 'English');
        }

        return redirect()->back();
    }



}
