@extends('layouts.app')
@section('title', 'طلبك عندنا')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex" style="margin: 10px 0;">
                <div class="point"></div>
                <p class="me-2 mb-0"> اضافه منتج جديد</p>
            </div>

            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control mt-2" id="name" name="name"
                                           placeholder="ادخل اسم المنتج">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="category">الصنف</label>
                                    <select name="category" id="category" class="form-control mt-2" >
                                        <option value="">اختار الصنف</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="price">السعر</label>
                                    <input type="number" class="form-control mt-2" id="price" name="price"
                                           placeholder="ادخل سعر المنتج">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="description">الوصف</label>
                                    <textarea type="text" class="form-control mt-2" id="description" name="description"
                                              placeholder="ادخل وصف المنتج"></textarea>
                                </div>



                                <div class="form-group mt-3">
                                    <label for="image">الصورة</label>
                                    <input type="file" class="form-control mt-2" id="image" name="image">
                                </div>

                                <button type="submit" class="btn btn-success mt-3">اضافه</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
