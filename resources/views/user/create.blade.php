@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add user</h1>
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
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="surname" value="{{ old('surname') }}" class="form-control" placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <input type="text" name="patronymic" value="{{ old('patronymic') }}" class="form-control" placeholder="Patronymic">
                    </div>
                    <div class="form-group">
                        <input type="text" name="age" value="{{ old('age') }}" class="form-control" placeholder="Age">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="confirm password">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <select name="gender" class="custom-select form-control">
                            <option disabled selected>Gender</option>
                            <option value="1">Female</option>
                            <option value="2">Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="role" class="custom-select form-control">
                            <option disabled selected>Role</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
