<div>
    @extends('layouts.modal')

    @section('id_modal')
        id="create_modal"
    @endsection

    @section('modal-title')
        <h4 class="modal-title">Ajout d'un professeur</h4>
    @endsection
    @section('modal-content')
        <form class="form-horizontal" action="{{route('create_professor')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row w-full">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nom </label>
                            <input type="text" name="name" class="form-control" placeholder="Nom du professeur" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Post-Nom </label>
                            <input type="text" name="name" class="form-control" placeholder="pst-nom du professeur" required>
                        </div>
                        <div class="form-group">
                            <label for="name">prenom </label>
                            <input type="text" name="name" class="form-control" placeholder="prenom du professeur" required>
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label for="name">Téléphone </label>
                            <input type="number" name="name" class="form-control" placeholder="prenom du professeur" required>
                        </div>
                        <div class="form-group">
                            <label for="name">email </label>
                            <input type="email" name="name" class="form-control" placeholder="prenom du professeur" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Cours </label>
                            <select class="form-control form-control" id="select-multiple" name="jalons[]" multiple>
                                @foreach ($cours as $cours)
                                    <option value="{{$cours->id}}"> {{ $cours->intitule }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-secondary"><i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                  </button>
            </div>
        </form>
    @endsection
</div>