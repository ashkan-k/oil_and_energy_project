@extends('layouts.admin-master')

@section('title'){{ $category->name }}@endsection

@section('content')
    <div class="row" ng-init="InitData()">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="waves-effect waves-light btn btn-info">{{ $category->name }}</h4>
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">
                        <form id="filter_box" style="margin-bottom: 4% !important;">
                            <div class="input-field col s3 text-center" style="float: right !important;">
                                <select name="status" class="browser-default" ng-options="item as item for item in filter_columns" ng-model="selected_category">
                                    <option value="">همه</option>
                                </select>
                            </div>

                            <div class="input-field col s3 text-center" style="float: left !important;">
                                <select ng-change="InitData()" class="browser-default" ng-model="limit" name="limit" ng-options="item as item for item in limit_options">
                                </select>
                            </div>
                        </form>

                        <table id="demo-foo-addrow" ng-if="data['data'] && data['data'].length > 0"
                               class="table m-t-10 highlight contact-list footable-loaded footable" data-page-size="10">
                            <thead>
                            <tr>
                                <th class="footable-sortable">#</th>

                                <th ng-repeat="item in display_columns" class="footable-sortable">[[item.title]]</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(key, item) in data['data']" style="" class="footable-even">
                                <td><span class="footable-toggle"></span>[[ key+1 ]]</td>
                                <td ng-repeat="(j,c) in columns">
                                        <span ng-if="ShowClass(j)" class="label label-[[ ShowClass(j) ]]">[[ item[c] ||
                                            item[c] === 0 ? item[c] : '---' ]]</span>

                                    <span ng-hide="ShowClass(j)">[[ item[c] || item[c] === 0 ? item[c] : '---' ]]</span>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="text-right">
                                        {{--                                        <ul id="pagination" class="pagination d-flex justify-content-center"></ul>--}}
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        <h4 ng-if="!data['data'] && !is_loading" style="text-align: center; padding: 60px;color: red">
                            اطلاعاتی در دسترسی نیست</h4>
                        <h4 id="loading" ng-if="!data['data'] || data['data'].length == 0 && is_loading"
                            style="text-align: center; padding: 60px;color: red">[[ loading_text ]]</h4>

                        <div id="pagination_div" class="text-right row d-none">
                            <ul id="pagination" class="pagination d-flex justify-content-center"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.all_data = [];
            $scope.data = [];
            $scope.window = window;
            $scope.is_loading = true;
            $scope.filter_columns = [];
            $scope.columns = [];
            $scope.display_columns = [];
            $scope.selected_category = null;
            $scope.page = 1;
            $scope.limit = 30;
            $scope.limit_options = [5, 10, 15, 20, 25, 30, 35, 40, 60]
            $scope.loading_text = "درحال دریافت اطلاعات. لطفا منتظر بمانید";

            $scope.InitData = function () {
                $scope.data = [];
                $scope.is_loading = true;
                $scope.ShowLoading();
                $scope.GetData();
            }

            $scope.$watch('selected_category', function(newValue, oldValue) {
                if ($scope.all_data){
                    $scope.data['data'] = $scope.all_data;
                    if ($scope.selected_category)
                    {
                        $scope.data['data'] = $scope.data['data'].filter(item => item['cat_title'] == $scope.selected_category);
                    }
                }
            });

            $scope.ShowLoading = function () {
                $scope.intervalId = $scope.window.setInterval(() => {
                    if ($scope.loading_text.includes('....')) {
                        $scope.loading_text = "درحال دریافت اطلاعات. لطفا منتظر بمانید";
                    }

                    $scope.loading_text += '.';

                    $scope.$apply(function () {
                        $scope.intervalId = $scope.intervalId;
                    });
                    if ($scope.data && $scope.data['data']) {
                        $scope.is_loading = false;
                        clearInterval($scope.intervalId);
                    }

                }, 1000);
            }

            $scope.GetData = function () {
                $http.get(`{{ route('api.free.tables.index', $category->slug) }}?page=${$scope.page}&limit=${$scope.limit}`).then(res => {
                    $scope.data = res.data['tables'];
                    $scope.all_data = res.data['tables']['data'];
                    $scope.display_columns = res.data['columns'];

                    if ($scope.data) {
                        $scope.columns = Object.keys($scope.data['data']['0']);
                        $scope.columns = $scope.columns.filter(function (item) {
                            return item != 'id' && item != 'updated_at' && item != 'category_id' && item != 'specifications' && item != 'image' && item != 'gallery'
                        })
                    }
                    if ($scope.data['data']['0']['cat_title']) {
                        for (const item in $scope.data['data']) {
                            if (!$scope.filter_columns.includes($scope.data['data'][item]['cat_title'])) {
                                $scope.filter_columns.push($scope.data['data'][item]['cat_title']);
                            }
                        }
                    }

                    $scope.Paginate();

                }).catch(err => {
                    $scope.loading_text = "خطا در دریافت اطلاعات!";
                    $scope.is_loading = false;
                }).then(() => {
                    setTimeout(() => {
                        $scope.InitData();
                    }, 20000);
                });
            }

            $scope.ShowClass = function (index) {
                if (typeof $scope.display_columns[index] === 'undefined') {
                    return "";
                }
                return $scope.display_columns[index]['class'];
            }

            $scope.Paginate = function () {

                $('#pagination_div').html('');
                $('#pagination_div').html('<ul id="pagination" class="pagination d-flex justify-content-center"></ul>');
                $('#pagination').twbsPagination({
                    startPage: $scope.page,
                    totalPages: $scope.data['last_page'],
                    visiblePages: 10,
                    paginationClass: 'pagination d-flex justify-content-center',
                    next: '»',
                    prev: '«',
                    first: '',
                    last: '',
                    onPageClick: function (event, page) {

                        if (page != $scope.page) {
                            $scope.page = page;
                            $scope.data = [];
                            $scope.is_loading = true;
                            $scope.ShowLoading();
                            $('#pagination_div').hide();
                            $scope.GetData();
                        }

                    }
                });

                $('#pagination_div').show();

            }
        });
    </script>
    @include('Admin.Section.components.sweet_alert')
    @include('Admin.Section.components.delete')
@endsection
