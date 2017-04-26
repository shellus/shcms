<?php namespace App\Service;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


class UserService
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @param $data
     * @return User
     */
    public function create($data)
    {
        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'register_ip' => \Request::ip(),
            'api_token' => Str::random(60),
        ]);
        return $user;
    }

    /**
     * @param $attributes
     * @param array $values
     * @return User
     */
    public function firstOrCreate($attributes, $values = array())
    {
        $user = User::where($attributes)->first();
        if (!$user) {
            $user = self::create($values);
        }
        return $user;
    }

    /**
     * @param User $user
     * @param UploadedFile $file
     */
    public function updateUserAvatarByUploadedFile(User $user, UploadedFile $file)
    {
        $save_path = 'avatar/user_' . $user->getKey();
        $file_model = $this->fileService->createFormUploadFile($file, $save_path);


        // 如果用户当前已有头像则删除先
        if ($user->avatar()->exists()) {
            $this->fileService->delete($user->avatar);
        }

        $user->avatar()->associate($file_model);
        $user->save();
    }

}