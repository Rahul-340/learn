@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name . __("'s Dashboard") }} |
                    {{-- <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userAddModal">Add User</button> --}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- {{ __('You are logged in Admin!') }} --}}
                    <div id="PageContent">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
