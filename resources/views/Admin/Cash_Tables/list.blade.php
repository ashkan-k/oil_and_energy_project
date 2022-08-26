@extends('layouts.admin-master')

@section('title'){{ $slug }}@endsection

@section('Styles')
    <style>
        td {
            direction: ltr !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">

                        @if(auth()->user()->is_superuser && $category->items()->count() > 0)
                            <a href="{{ route('tables.create',$slug) }}" class="waves-effect waves-light btn btn-info">
                                داده جدید <i class="material-icons right">add</i>
                            </a>
                        @endif

                        <h4 class="waves-effect text-center waves-light btn btn-success full-width"
                            style="margin: 0 auto!important;">{{ $category->name }}</h4>

                        @include('Admin.Section.components.search_box')

                        @if(count($objects))
                            <table id="demo-foo-addrow"
                                   class="table m-t-10 highlight contact-list footable-loaded footable"
                                   data-page-size="10">
                                <thead>
                                <tr>
                                    <th class="footable-sortable">#</th>

                                    @foreach ($category->items as $column)
                                        <th class="footable-sortable">{{ strtoupper(str_replace('_' , ' ' ,$column->title)) }}</th>
                                    @endforeach

                                    @if(auth()->user()->is_superuser)
                                        <th class="footable-sortable">عملیات</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr style="" class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        @foreach($category->items as $column)
                                            @php
                                                $current_data = $item->where('item_id', $column->id)->first() ? $item->where('item_id', $column->id)->first()->value : null;
                                            @endphp
                                            @if(str_starts_with($current_data,'+'))
                                                <td><span class="badge bg-success">{{ $current_data }}</span></td>
                                            @elseif(str_starts_with($current_data,'-'))
                                                <td><span class="badge bg-danger">{{ $current_data }}</span></td>
                                            @else
                                                <td>{{ $current_data }}</td>
                                            @endif
                                        @endforeach

                                        @if(auth()->user()->is_superuser)
                                            <td>
                                                <form action="{{ route('tables.destroy' , $item[0]['row_code']) }}"
                                                      id="delete_form_{{ $loop->index }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <input type="hidden" name="category_slug"
                                                           value="{{ $category->slug }}">

                                                    <button title="حذف" onclick="return Delete('{{ $loop->index }}')"
                                                            type="button" class="btn btn-danger">
                                                        <i class="ti-close" aria-hidden="true"></i>
                                                    </button>

                                                    <a title="ویرایش"
                                                       href="{{ route('tables.edit',[$item[0]['row_code'],$slug]) }}"
                                                       class="btn btn-primary"><i
                                                            class=" ti-pencil"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-right">
                                            {{--                                            {{ $objects->links('Admin.Section.components.pagination') }}--}}
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @else
                            <h4 style="text-align: center; padding: 60px;color: red">اطلاعاتی در دسترسی نیست</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    @include('Admin.Section.components.sweet_alert')
    @include('Admin.Section.components.delete')
    @include('Admin.Section.components.search_box_js')
@endsection
