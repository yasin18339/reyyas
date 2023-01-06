<?php

namespace Alireza\Comment\Repositories;

use Alireza\Comment\Models\Comment;

class CommentRepo
{
    public function index(){
        return $this->query()->latest();

    }
    public function delete($id){
        return $this->query()->where('id', $id)->delete();

    }
    public function findById($id){
        return $this->query()->findOrFail($id);

    }
    public function changeStatus($id, $status){

        return $this->findById($id)->update(['status' =>$status]);


    }
    public function getLatestComments()
    {
        return $this->query()->where('status', Comment::STATUS_ACTIVE)->latest();
    }

    private function query(){
        return Comment::query();
    }




}
