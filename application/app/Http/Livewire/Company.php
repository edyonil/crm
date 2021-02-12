<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company as CompanyModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Company extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = ['deletedAt' => 'destroy'];

    //public $data;

    public $isOpen = false;
    public $isOpenDelete = false;
    public $company;

    public $name;
    public $role;
    public $photo;
    public $imagePath;
    public $photoPreview;
    public $selectedId;
    public $search = "";
    
    protected $messages = [
        'name.required' => 'Campo email obrigatório',
        'role.required' => 'Campo responsável',
        'photo.required' => 'Você precisa enviar a marca do cliente',
    ];

    public function render()
    {
        return view('livewire.company', [
            'data' => CompanyModel::search($this->search)->paginate(10)
        ]);
    }

    public function create()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset();
    }

    public function closeModalDelete()
    {
        $this->company = null;
        $this->isOpenDelete = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'role' => 'required',
            'photo' => 'required'
        ]);

        CompanyModel::create([
            'name' => $this->name,
            'role' => $this->role,
            'image_path' => $this->photo->store('photos'),
            'status' => true
        ]);
        $this->reset();
        session()->flash('message', 'Registro cadastrado com sucesso');

        $this->photoPreview = null;
        $this->dispatchBrowserEvent('clear-photo');

        $this->closeModal();
    }

    public function edit($id)
    {
        $this->isOpen = true;
        $result = CompanyModel::findOrFail($id);
        $this->name = $result->name;
        $this->role = $result->role;
        $this->imagePath = $result->image_path;
        $this->selectedId = $result->id;
    }

    public function update()
    {
        $result = CompanyModel::findOrFail($this->selectedId);
        
        $this->validate([
            'name' => 'required',
            'role' => 'required',
            'photo' => 'sometimes'
        ]);

        $result->update([
            'name' => $this->name,
            'role' => $this->role,
            'image_path' => is_null($this->photo) ? $this->imagePath : $this->photo->store('photos'),
        ]);

        $this->dispatchBrowserEvent('remove-photo');

        $this->reset();
        $this->imagePath = null;
        $this->selectedId = null;
        session()->flash('message', 'Registro atualizado com sucesso');
        
        //$this->closeModal();
    }

    public function delete($id)
    {
        $this->company = CompanyModel::findOrFail($id);
        $this->isOpenDelete = true;
    }

    public function destroy($id)
    {
        CompanyModel::destroy($id);
        $this->isOpenDelete = false;
        $this->company = null;
    }

    public function activeOrInactive($id)
    {
        $company = CompanyModel::findOrFail($id);
        $company->status = !$company->status;
        $company->save();
    }
}
