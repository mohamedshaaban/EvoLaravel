<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\Faq;
use App\Models\Setting;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Validator;

class PagesController extends Controller
{
    public function getPage(Request $request, $slug)
    {

        $pageContent = Pages::where('slug', $slug)->get()->first();
        switch ($slug) {
            case $slug == 'contact_us':
                return view('pages.contact_us');
                break;
            case $slug == 'faq':
                $faqs = Faq::where('status', 1)->get();
                return view('pages.faq', ['faqs' => $faqs]);
                break;
            default:
                return view('pages.page', ['data' => $pageContent]);
        }
    }

    public function storeContactUs(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'phone' => 'required',
        ]);

        $contactData = $request->all();

        retry(5, function () use ($contactData) {
            Mail::to(Setting::first()->email_support)->send(new ContactUs($contactData));
        }, 100);

        \Session::flash('success', 'Thank you for your contact us. We will respond as soon as possible');
        return redirect()->back();
    }
}
