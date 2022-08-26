@extends('layouts.admin-master')

@section('title'){{ isset($data) ? 'ویرایش داده' : 'افزودن داده' }}@endsection

@section('Styles')
    <style>
        textarea {
            height: 100px;
            direction: ltr !important;
        }
    </style>
@endsection

@section('content')
    <div class="row" ng-init="Init()">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    @if(isset($data))
                        <h5 class="card-title activator">ویرایش داده برای {{ $category->name }}</h5>
                    @else
                        <h5 class="card-title activator">افزودن داده جدید به {{ $category->name }}</h5>
                    @endif
                    @include('Admin.Section.components.form_errors')
                    <form method="post"
                          action="@if(isset($data)){{ route('tables.update' , $category->slug) }}@else{{ route('tables.store') }}@endif">

                        @csrf
                        @if(isset($data))
                            @method('PATCH')
                            <input type="hidden" value="{{ $row_code }}" name="last_row_code">
                        @endif

                        <input type="hidden" value="{{ $category->slug }}" name="category_slug">

                        @foreach($category->getColumnsAssCollection() as $c)
                            @php
                                $filed_name = strtolower(str_replace(' ' , '_' ,$c->title));
                                if (isset($data) && $current_item=\App\Models\Item::where('title',$c->title)->first()){
                                    $current_editable_filed = $data->where('item_id', $current_item->id)->first();
                                    $current_value = $current_editable_filed ? $current_editable_filed->value : null;
                                }
                            @endphp
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="{{ $c->id }}" name="{{ $c->id }}"
                                              class="materialize-textarea">{{ isset($data) ? $current_value : old("$filed_name") }}</textarea>
                                    <label for="{{ $c->id }}">{{ strtoupper(str_replace('_' , ' ' ,$c->title)) }}</label>
                                </div>
                            </div>
                        @endforeach

                        <div class="row" style="margin-top: 10% !important;">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit">
                                    ذخیره
                                </button>
                                @if(!isset($data))
                                    <button name="save_and_new" class="btn info waves-effect waves-light right m-l-10"
                                            type="submit">
                                        ذخیره و ایجاد یکی دیگر
                                    </button>
                                @endif
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
