@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Product</h1>
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
                <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <input type="text" name="title" value="{{ $product->title }}" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" value="{{ $product->description }}" class="form-control" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="content" class="form-control" placeholder="{{ $product->content }}"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" value="{{ $product->count }}" class="form-control" placeholder="Count in the stock">
                    </div>
                    <div class="form-group">
                        <input type="text" name="preview_image" value="{{ $product->preview_image }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            @foreach($categories as $category)
                                @if ($category->id === $product->category->id)
                                    <option value="{{ $product->category->id }}" selected="selected">{{ $product->category->title}}</option>
                                    @else
                                       <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Select tags" style="width: 100%;">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endforeach
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
