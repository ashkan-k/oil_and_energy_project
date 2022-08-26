@extends('layouts.admin-master')

@section('title')لیست جدول ها@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    {{--                    <h4 class="card-title">لیست جدول ها</h4>--}}
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">

                        <a href="{{ route('categories.create') }}" class="waves-effect waves-light btn btn-info">
                            جدول جدید <i class="material-icons right">add</i>
                        </a>
                        <form id="search_form">
                            <div id="editable-datatable_filter" style="float: right !important;">
                                <select name="filter" onchange="$('#search_form').submit()">
                                    <option value="" selected>همه</option>
                                    <option value="free" @if(request('filter') == 'free') selected @endif>رایگان ها</option>
                                    <option value="cash" @if(request('filter') == 'cash') selected @endif>اشتراک ها</option>
                                </select>
                            </div>

                            <div id="editable-datatable_filter" class="dataTables_filter"><input type="search"
                                                                                                 name="search"
                                                                                                 class=""
                                                                                                 value="{{ request('search') }}"
                                                                                                 id="search_input"
                                                                                                 placeholder="جستجو"
                                                                                                 aria-controls="editable-datatable">
                            </div>
                        </form>

                        @if(count($objects))
                            <table id="demo-foo-addrow"
                                   class="table m-t-10 highlight contact-list footable-loaded footable"
                                   data-page-size="10">
                                <thead>
                                <tr>
                                    <th class="footable-sortable">#</th>

                                    <th class="footable-sortable">نام</th>

                                    <th class="footable-sortable">نامک (slug)</th>

                                    <th class="footable-sortable">نوع جدول</th>

                                    <th class="footable-sortable">نام سرویس</th>

                                    <th class="footable-sortable">دسته والد</th>

                                    <th class="footable-sortable">تاریخ ثبت</th>

                                    <th class="footable-sortable">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr style="" class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        <td>{{ $item->name }}</td>

                                        <td>{{ \Illuminate\Support\Str::limit($item->slug,15) }}</td>

                                        <td>
                                        <span
                                            class="label label-{{ $item->type == 'free' ? 'success' : 'danger' }}">{{ $item->get_type() }}</span>
                                        </td>

                                        <td>{{ $item->service_name ?: 'ندارد' }}</td>

                                        <td>{{ $item->parent ? \Illuminate\Support\Str::limit($item->parent->name,15) : 'ندارد' }}</td>

                                        <td>{{ $item->getCreated() }}</td>

                                        <td>
                                            <form action="{{ route('categories.destroy' , $item->id) }}"
                                                  id="delete_form_{{ $loop->index }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                @if($item->type == 'cash' || ($item->columns && count($item->columns) > 4))
                                                    <a title="داده ها"
                                                       href="{{ route('tables.index',$item->slug) }}"
                                                       class="btn btn-info"><i
                                                            class="ti-bar-chart"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a title="داده ها"
                                                       href="{{ route('free_tables.index',$item->slug) }}"
                                                       class="btn btn-info"><i
                                                            class="ti-bar-chart"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                @if($item->type == 'cash')
                                                    <a title="ردیف ها"
                                                       href="{{ route('tables.items.create',$item->slug) }}"
                                                       class="btn btn-warning"><i
                                                            class="ti-plus"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <button title="حذف" onclick="return Delete('{{ $loop->index }}')"
                                                        type="button" class="btn btn-danger">
                                                    <i class="ti-close" aria-hidden="true"></i>
                                                </button>

                                                <a title="ویرایش" href="{{ route('categories.edit' , $item->id) }}"
                                                   class="btn btn-primary"><i
                                                        class=" ti-pencil"
                                                        aria-hidden="true"></i>
                                                </a>
                                            </form>
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
    @include('Admin.Section.components.sweet_alert')
    @include('Admin.Section.components.delete')
    @include('Admin.Section.components.search_box_js')
@endsection
