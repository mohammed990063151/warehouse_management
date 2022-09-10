@extends('admin.layouts.master') 
@section('title')
تعديل بيانات المنتج
@stop
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('admin.partials._errors')

                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $product->name }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.description')</label>
                                <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ $product->description }}</textarea>
                            </div>

                        @endforeach

                        {{-- <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div> --}}
                        <div  class="row">
                            <div class="col-md-6">
                            <label>@lang('site.purchase_price')</label>
                            <input type="number" name="purchase_price"  step="0.01" id="Amount_Commission" class="form-control" value="{{ $product->purchase_price}}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                             required>
                               </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('site.purchase_sudan')</label>
                                <input type="number" name="purchase_sudan" step="0.01" id="Rate_VAT" value="{{ $product->purchase_sudan}}" class="form-control" onchange="myFunction()">
                            </div>
                        </div>
    
                    </div>
                            <div class="form-group">
                                <label>@lang('site.purchase_qurio')<label>
                                    <input type="number" class="form-control" step="0.01" id="Value_VAT" value="{{ $product->sale_qure}}"   name="sale_qure" readonly>
                            </div>

                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="number" name="stock" class="form-control"  id="stock" value="{{ $product->stock}}" onchange="capitales()">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.capital')</label>
                                <input type="number" class="form-control" step="0.01" name="capital" id="capital" value="{{ $product->capital}}"   readonly>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


    
    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            // console.log(Amount_Commission);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
           


            var Amount_Commission2 = Amount_Commission / Rate_VAT;
           

            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ تحويل العملة ');

            } else {
                var intResults = Amount_Commission2 ;

                sumq = parseFloat(intResults).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;
                

            }

        }

    </script>

<script>
    function capitales() {

       
        var purchase_qurio = parseFloat(document.getElementById("Value_VAT").value);
       
        // alert(purchase_qurio);

        var stock = parseFloat(document.getElementById("stock").value);
       
        var capital = parseFloat(document.getElementById("capital").value);

        
        var capital_totle = stock * purchase_qurio;
        // console.log(capital_totle);
            if (typeof purchase_qurio === 'undefined' || !Amount_Commission) {

                alert('يجى اجراء العملية التحويل المبلغ');

                    } else {
                    
                       var capital_totle_Results = capital_totle ;

                              data = parseFloat(capital_totle_Results).toFixed(2);

                        document.getElementById("capital").value = data;

                                                 }


    }

</script>
@endsection
