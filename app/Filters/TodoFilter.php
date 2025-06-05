<?php
namespace App\Filters;

use Illuminate\Http\Request;

class TodoFilter{

    protected $request;

    
       public function __construct(Request $request)
       {
            $this->request=$request;
       }
    

    public function searchAndFilter($query){

        $search=$this->request->input('search');
        $priority=$this->request->input('priorityId');
        $category=$this->request->input('categoryId');

        $data=$query->when($search,function($q) use ($search){
              $q->where(function ($q2) use ($search) {
                $q2->where('title', 'like', '%'.$search.'%')
                   ->orWhere('description', 'like','%'.$search.'%');
            });
        })->when($priority,function($q) use ($priority){
            $q->where('priority_id',$priority);
        })->when($category,function($q) use ($category){
            $q->where('category_id',$category);
        });

        return $data;



    }



}