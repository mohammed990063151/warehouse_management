@extends('admin.layouts.master') 
@section('title')
  البيانات المنتج
@stop
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <small>{{ $products->total() }}</small></h3>

                    <form action="{{ route('dashboard.products.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_products'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body table-responsive">

                    @if ($products->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                {{-- <th>@lang('site.image')</th> --}}
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent') %</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{ $product->category->name }}</td>
                                    {{-- <td><img src="{{ $product->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td> --}}
                                    <td>${{ number_format($product->purchase_price, 2) }}</td>
                                    <td>${{ number_format($product->sale_price, 2) }}</td>
                                    <td>{{ $product->profit_percent }} %</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_products'))
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_products'))
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" id="delteForm" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger  btn-sm" onclick="event.preventDefault();
                                                DeleteApp('delteForm')"><i class="fa fa-trash"></i> @lang('site.delete')</button>  </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{ $products->appends(request()->query())->links() }}
                        
                    @else
                        
                        <h2>@lang('site.no_data_found')</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    function DeleteApp(val) {
         console.log();
        Swal.fire({
            title:" @lang('هل أنت واثق؟')",
            text: " @lang('لن تتمكن من التراجع عن هذا!')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: " @lang('نعم ، احذفها!')", 
            cancelButtonText: " @lang('إلغاء')"
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    " @lang('تم الحذف')",
                    " @lang('تم حذف ملفك.')",
                    " @lang('النجاح')"
                );
                document.getElementById(val).submit();
            }
});
    }
</script>
@endsection
