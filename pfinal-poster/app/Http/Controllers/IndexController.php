<?php

namespace App\Http\Controllers;

use App\Models\Posters;
use App\Services\ImgTools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    protected $poster;

    public function __construct(Posters $poster)
    {
        $this->poster = $poster;
    }

    public function index()
    {
        $poster_list = $this->poster->get();

        //dd($poster_list);
        return view('index', compact('poster_list'));
    }

    public function poster_info(Request $request)
    {

        $poster_id = $request->route('poster_id', 0);
        if ($poster_id) {
            $poster = $this->poster->find($poster_id) ? $this->poster->find($poster_id) : $this->poster->first();
        } else {
            $poster = $this->poster->first();
        }

        return view('poster_info', compact('poster'));
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
                'subheading' => 'required',
                'desc' => 'required',
                'poster_str' => 'required',
            ],
            [
                'poster_url.required' => '海报连接必须',
                'title.required' => '海报标题必须',
                'subheading.required' => '副标题必须',
                'desc.required' => '描述必须',
                'poster_str.required' => '海报图片必须',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code' => 405, 'msg' => $validator->messages()->first()]);
        }
        $params['title'] = $request->input('title');
        $params['subheading'] = $request->input('subheading');
        $params['desc'] = $request->input('desc');
        $params['poster_bg_str'] = $request->input('desc');
        DB::beginTransaction();
        try {
            $result = $this->poster->create($params);
            // 开始生成海报
            $res = $this->generate_poster($result, $request);
            if ($res) {
                DB::commit();

                return response()->json(['code' => 200, 'data' => ['poser_id' => $result->id]]);
            } else {
                DB::rollBack();

                return response()->json(['code' => 405, 'msg' => '生成错误']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json(['code' => 405, 'msg' => '生成错误']);
        }
    }

    private function generate_poster($result, $request)
    {
        // 获取 背景图片的 大小
        $img = base64_decode(explode(',', $request->input('poster_str'))[1]);
        $img_path = 'data/upload/tools_img/'.$result->id.'.jpg';
        if (!file_exists(dirname($img_path))) {
            mkdir(dirname($img_path), 0777, true);
        }
        file_put_contents($img_path, $img);
        $img_info = getimagesize(asset($img_path)); // 获取图片的宽和高

        //要生成的标题信息的宽度
        // 如果宽大于高
        $qrcode_width = 0;
        $generate_desc = [];
        switch ($request->input('poster_style')) {
            case 0:
                if ($img_info[0] >= $img_info[1]) {
                    $generate_desc['height'] = round($img_info[0] / 3);
                    $generate_desc['width'] = $img_info[0];
                    $qrcode_width = round($generate_desc['height'] * 0.8);
                } else {
                    $generate_desc['width'] = round($img_info[1] / 3);
                    $generate_desc['height'] = $img_info[0];
                    $qrcode_width = round($generate_desc['width'] * 0.8);
                }
                break;
            case 1:
                $generate_desc['height'] = round($img_info[0] / 3);
                $generate_desc['width'] = $img_info[0];
                $qrcode_width = round($generate_desc['height'] * 0.8);
                break;
            case 2:
                $generate_desc['width'] = round($img_info[1] / 3);
                $generate_desc['height'] = $img_info[0];
                $qrcode_width = round($generate_desc['width'] * 0.8);
                break;
        }
        // 生成二维码
        if ($request->input('inlineRadioOptions') == 1) {
            $file_path = 'data/upload/tools_qrcode/'.$result->id.'.png';
            if (!file_exists(dirname($file_path))) {
                mkdir(dirname($file_path), 0777, true);
            }
            QrCode::format('png')->size($qrcode_width)->margin(1)->encoding('UTF-8')->generate(
                $request->input('poster_url'),
                public_path($file_path)
            );
            //dd($file_path);
            $result->qrcode_img = $file_path;

        } else {
            // TODO 这个是上传的二维码
        }
        //开始创建画布生成图片
        $img_data = [
            'bg_img' => ['bg_path' => asset($img_path), 'bg_data' => $img_info],
            'generate_desc' => $generate_desc,
            'qrcode' => ['qrcode_width' => $qrcode_width, 'qrcode_path' => asset($file_path)],
            'msg' => ['title' => $result->title, 'subheading' => $result->subheading, 'desc' => $result->desc],
        ];
        $image = new ImgTools($img_data);
        $create_img_path = 'data/upload/tools_img/poster_'.$result->id.'.jpg';
        if (!file_exists(dirname($create_img_path))) {
            mkdir(dirname($create_img_path), 0777, true);
        }
        $image->createSharePng($create_img_path);
        $result->poster_image = $create_img_path;

        return $result->save();
    }
}
