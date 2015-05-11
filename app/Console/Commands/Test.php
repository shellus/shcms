<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Test extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {


        \App\Model\Post::where('id','>=',\App\Model\SiteConfig::get('post_image_to_local'))->chunk(200, function($posts)
        {
            foreach ($posts as $post)
            {


                $this -> postImageToLocal($post);

                $this -> info($post->id);
                \App\Model\SiteConfig::set('post_image_to_local',$post->id);
            }
        });
    }
    private function postImageToLocal(\App\Model\Post $post){

        $sum_count = 0;
        $abs_count = 0;
        $err_count = 0;
        $rel_count = 0;
        $suc_count = 0;

        $post->content = preg_replace_callback("/<img.*?src=\"(.+?)\".*?>/ism", function ($data)
        use($post,&$sum_count,&$abs_count,&$err_count,&$rel_count,&$suc_count) {

            $sum_count++;
            if (preg_match('/^http:|https:|\/\//i', $data[1])) {
                $abs_count++;
                $path = tempnam('/tmp', 'sex');
                $file_content = @file_get_contents($data[1]);
                if(!$file_content){
                    $err_count++;
                    return '#';
                }else{
                    $suc_count++;
                }


                file_put_contents($path, $file_content);
                $file = new \Symfony\Component\HttpFoundation\File\UploadedFile($path, $data[1], null, null, null, true);

                $model = \App\Model\File::create([
                    'type' => 'post_image',
                    'name' => $post->id,
                    'file' => $file,
                ]);
                $model = \App\Model\File::find($model->id);
                return str_replace($data[1], $model->getFileUrl(), $data[0]);

            }else{
                $rel_count++;
            }
            return $data[0];
        }, $post->content);


        if($suc_count > 0){
            $post->save();
        }
        $this -> info('总数：'.$sum_count);
        $this -> info('绝对：'.$abs_count);
        $this -> info('失败：'.$err_count);
        $this -> info('相对：'.$rel_count);
        $this -> info('成功：'.$suc_count);

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }

}
