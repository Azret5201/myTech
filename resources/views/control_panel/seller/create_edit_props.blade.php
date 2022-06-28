@if(!$type) {{--IF EDIT PROPS--}}
<form action="{{ route('product.update.properties', $userProduct) }}" method="POST">
    @csrf
    @method('PUT')
    @foreach($userProduct->userProductProperties as $userProductProperty)
        <div class="col-12 mt-3">
            <div class="form-group">
                <div class="row">
                    <label
                        for="exampleFormControlInput1">{{ $userProductProperty->defaultProperty->name }}</label>
                    <input type="text" class="form-control"
                           name="props[prop_{{ $userProductProperty->default_property_id }}]" value="{{ $userProductProperty->value }}">
                    <input type="hidden" class="form-control" name="propIds[]"
                           value="{{  $userProductProperty->default_property_id }}">
                </div>
            </div>
        </div>
    @endforeach
    <div class="form-group">
        <label for="exampleFormControlInput1">Количество</label>
        <input type="text" class="form-control"
               name="quantity" value="{{ $userProduct->quantity }}">
    </div>
    <div class="col-12 pt-3">
        <button type="submit" class="btn btn-success">Изменить</button>

    </div>
</form>

@else {{--ELSE CREATE PROPS--}}

<form action="{{ route('product.store.properties') }}" method="POST">
    @csrf
    @foreach($product->productProperties as $key => $property)
        @if($property->should_user_fill)
            <div class="col-12 mt-3">
                <div class="form-group">
                    <label
                        for="exampleFormControlInput1">{{ $property->propName->name }}</label>
                    <input type="text" class="form-control"
                           name="props[prop_{{ $property->propName->id }}]" {{ $property->should_user_fill ? 'required' : '' }}>
                    <input type="hidden" class="form-control" name="propId[]"
                           value="{{ $property->propName->id }}">
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
            </div>
        @endif

    @endforeach
    <div class="form-group">
        <label for="exampleFormControlInput1">Количество</label>
        <input type="text" class="form-control"
               name="quantity" required>
    </div>
    <div class="col-12 pt-3">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</form>

@endif
