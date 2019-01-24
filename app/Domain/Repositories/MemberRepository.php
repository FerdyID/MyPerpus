<?php
/**
 * Created by PhpStorm.
 * User: FERDY
 * Date: 12/16/2018
 * Time: 3:26 AM
 */

namespace App\Domain\Repositories;

use App\Domain\Entities\Member;

class MemberRepository extends AbstractRepository
{
    protected $model;
    
    /**
     * MemberRepository constructor.
     * @param Member $member
     */
    public function __construct(Member $member)
    {
        $this->model = $member;
    }
    
    public function getAll()
    {
        return parent::getAll(); // TODO: Change the autogenerated stub
    }
    
    public function getById($id)
    {
        return parent::getById($id); // TODO: Change the autogenerated stub
    }
    
    public function getByField($att, $field)
    {
        return parent::getByField($att, $field); // TODO: Change the autogenerated stub
    }
    
    public function paginate($limit, $key, $search)
    {
        return parent::paginate($limit, $key, $search); // TODO: Change the autogenerated stub
    }
    
    public function create(array $attributes)
    {
        return parent::create($attributes); // TODO: Change the autogenerated stub
    }
    
    public function update($id, array $attributes)
    {
        return parent::update($id, $attributes); // TODO: Change the autogenerated stub
    }
    
    public function delete($id)
    {
        return parent::delete($id); // TODO: Change the autogenerated stub
    }
}