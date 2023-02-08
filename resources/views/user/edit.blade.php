@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Tag</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('user.update', $user) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <input type="text" name="name" value={{ $user->name }} class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" name="surname" value={{ $user->surname }} class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" name="patronymic" value={{ $user->patronymic }} class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value={{ $user->address }} class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <select name="gender" class="custom-select form-control">
                            <option disabled selected>Gender</option>
                            <option {{ $user->gender == 1 ? ' selected' : '' }} value="1">Female</option>
                            <option {{ $user->gender == 2 ? ' selected' : ''}} value="2">Male</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
