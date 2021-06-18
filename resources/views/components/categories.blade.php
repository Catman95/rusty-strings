<h2>Category</h2>
<div class="panel-group category-products" id="accordian">
    @foreach($categories as $category)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><input type="checkbox" value="{{$category->id}}" class="categoryCheckbox"> <p>{{$category->name}}</p></h4>
            </div>
        </div>
    @endforeach
</div>
