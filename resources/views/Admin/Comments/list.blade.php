@extends('layouts.admin-master')

@section('title')لیست نظرات@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    {{--                    <h4 class="card-title">لیست نظرات</h4>--}}
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
                                    <option @if(request('status') == 'approved')selected @endif value="approved">تایید شده</option>
                                    <option @if(request('status') == 'rejected')selected @endif value="rejected">تایید نشده</option>
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

                                    <th class="footable-sortable">نام</th>

                                    <th class="footable-sortable">ایمیل</th>

                                    <th class="footable-sortable">مقاله</th>

                                    <th class="footable-sortable">وضعیت</th>

                                    <th class="footable-sortable">تاریخ ثبت</th>

                                    <th class="footable-sortable">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $item)
                                    <tr style="" class="footable-even">
                                        <td><span class="footable-toggle"></span>{{ $loop->index + 1 }}</td>

                                        <td>{{ $item->name }}</td>

                                        <td>{{ $item->email }}</td>

                                        <td>{{ $item->post->title }}</td>

                                        <td>
                                            <a ng-click="ChangeStatus({{ $item->status }}, {{ $item->id }})"
                                               href="#change-status-modal" class="modal-trigger">
                                                 <span
                                                     class="label label-{{ $item->status ? 'success' : 'danger' }}">{{ $item->get_type() }}</span>
                                            </a>
                                        </td>

                                        <td>{{ $item->getCreated() }}</td>

                                        <td>
                                            <form action="{{ route('comments.destroy' , $item->id) }}"
                                                  id="delete_form_{{ $loop->index }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <a title="مشاهده" role="button" href="#show-comment-modal"
                                                   ng-click="ShowComment({{ $item }})"
                                                   type="button" class="btn btn-info modal-trigger">
                                                    <i class="ti-new-window" aria-hidden="true"></i>
                                                </a>

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


        <div id="change-status-modal" class="modal">

            <div class="modal-content">
                <h5>تغییر وضعیت نظر</h5>

                <form>
                    <div class="modal-content">

                        <div class="row">
                            <div class="input-field col s12">
                                <select name="status" id="selected_status" ng-model="status">
                                    <option value="1">تایید کردن</option>
                                    <option value="0">رد کردن(در صف)</option>
                                </select>
                                <label for="name">وضعیت</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a id="modal_close" class="btn modal-action modal-close waves-effect waves-light red darken-4">لغو</a>
                        &nbsp;
                        <button type="button" ng-click="SubmitChangeStatus()"
                                class="btn modal-action waves-effect waves-light green">ثبت
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <div id="show-comment-modal" class="modal">

            <div class="modal-content">
                <h5>نمایش نظر</h5>

                <form>
                    <div class="modal-content">

                        <div class="row">
                            <div class="input-field col s12">
                                <h5>نام</h5>
                                <div class="row">
                                    <p>[[comment.name]]</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <h5>ایمیل</h5>
                                <div class="row">
                                    <p>[[comment.email]]</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <h5>متن نظر</h5>
                                <div class="row">
                                    <p>[[comment.text]]</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a id="modal_close" class="btn modal-action modal-close waves-effect waves-light red darken-4">بستن</a>
                        &nbsp;
                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection

@section('Scripts')
    @include('Admin.Section.components.sweet_alert')
    @include('Admin.Section.components.delete')
    @include('Admin.Section.components.search_box_js')

    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.status = null;
            $scope.id = null;
            $scope.comment = null;

            $scope.ShowComment = function (comment) {
                $scope.comment = comment;
            }

            $scope.ChangeStatus = function (status, id) {
                $scope.status = status;
                $scope.id = id;
                $("#selected_status").val($scope.status.toString());
                $('select').formSelect();
            }

            $scope.SubmitChangeStatus = function () {
                var data = {
                    'status': $scope.status,
                    'id': $scope.id,
                }

                $http.post(`{{ route('api.comment_change_status') }}`, data, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function () {
                    createSwal('success', "آیتم مورد نظر با موفقیت تغییر وضعیت یافت. در حال بارگذاری مجدد صفحه...", 'موفق', false, 'بستن').then(() => {
                        location.reload()
                    })
                }).catch(function (err) {
                    parseError(err);
                })
            }
        });
    </script>
@endsection
