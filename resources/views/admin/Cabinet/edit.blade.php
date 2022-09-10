@extends('admin.layouts.master') 
@section('title')
تعديل بيانات المشرفه
@stop
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.Cabinet')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.Cabinet.index') }}"> @lang('site.Cabinet')</a></li>
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

                    <form action="{{ route('dashboard.Cabinet.update', $Cabinet->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.Entry_amount')</label>
                            <input type="number" name="Cabinet" class="form-control" value="{{ $Cabinet->Cabinet }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.departed')</label>
                            <input type="number" name="departed" class="form-control" value="{{ $Cabinet->departed }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.description')</label>
                            <textarea name="description" class="form-control ckeditor" value="{{ $Cabinet->description }}">{{ $Cabinet->description }}</textarea>
                        </div>
                       

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
