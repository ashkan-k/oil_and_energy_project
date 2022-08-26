@extends('layouts.admin-master')

@section('title')لیست محتوا ها@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    {{--                    <h4 class="card-title">لیست محتوا ها</h4>--}}
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">

                        <a href="{{ route('posts.create') }}" class="waves-effect waves-light btn btn-info">
                            محتوا جدید <i class="material-icons right">add</i>
                        </a>

                        @include('Admin.Section.components.search_box')

                        @if(count($objects))
                            <table id="demo-foo-addrow"
                                   class="table m-t-10 highlight contact-list footable-loaded footable"
                                   data-page-size="10">
                                <thead>
                                <tr>
                                    <th class="footable-sortable">#</th>

                                    <th class="footable-sortable">عنوان</th>

                                    <th class="footable-sortable">دسته بندی</th>

                                    <th class="footable-sortable">تعداد بازدید</th>

                                    <th class="footable-sortable">عکس</th>

                                    <th class="footable-sortable">تاریخ ثبت</th>

                                    <th class="footable-sortable">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr style="" class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        <td>{{ $item->title }}</td>

                                        <td>{{ $item->post_category->name }}</td>

                                        <td>{{ $item->view_count }}</td>

                                        <td>
                                            <img src="{{ $item->image }}" width="80" alt="{{ $item->title }}">
                                        </td>

                                        <td>{{ $item->getCreated() }}</td>

                                        <td>
                                            <form action="{{ route('posts.destroy' , $item->id) }}"
                                                  id="delete_form_{{ $loop->index }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button title="حذف" onclick="return Delete('{{ $loop->index }}')"
                                                        type="button" class="btn btn-danger">
                                                    <i class="ti-close" aria-hidden="true"></i>
                                                </button>

                                                <a title="ویرایش" href="{{ route('posts.edit' , $item->id) }}"
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
