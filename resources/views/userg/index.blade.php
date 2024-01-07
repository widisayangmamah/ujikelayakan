@extends('layout.template')

@section('content')
@if(Session::get('deleted'))
    <div class="alert alert-warning">{{Session::get('deleted')}}</div>
@endif
<div class="jumbotron py-4 px-5">
          <h1 class="display-4">
              Selamat Datang!
          </h1>
          <p>Silahkan tambah data Guru</p>
        <div class="container mt-5">
<a href="{{ route('userg.create') }}" class="btn btn-secondary mb-4" style="float: right">Tambah Pengguna</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($userg as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('userg.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button> 
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
