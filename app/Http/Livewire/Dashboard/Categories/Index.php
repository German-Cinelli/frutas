<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Category;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    protected $listeners = ['categoryCreated' => 'render'];

    public function render()
    {
        $categories =  Category::where('categories.name','like','%'. $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->withTrashed()
            ->paginate(10);

        return view('livewire.dashboard.categories.index', compact('categories'));
    }

    /**
     * Método para ordenar los datos en la tabla
     */
    public function order($sort){
        if ($this->sort == $sort) {
            $this->direction = ($this->direction == 'desc' ? 'asc' : 'desc');
        } else {
            $this->sort = $sort;
            $this->direction == 'asc';
        }
    }


    /**
     * Método para eliminar una categoría
     */
    public function destroy($category_id){
        $category = Category::find($category_id);

        if($category->products->isEmpty()){
            $delete = $category->delete();
            if($delete){
                $this->notification('success', 'Categoría eliminada');
            } else {
                $this->notification('danger', 'Se produjo un error al eliminar la categoría');
            }
        } else {
            $this->notification('error', 'No puedes eliminar la categoría, tiene productos asociados!');
        }

    }

    /**
     * Método para eliminar una categoría
     */
    public function restore($category_id){
        $category = Category::withTrashed()->find($category_id);

        $restore = $category->restore();

        if($restore){
            $this->notification('success', 'Categoría restaurada');
        } else {
            $this->notification('danger', 'Se produjo un error al restaurar la categoría');
        }
    }



    /**
     * Notifications
     */
    public function notification($type, $message){
        switch ($type) {
            case 'success':
                $this->dispatchBrowserEvent('alert-success', [
                    'message' => $message
                ]);
                break;

            case 'warning':
                $this->dispatchBrowserEvent('alert-warning', [
                    'message' => $message
                ]);
                break;

            case 'error':
                $this->dispatchBrowserEvent('alert-error', [
                    'message' => $message
                ]);
                break;
            
            default:
                $this->dispatchBrowserEvent('alert-success', [
                    'message' => 'Algo salió mal, por favor recargue nuevamente la página.'
                ]);
                break;
        }
    }
    
}
