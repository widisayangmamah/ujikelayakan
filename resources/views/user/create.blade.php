@extends('layout.template')

@section('content')
    <form action="{{ route('user.store') }}" method="POST" class="card p-5">
        @csrf

        @if(Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Email : </label>
            <div class="col-sm-10">
            <input type="gmail" class="form-control" id="email" name="email">
            </div>
            <input type="hidden" name="role" value="staff">
        </div>
    <div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </div>
    </form>
@endsection
