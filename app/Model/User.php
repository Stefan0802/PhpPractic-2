<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Src\View;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'lastName',
        'login',
        'avatar',
        'password',
        'idRole',
        'idPhone',
        'idDepartment',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }



    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => md5($credentials['password'])])->first();
    }

    public function uploadAvatar(array $file): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            return null;
        }

        $uploadFileDir = __DIR__ . '/../../public/uploads/avatars/';

        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return "/uploads/avatars/" . $newFileName;
        }

        return null;
    }



    public static function createUser($request)
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'idRole' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return $validator->errors();

            }

            if (\Model\User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
    }

    public static function search($request)
    {
        $query = User::query();

        if($search = $request->get('search_field')){
            $search = trim($search);
            $query->where(function($q) use ($search){
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('lastName', 'LIKE', "%{$search}%")
                    ->orWhere('login', 'LIKE', "%{$search}%");
            });
        }

        return $query->get();
    }

    public static function createAdminUser($request)
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required', 'password'],
                'idRole' => ['required'],
                'avatar' => ['avatar:user,avatar'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);


            if($validator->fails()){
                return $validator->fails();
            }


            if ($request->avatar) {
                $user = new User();
                $avatarPath = $user->uploadAvatar($request->file('avatar'));

                if ($avatarPath) {
                    $data['avatar'] = $avatarPath;
                    $user->update(['avatar'=> $avatarPath]);
                }
            }

            User::create($data);

            app()->route->redirect('/admin');
        }
    }

}