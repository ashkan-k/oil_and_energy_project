@extends('layouts.admin-master')

@section('title')لیست تراکنش ها@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    {{--                    <h4 class="card-title">لیست دسته بندی ها</h4>--}}
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">
                        <form id="search_form">
                            <div id="editable-datatable_filter" class="dataTables_filter"><input type="search"
                                                                                                 name="search"
                                                                                                 class=""
                                                                                                 value="{{ request('search') }}"
                                                                                                 id="search_input"
                                                                                                 placeholder="جستجو"
                                                                                                 aria-controls="editable-datatable">
                            </div>

                            <div id="editable-datatable_filter" style="float: right !important;">
                                <select onchange="$('#search_form').submit()" name="status">
                                    <option value="">همه</option>
                                    <option @if(request('status') == 'success')selected @endif value="success">موفق</option>
                                    <option @if(request('status') == 'unsuccess')selected @endif value="unsuccess">ناموفق</option>
                                </select>
                            </div>
                        </form>

                        @if(count($objects))
                            <table id="demo-foo-addrow"
                                   class="table m-t-10 highlight contact-list footable-loaded footable"
                                   data-page-size="10">
                                <thead>
                                <tr>
                                    <th class="footable-sortable">#</th>

                                    <th class="footable-sortable">کاربر</th>

                                    <th class="footable-sortable">مبلغ</th>

                                    <th class="footable-sortable">وضعیت</th>

                                    <th class="footable-sortable">کد پیگیری</th>

                                    <th class="footable-sortable">تاریخ ثبت</th>

                                    <th class="footable-sortable">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr style="" class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        <td>{{ $item->user->full_name() }}</td>

                                        <td>{{ $item->amount }}</td>

                                        <td>
                                            <span
                                            class="label label-{{ $item->status ? 'success' : 'danger' }}">{{  $item->status ? 'موفق' : 'ناموفق' }}</span>
                                        </td>

                                        <td>{{ $item->refID ?: '---' }}</td>

                                        <td>{{ $item->getCreated() }}</td>

                                        <td>
                                            <form action="{{ route('payments.destroy' , $item->id) }}"
                                                  id="delete_form_{{ $loop->index }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button title="حذف" onclick="return Delete('{{ $loop->index }}')"
                                                        type="button" class="btn btn-danger">
                                                    <i class="ti-close" aria-hidden="true"></i>
                                                </button>
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
