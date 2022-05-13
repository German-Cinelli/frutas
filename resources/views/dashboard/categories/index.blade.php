@extends('dashboard/dashboard')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Categorias</h4>
                <button class="btn btn-info btn-fw float-right mt-3" data-toggle="modal" data-target="#modal-category-create"><i class="fa fa-plus"></i> Nueva categoría</button>
                <!--<p class="mb-0">Your business dashboard template</p>-->
            </div>
        </div>
    </div>

    @livewire('dashboard.categories.index')

@endsection

