<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends AbstractRepository
{
    protected $model;
    
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }
    
    /**
     * @param $att
     * @param $field
     * @return mixed
     */
    public function getByField($att, $field)
    {
        return parent::getByField($att, $field);
    }
    
    /**
     * @param int $limit
     * @param $key
     * @param string $search
     * @return mixed
     */
    public function paginate($limit, $key, $search = '')
    {
        return $this->model
            ->orderBy('created_at', 'asc')
            ->where($key, 'like', '%' . $search . '%')
            ->paginate($limit);
    }
    
    public function created($image, array $data)
    {
        return parent::create([
            'name'     => e($data['name']),
            'email'    => e($data['email']),
            'level'    => e($data['level']),
            'password' => bcrypt(e("qwerty")),
            'gambar'   => $image
        ]);
    }
    
    /**
     * @param $id
     * @param $image
     * @param array $data
     * @return mixed
     */
    public function updated($id, $image, array $data)
    {
        $users = parent::getById($id);
    
        /*        if (e($data['password'])) {
                    if ($users->level == 'admin') {
                        $level = e($data['level']);
                    } else {
                        $level = 'user';
                    }
                }*/
    
        if (Auth::user()->id == $id) {
            $password = bcrypt(e($data['password']));
        } elseif (Auth::user()->level == 'admin' && Auth::user()->id != $id) {
            $password = $users->password;
        }
    
    
        if ($users->level == 'admin') {
            $level = e($data['level']);
        } else {
            $level = 'user';
        }
    
        /*        if (e($data['password'])) {
                    $password = bcrypt(e($data['password']));
                }*/
        
        return parent::update($id, [
            'name'     => e($data['name']),
            'email'    => e($data['email']),
            'level'    => $level,
            'password' => $password,
            'gambar'   => $image
        ]);
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        return parent::delete($id);
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return parent::getById($id);
    }
    
}
