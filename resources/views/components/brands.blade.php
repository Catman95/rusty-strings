<div class="brands_products">
    <h2>Brands</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            @foreach($brands as $brand)
                <li><input type="checkbox" value="{{$brand->id}}" class="brandCheckbox"> <span class="pull-right">(4)</span>{{$brand->name}}</li>
            @endforeach
        </ul>
    </div>
</div>
