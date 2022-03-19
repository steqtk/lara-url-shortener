<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Link;
use App\Code;

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
    public function shorten(LinkRequest $request)
    {
        $url = Link::whereUrl($request->get('url'))->with('code')->first();
        if ($url) {
            return response([
                'success' => false,
                'message' => 'Такая ссылка уже есть: <a href="' . url("/{$url->code->code}") . '" target="_blank">' . url("/{$url->code->code}") . '</a>'
            ]);
        } else {
            $code = Code::where('active', 1)->first();
            Link::create(['url' => $request->get('url'), 'code_id' => $code->id]);
            $code->active = false; $code->save();

            return response([
                'success' => true,
                'message' =>  'Сокращенная ссылка: <a id="short_url" href="' . url("/{$code->code}") . '" target="_blank">' . url("/{$code->code}") . '</a>'
            ]);
        }
    }

    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($code)
    {
        $code = Code::where(['code' => $code, 'active' => 1])->with('link')->first();

        return is_null($code) ? redirect('/')->withErrors('Неверная ссылка!') : redirect($code->link->url);
    }
}
