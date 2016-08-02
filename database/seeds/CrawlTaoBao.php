<?php

use Illuminate\Database\Seeder;

class CrawlTaoBao extends Seeder
{
    private function crawl($start_row){
        $url = "https://zhi.taobao.com/json/fantomasItems.htm?t=1470162292609&_input_charset=utf-8&sort=null&appId=9&blockId=914&pageSize=100&bucketId=1&startRow=" .$start_row. "&extQuery=null&thirdQuery=null&viewId=8aff31d5-89b4-c402-5ced-49081aa7ac5d&requestId=e556265a-70c8-3a9e-e83f-5c117a01490d&_ksTS=1470162292610_608&callback=jsonp609";


        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $url, [
            'headers' => [
                'accept-encoding' => 'gzip, deflate, sdch, br\' -H \'accept-language: zh-CN,zh;q=0.8',
                'user-agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
                'accept'      => '*/*',
                'referer'      => 'https://tejia.taobao.com/?spm=a21bo.50862.201884-item-1021.1.W0i1MF&pvid=ec8480f1-644b-44bf-be9e-2892a6356bc0&scm=1007.12803.38507.0',
                'authority'      => 'zhi.taobao.com',
                'cookie'      => 'v=0; cookie2=1a7b2dec00ec96df0a2124da89d06e43; t=1c144aed4e731c40b6a850183355e2ee; mt=ci%3D-1_0; cna=aNMnEMbRHQMCAXkig6KYBHfI; isg=AoaGbPAVLTEp7_lVRXUaKUBr13yO2H51WR1CK3CvmamkcySN2Hb8sdxFPRhF; l=AiYmj-qWoMspkosj/BGVGbF39pao7Grh',
            ],
            'verify' => false,
        ]);
        $content = $res->getBody() -> getContents();
        $content = substr($content, 11, strlen($content) - (11 + 3));
        $content = json_decode($content, true);
        foreach ($content['data'] as $item_data){
            $item = \App\Item::create([
                'slug' => $item_data['itemId'],
                'shop_id' => $item_data['shopId'],
                'shop_name' => $item_data['shopName'],
                'title' => $item_data['title'],
                'price' => $item_data['reservePrice'],
                'discount' => $item_data['discount'],
                'discount_price' => $item_data['discountPrice'],
                'quantity' => $item_data['quantity'],
                'sell_out' => $item_data['currentSellOut'],
                'current_quantity' => $item_data['currentQuantity'],
                'current_sell_out' => $item_data['currentSellOut'],
                'status' => $item_data['status'],
            ]);
            $item_image_url = 'http:' . $content['picServer'] . '/' . $item_data['activityPicUrl'];
            $imageBinary = file_get_contents($item_image_url);
            $image = \App\File::createFormBinary($imageBinary, 'uploads/item_thumb/' . $start_row . '-' . ($start_row + 100));
            $item -> files() -> save($image);
            $this -> command -> info($item -> id . '/6605');
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagecount = 6605 / 100;
        for($page=7; $page < $pagecount; $page++){
            $this -> crawl($page * 100);
        }
    }
}
