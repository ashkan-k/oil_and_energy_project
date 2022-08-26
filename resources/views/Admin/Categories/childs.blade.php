@extends('layouts.admin-master')

@section('title')لیست دسته بندی ها@endsection

@section('Styles')
    <style>
        #list_tr {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    {{--                    <h4 class="card-title">لیست جدول ها</h4>--}}
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">

                        @include('Admin.Section.components.search_box')

                        @if(count($objects))
                            <table id="demo-foo-addrow"
                                   class="table m-t-10 highlight contact-list footable-loaded footable"
                                   data-page-size="10">
                                <thead>
                                <tr>
                                    <th class="footable-sortable">#</th>

                                    <th class="footable-sortable">نام</th>

                                    <th class="footable-sortable">نامک (slug)</th>

                                    <th class="footable-sortable">دسته والد</th>

                                    <th class="footable-sortable">نوع آیتم</th>

                                    <th class="footable-sortable">تاریخ ثبت</th>

                                    <th class="footable-sortable">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr id="list_tr"
                                        onclick="window.location.href='@if(count($item->childs) > 0) {{ route("tables.childs.detail",$item->slug) }} @else {{ route("tables.index",$item->slug) }} @endif'"
                                        class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        <td>{{ strtoupper(str_replace('_' , ' ' ,$item->name)) }}</td>

                                        <td>{{ \Illuminate\Support\Str::limit($item->slug,15) }}</td>

                                        <td>{{ $item->parent ? \Illuminate\Support\Str::limit($item->parent->name,15) : 'ندارد' }}</td>

                                        <td>
                                        <span
                                            class="label label-{{ count($item->childs) > 0 ? 'danger' : 'success' }}">{{ $item->get_child_type() }}</span>
                                        </td>

                                        <td>{{ count($item->childs) > 0 ? 'دسته بندی فرزند' : 'جدول' }}</td>

                                        <td>{{ $item->getCreated() }}</td>

                                        <td>
                                            <a title="نمایش"
                                               href="@if(count($item->childs) > 0) {{ route("tables.childs.detail",$item->slug) }} @else {{ route("tables.index",$item->slug) }} @endif"
                                               class="btn btn-info"><i
                                                    class="ti-bar-chart"
                                                    aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-right">
                                            {{ $objects->links('Admin.Section.components.pagination') }}
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
    @include('Admin.Section.components.search_box_js')
@endsection
