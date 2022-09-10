@extends('admin.layouts.master') 
@section('title')
بيانات الخزانة
@stop
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.Cabinet')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.Cabinet')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    {{-- <h3 class="box-title" style="margin-bottom: 15px">@lang('site.Cabinet') <small>{{ $Cabinet->total() }}</small></h3> --}}

                    <form action="{{ route('dashboard.Cabinet.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_Cabinet'))
                                    <a href="{{ route('dashboard.Cabinet.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled" ><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                                @if (auth()->user()->hasPermission('read_Cabinet'))
                                <a href="#" class="btn btn-primary" data-target="#exampleModal2"  data-toggle="modal"><i class="fa fa-money"></i> @lang('site.Inventory_goods')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-money"></i> @lang('site.Inventory_goods')</a>
                            @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body table-responsive">

                    @if ($Cabinet->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                
                                <th>@lang('site.description')</th>
                                <th>@lang('site.created_at')</th>
                                <th>المستخدم</th>
                                <th>@lang('site.Entry_amount')</th>
                                <th>@lang('site.departed')</th>
                                <th></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($Cabinet as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    
                                    <td>{!! $user->description !!}</td>
                                    <td>{{ $user->Created_by }}</td>
                                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                    <td><span class="text-success">{{ number_format($user->Cabinet, 2) }}</span></td>
                                    <td>  
                                        <span class="text-danger"> {{ number_format($user->departed, 2) }}</span>
                                </td>

                                      <td>
                                        @if (auth()->user()->hasPermission('update_Cabinet'))
                                            <a href="{{ route('dashboard.Cabinet.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_Cabinet'))
                                            <form action="{{ route('dashboard.Cabinet.destroy', $user->id) }}" method="post"  id='delteForm' style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger  btn-sm" onclick="event.preventDefault();
                                                DeleteApp('delteForm')"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach

                            <tr style="font-weight: bold">
                                <td>#</td>
                                <td colspan="3">المجموع:</td>

                                <td><span class="bg-success text-white">{{ number_format($int, 2) }}</span></td>
                                <td><span class="bg-danger text-white">{{ number_format($data, 2) }}</span></td>
                                
                            </tr>

                            <tr style="font-weight: bold">
                                <td>#</td>
                                <td colspan="3">الكاش المتوفرة:</td>

                                <td><span class="bg-warning text-white">{{ number_format($int - $data, 2) }}</span></td>
                                
                                
                            </tr>
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{-- {{ $Cabinet->appends(request()->query())->links() }} --}}
                        
                    @else
                        
                        <h2>@lang('site.no_data_found')</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">جرد  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">

                    <div class="box box-primary">
        
                        <div class="box-header">
                            <h3 class="box-title">تحصيل ارباح في النظام</h3>
                        </div><!-- end of box header -->
        
                        <div class="box-body">
        
                            @include('admin.partials._errors')
        
                             
                            <div class="form-group">
                                <label>الكاش المتوفرة:</label>
                                <span class="bg-warning text-white">{{ number_format($int - $data, 2) }}</span>
                            </div>

                            <div class="form-group">
                                <label>الكاش الخارجه:</label>
                                <span class="bg-warning text-white">{{ number_format($discuont, 2) }}</span>
                            </div>

                            <div class="form-group">
                                <label> قيمة بضاعة المخزن:</label>
                                <span class="bg-warning text-white">{{number_format($Stored_capital, 2)}}</span>
                            </div>
                            <div class="form-group totle_cash">
                                <label> المجموع:</label>
                                {{-- <span class="bg-warning text-white totle"  value="{{ number_format($discuont + $int - $data , 2) }}" id="totle">{{ number_format($discuont + $int - $data , 2) }}</span> --}}
                                <input type="number" class="form-control" step="0.01" name="totle" value="{{ intval(preg_replace('/[^0-9]+/', '', $discuont + $Stored_capital + $int - $data), 10)}}"  id="totle" name="sale_qure" readonly >
                            </div>

                            <div class="form-group">
                                <label> سعر الجنية المصري اليوم:</label>
                                <input type="number" class="form-control" step="0.01" name="qure" min='0' id="qure" name="sale_qure"  onchange="myFunction()">
                            </div>
                            <div class="form-group">
                                <label>    المجموعة بالجنية المصري:</label>
                                <input type="number" class="form-control" step="0.01" name="totle_qure" min='0' id="totle_qure" name="sale_qure" readonly >
                            </div>
         
                            
                            <div class="form-group">
                                <label>   راس المال بجنية المصري:</label>
                                <input type="number" class="form-control" value="{{ intval(preg_replace('/[^0-9]+/', '', $products_capital), 10)}}" id ='totle_capitale' readonly >
                            </div>

                            <div class="form-group">
                                <label>   صافية الارباح بالمصري</label>
                                <input type="number" class="form-control"  id ='net_profit' readonly >
                            </div>
                            <div class="form-group">
                                <label>   صافية الارباح بالسوداني</label>
                                <input type="number" class="form-control"  id ='net_profit_sudain' readonly >
                            </div>
        
        
                        </div><!-- end of box body -->
        
                    </div><!-- end of box -->
        
                </section>
           
          </div>
        </div>
    </div>
</div>



<script>
    function myFunction() {
           

        var totle=$(this).closest('.totle_cash').find('.total').html();
        var totle = parseFloat(document.getElementById("totle").value);
        var totle_capitale = parseFloat(document.getElementById("totle_capitale").value);

        console.log(totle_capitale);
        var qure = parseFloat(document.getElementById("qure").value);
        // console.log(qure);
        var totle_qure = parseFloat(document.getElementById("totle_qure").value);
       


        var Amount_Commission3 = totle / qure;
        var Amount_Commission4 = Amount_Commission3 - totle_capitale;
        var net_profit_sudain = Amount_Commission4 * qure;

        if (typeof Amount_Commission3 === 'undefined' || !Amount_Commission3) {

            alert('يرجي ادخال مبلغ تحويل العملة ');

        } else {
            var intResults = Amount_Commission3 ;
            var intResults_capitale = Amount_Commission4 ;
            var intResults_net_profit = net_profit_sudain ;

            sumq = parseFloat(intResults).toFixed(2);
            sumq2 = parseFloat(intResults_capitale).toFixed(2);
            sumq_net_profit = parseFloat(intResults_net_profit).toFixed(2);

           document.getElementById("totle_qure").value = sumq;
           document.getElementById("net_profit").value = sumq2;
           document.getElementById("net_profit_sudain").value = sumq_net_profit;
            

        }

    }

</script>

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
