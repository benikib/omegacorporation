<div>
    @extends('layouts.modal')

    @section('id_modal')
        id="create_modal"
    @endsection

    @section('modal-title')
        <h4 class="modal-title">Ajout d'un Courst</h4>
    @endsection
    @section('modal-content')
        <form class="form-horizontal" action="{{ route('cours_professor') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Intitulé</label>
                    <input type="text" name="intitule" class="form-control" placeholder="Nom du cours" required>
                </div>
                <div class="form-group">
                    <label for="name">Ponderation</label>
                    <input type="number" name="ponderation" class="form-control" placeholder="ponderation" required>
                </div>
                <div class="form-group">
                    <select name="professeur" id="" class="form-control">
                        <option value="" selected>null</option>
                        @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{$user->nom}}</option>
                        @empty
                        @endforelse
                    </select>
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
