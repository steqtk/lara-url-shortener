<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Link;
use Validator;

/**
 * Class LinkController
 * @package App\Http\Controllers
 */
class LinkController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shorten(Request $request)
    {
        $input = $request->all();
        // валидатор url
        $validator = Validator::make($input, [
            'url' => 'required|url|min:5',
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        } else {
            $url = Link::whereUrl($request->get('url'))->first();
            if ($url) {
                return response('Такая ссылка уже есть: <a href="' . url("/{$url->code}") . '" target="_blank">' . url("/{$url->code}") . '</a>');
            } else {
                do {
                    $code = Str::random(6);
                } while (Link::where('code', '=', $code)->count() > 0);
                $link = new Link([
                    'url' => $request->get('url'),
                    'code' => $code,
                ]);
                $link->save();
                return response('Сокращенная ссылка: <a id="short_url" href="' . url("/{$link->code}") . '" target="_blank">' . url("/{$link->code}") . '</a>');
            }
        }
    }

    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function get($code)
    {
        $link = Link::where('code', '=', $code)->first();
        if ($link) {
            return redirect($link->url);
        } else {
            return redirect('/')->withErrors('Неверная ссылка!');
        }
    }
}
