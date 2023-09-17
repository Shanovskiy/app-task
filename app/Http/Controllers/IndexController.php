<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function viewIndex()
    {
        return view('index');
    }

    public function showParseUrl()
    {
        $request=request()->post();
        $url = $request['url'];

        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $domen = parse_url($url,-1);
        $host = $domen['scheme'].'://'.$domen['host'];
        $html = @file_get_contents($url,false,$context);
        preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $html, $images, PREG_SET_ORDER);
        $images =array_map(function (array $item){
            return $item[1];
        },$images);
        $images = $this->transformImagesUrlToFull($host,$images);
        $allSize=0;
        foreach ($images as $image){
            $allSize+=strlen(@file_get_contents($image))/1024/1024;
        }
        $imagesCount =count($images);
        return view('result')->with("images",$images)->with("allSize",$allSize)->with("imagesCount",$imagesCount);
    }

    public function viewResult()
    {
        return view('result');
    }

    public function transformImagesUrlToFull(string $host, array $imagesUrl):array
    {
        $result=[];
        foreach ($imagesUrl as $imageUrl){
            $temp = $imageUrl;
            if (!preg_match('/http[s]?:\/\//',$imageUrl)){
                $temp =str_replace(' ','',$host.$imageUrl);
            }
            $result[]=$temp;
        }
        return $result;
    }
}
