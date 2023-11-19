@extends('layouts.app')
@section('title')
    Professeur
@endsection

@section('filsAriane')
    <li class="breadcrumb-item active">Professeur</li>
@endsection
@section('content')
    <section class="content card card-primary card-outline p-4">
        <div class="text-end">
            <button type="button" class="btn btn-primary m-4 float-right" data-toggle="modal" data-target="#create_modal">
                <i class="fas fa-plus-circle">
                </i>
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total: ({{ count($users) }})</h3>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects" id="example1">
                <thead class="text-left">
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Nom</th>
                        <th style="width: 30%">Nombre de cours</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $user->prenom }} {{ $user->nom }}
                            </td>
                            <td>
                                {{ count($user->professeur->cours) ?? '0' }}
                            </td>
                            <td class="item-actions text-right">
                                <a class="btn btn-light btn-sm" href="/" title="voir"><i class="fas fa-eye"></i></a>

                                <a class="btn btn-light btn-sm" href="/"><i class="fas fa-pencil-alt"
                                        title="editer"></i></a>

                                <a class="btn btn-danger btn-sm" href="/" onclick="supprimer(event)"
                                    project="Voulez-vous supprimer le Projet " data-toggle="modal" data-target="#supprimer"
                                    title="archiver">
                                    <i class="fas fa-archive"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
        @include('professeurs.create')
    </section>
@endsection

@push('third_party_scripts')
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
@endpush

@push('page_css')
    @vite('node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')
    @vite('node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')
    @vite('node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')
@endpush


@push('page_scripts')
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>




    <script type='module'>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "searching": true,
                "ordering": true,
                "paging": true,
                "data": "",
                "buttons": [{
                    extend: 'csv',

                }, "excel", {
                    extend: 'pdf',

                }, {
                    extend: 'print',
                }, "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
