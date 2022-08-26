@extends('layouts.admin-master')

@section('title')افزودن آیتم جدول اشتراکی@endsection

@section('content')
    <div class="row" ng-init="Init()">
        <div class="col-12 s12 l6">
            <div class="card" style="overflow: visible;">
                <div class="card-content">
                    <h5 class="card-title activator">افزودن آیتم جدید به {{ $category->name }}</h5>
                    @include('Admin.Section.components.form_errors')

                    <div class="row" style="margin-top: 6% !important;">
                        <div class="input-field col s6">
                            <input id="name" name="name" type="text" ng-model="item_name">
                            <label for="name" class="">آیتم جدید</label>
                        </div>

                        <div class="input-field col s6">
                            <a ng-click="AddNewItem()" type="button" class="waves-effect waves-light btn btn-info">
                                افزودن <i class="material-icons right">add</i>
                            </a>
                        </div>
                    </div>

                    <table style="margin-top: 6% !important;" id="demo-foo-addrow"
                           class="table m-t-10 highlight contact-list footable-loaded footable"
                           data-page-size="10">
                        <thead>
                        <tr>
                            <th class="footable-sortable" ng-repeat="(key,item) in data.items" id="sortable">
                                [[item['name']
                                ? ShowItem(item['name']) : ShowItem(item)]]
                                <a ng-click="RemoveItem(item['name'] ? item['name'] : item,key)" type="button">
                                    <i style="color: red" class="fa fa-trash"> </i>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td ng-repeat="(key,item) in data.items">
                                ---
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row" style="margin-top: 10% !important;">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="button"
                                    ng-click="Submit()" ng-disabled="is_submited">
                                ذخیره
                            </button>
                            <a href="{{ route('categories.index') }}"
                               class="btn red waves-effect waves-light right m-l-10" type="button">
                                بازگشت
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        $("#sortable").sortable({
            start: function (event, ui) {
                ui.item.startPos = ui.item.index();
            },
            stop: function (event, ui) {
                angular.element(this).scope().Move(ui.item.startPos, ui.item.index());
            }
        });
    </script>

    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.item_name = null;
            $scope.is_submited = false;
            $scope.data = {
                category_id: null,
                items: [],
                deleted_items: [],
            }

            $scope.Init = function () {
                $scope.GetItems();
            }

            $scope.ShowItem = function (item) {
                item = item.replaceAll('_', ' ');
                return item.toUpperCase();
            }

            $scope.AddNewItem = function () {
                $scope.item_name = $scope.item_name.replaceAll(' ', '_').toLowerCase();

                if (!$scope.item_name) {
                    createToast("error", "عنوان آیتم نمی تواند خالی باشد!");
                    return;
                }
                if ($scope.data.items.includes($scope.item_name)) {
                    createToast("error", "عنوان آیتم تکراری است!");
                    return;
                }

                $scope.data.items.push($scope.item_name);
                $scope.item_name = "";
                $('#name').focus();
            }

            $scope.RemoveItem = function (item, key) {
                $scope.data.deleted_items.push(item.replaceAll(' ', '_').toLowerCase());
                $scope.data.items.splice(key, 1)
            }

            $scope.GetItems = function () {
                $http.get('{{ route('api.tables.items.index' , $category->slug) }}').then(r => {
                    $scope.data['items'] = Object.values(r['data']);
                }).catch(e => {
                    console.log(e)
                    parseError(e);
                })
            }

            $scope.Create = function (data) {
                $scope.is_submited = true;
                $http.post('{{ route('api.tables.items.create',$category->slug) }}', data, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(r => {
                    if (r.status == 201) {
                        createToast('success', 'اطلاعات بروزرسانی شد.')
                        setTimeout(() => {
                            window.location.href = "{{ route('categories.index') }}"
                        }, 1000);
                    }
                }).catch(e => {
                    parseError(e);
                })
                .finally(function () {
                    $scope.is_submited = false;
                })
            }

            $scope.Submit = function () {
                @if(isset($table))
                $scope.Update($scope.data);
                @else
                $scope.Create($scope.data);
                @endif
            }
        });
    </script>
@endsection
