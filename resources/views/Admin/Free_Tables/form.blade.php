@extends('layouts.admin-master')

@section('title'){{ isset($table) ? 'ویرایش داده' : 'افزودن داده' }}@endsection

@section('content')
    <div class="row" ng-init="Init()">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    @if(isset($table))
                        <h5 class="card-title activator">ویرایش داده برای {{ $category->name }}</h5>
                    @else
                        <h5 class="card-title activator">افزودن داده جدید به {{ $category->name }}</h5>
                    @endif
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($table)){{ route('tables.update' , $table->id) }}@else{{ route('tables.store') }}@endif">

                        @csrf
                        @if(isset($table))
                            @method('PATCH')
                        @endif

                        <input type="hidden" value="{{ $category->id }}" name="category_id">

                        @foreach($category->getColumns() as $c)
                            @php $filed_name = strtolower(str_replace(' ' , '_' ,$c)); @endphp
                            <div class="row">
                                <div class="input-field col s12">
                                <textarea id="desc" name="{{ $filed_name }}" class="materialize-textarea"
                                          style="height: 100px;">{{ isset($table->$filed_name) ? $table->$filed_name : old("$c") }}</textarea>
                                    <label for="desc">{{ $c }}</label>
                                </div>
                            </div>
                        @endforeach

                        <div class="row" style="margin-top: 10% !important;">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                <a href="{{ route('categories.index') }}"
                                   class="btn red waves-effect waves-light right m-l-10" type="button">
                                    بازگشت
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
