@extends('layouts.main')
@section('content')
    <input type="hidden" value="addProduct" id="currentPage">
    <form action="/products/add" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="name">
        <select name="category_id" id="">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <select name="brand_id" id="">
            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
        <input type="file" multiple name="images[]">
        <input type="number" name="price" placeholder="price">
        <textarea name="description" id="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel placerat lacus. Mauris tempus pharetra metus. Mauris ut tincidunt magna, in molestie ipsum. Fusce vitae quam vehicula, accumsan orci ac, pulvinar odio. Curabitur est ipsum, efficitur lobortis eleifend vitae, fermentum sit amet risus. Morbi et mi et ex convallis hendrerit. Nulla non nisl ex.</textarea>
        <input type="submit">
    </form>
@endsection
