@extends('admin.layouts.main')
@section('title', 'Import data')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ Session::get('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ Session::get('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">

        <div class="card bg-light mt-3">

            <div class="card-body">
                <form action="{{ route('import-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    @if (count($errors->getMessages()) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Validation Errors:</strong>
                            <ul>
                                @foreach ($errors->getMessages() as $errorMessages)
                                    @foreach ($errorMessages as $errorMessage)
                                        <li>
                                            {{ $errorMessage }}
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button class="btn btn-success">Import Product Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
