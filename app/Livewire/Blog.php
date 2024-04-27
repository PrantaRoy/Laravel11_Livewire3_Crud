<?php

namespace App\Livewire;

use App\Models\Blog as BlogModel;
use Livewire\Component;

class Blog extends Component
{

    public $blogs, $id, $title , $description;
    public $updateBlog = false;

    protected $listeners = [
        'deleteBlog'=>'destroy'
    ];

    protected $rules = [
        'title'=>'required',
        'description'=>'required'
    ];

    public function resetFields(){
        $this->title = '';
        $this->description = '';
    }


    public function createBlog(){
        $this->validate();

        try {
            BlogModel::create([
                'title' => $this->title,
                'description' => $this->description,
                'author_id' => auth()->id(),
                'status' => 'publish',
            ]);

            $this->resetFields();
            session()->flash('success','Blog Created Successfully!');

          
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
    }


    public function updateBlog($id){
        $this->validate();

        try {
            BlogModel::find($id)->update([
                'title' => $this->title,
                'description' => $this->description,
                'author_id' => auth()->id(),
                'status' => 'publish',
            ]);
            session()->flash('success','Blog Updated Successfully!!');
            $this->cancel();
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
    }

    

    public function edit($id){
        $blog = BlogModel::find($id);
        $this->id = $blog->id;
        $this->title = $blog->title;
        $this->description = $blog->description;
        $this->updateBlog = true;
    }

    public function cancel(){
        $this->resetFields();
        $this->updateBlog = false;
    }

    public function render()
    {
        $this->blogs = BlogModel::with('user:id,name')->get();
        return view('livewire.blog');
    }


    public function destroy($id){
        try {
           BlogMode::find($id)->delete();
           session()->flash('success',"Blog Deleted Successfully!!");
        } catch (\Throwable $th) {
            session()->flash('error',"Something goes wrong while deleting blog!!");
        }
    }
}
