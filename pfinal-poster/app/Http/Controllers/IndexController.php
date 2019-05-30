<?php

namespace App\Http\Controllers;

use App\Models\Posters;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $poster;

    public function __construct(Posters $poster)
    {
        $this->poster = $poster;
    }

    public function index()
    {
        return view('index');
    }

    public function poster_info(Request $request)
    {
        $poster_id = $request->route('poster_id', 0);

        //dd($poster_id);
        return view('poster_info');
    }

    public function poster_generate()
    {
        return view('poster_generate');
    }

    public function poster_generate_do(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'poster_url' => 'required',
                'title' => 'required',
                'fv_title' => 'required',
                'desc' => 'required',
                'poster_str' => 'required',
            ],
            [
                'poster_url.required' => '海报连接必须',
                'title.required' => '海报标题必须',
                'fv_title.required' => '副标题必须',
                'desc.required' => '描述必须',
                'poster_str.required' => '海报图片必须',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code' => 405, 'msg' => $validator->messages()->first()]);
        }
        $params['title'] = $request->input('title');
        $params['subheading'] = $request->input('fv_title');
        $params['desc'] = $request->input('desc');
        $params['poster_bg_str'] = $request->input('desc');
        DB::beginTransaction();
        try {
            $result = $this->poster->create($params);
            // 开始生成海报
            $this->generate_poster($result, $request);
        } catch (\Exception $exception) {

        }

    }

    private function generate_poster($result, $request)
    {
        // 生成二维码
        if ($request->input('inlineRadioOptions') == 1) {
            $file_path = 'data/upload/tools_qrcode/'.$result->id.'.png';
            if (!file_exists(dirname($file_path))) {
                mkdir(dirname($file_path), 0777, true);
            }
            QrCode::format('png')->size(200)->margin(1)->encoding('UTF-8')->generate(
                $request->input('poster_url'),
                public_path($file_path)
            );
            $result->qrcode_img = $file_path;
        } else {

        }
    }
}
