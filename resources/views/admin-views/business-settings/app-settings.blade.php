@extends('layouts.admin.app')

@section('title',translate('messages.app_settings'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/setting.png')}}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('messages.app_settings')}}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        @php($app_minimum_version_android=\App\Models\BusinessSetting::where(['key'=>'app_minimum_version_android'])->first())
        @php($app_minimum_version_android=$app_minimum_version_android?$app_minimum_version_android->value:null)

        @php($app_url_android=\App\Models\BusinessSetting::where(['key'=>'app_url_android'])->first())
        @php($app_url_android=$app_url_android?$app_url_android->value:null)

        @php($app_minimum_version_ios=\App\Models\BusinessSetting::where(['key'=>'app_minimum_version_ios'])->first())
        @php($app_minimum_version_ios=$app_minimum_version_ios?$app_minimum_version_ios->value:null)

        @php($app_url_ios=\App\Models\BusinessSetting::where(['key'=>'app_url_ios'])->first())
        @php($app_url_ios=$app_url_ios?$app_url_ios->value:null)

        @php($app_minimum_version_android_store=\App\Models\BusinessSetting::where(['key'=>'app_minimum_version_android_store'])->first())
        @php($app_minimum_version_android_store=$app_minimum_version_android_store?$app_minimum_version_android_store->value:null)
        @php($app_url_android_store=\App\Models\BusinessSetting::where(['key'=>'app_url_android_store'])->first())
        @php($app_url_android_store=$app_url_android_store?$app_url_android_store->value:null)

        @php($app_minimum_version_ios_store=\App\Models\BusinessSetting::where(['key'=>'app_minimum_version_ios_store'])->first())
        @php($app_minimum_version_ios_store=$app_minimum_version_ios_store?$app_minimum_version_ios_store->value:null)
        @php($app_url_ios_store=\App\Models\BusinessSetting::where(['key'=>'app_url_ios_store'])->first())
        @php($app_url_ios_store=$app_url_ios_store?$app_url_ios_store->value:null)

        @php($app_minimum_version_android_deliveryman=\App\Models\BusinessSetting::where(['key'=>'app_minimum_version_android_deliveryman'])->first())
        @php($app_minimum_version_android_deliveryman=$app_minimum_version_android_deliveryman?$app_minimum_version_android_deliveryman->value:null)
        @php($app_url_android_deliveryman=\App\Models\BusinessSetting::where(['key'=>'app_url_android_deliveryman'])->first())
        @php($app_url_android_deliveryman=$app_url_android_deliveryman?$app_url_android_deliveryman->value:null)

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.business-settings.app-settings')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label">{{translate('messages.app_minimum_version')}} ({{translate('messages.android')}})</label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control" step="0.001" name="app_minimum_version_android"
                                    value="{{env('APP_MODE')!='demo'?$app_minimum_version_android??'':''}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{translate('messages.app_url')}} ({{translate('messages.android')}})</label>
                                <input type="text" placeholder="{{translate('messages.app_url')}}" class="form-control" name="app_url_android"
                                    value="{{env('APP_MODE')!='demo'?$app_url_android??'':''}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label">{{translate('messages.app_minimum_version')}} ({{translate('messages.ios')}})</label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control" step="0.001" name="app_minimum_version_ios"
                                    value="{{env('APP_MODE')!='demo'?$app_minimum_version_ios??'':''}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{translate('messages.app_url')}} ({{translate('messages.ios')}})</label>
                                <input type="text" placeholder="{{translate('messages.app_url')}}" class="form-control" name="app_url_ios"
                                    value="{{env('APP_MODE')!='demo'?$app_url_ios??'':''}}">
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-2"> {{ translate('store_app_section') }}</h3>

                    <div class="row g-3 mb-4 mt-2">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label text-capitalize">{{translate('messages.app_minimum_version')}} {{translate('messages.for_store')}} ({{translate('messages.android')}})
                                    <span class="input-label-secondary text--title" data-toggle="tooltip"
                                    data-placement="right"
                                    data-original-title="{{ translate('messages.app_min_version_hint') }}">
                                    <i class="tio-info-outined"></i>
                                </span>
                                </label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control h--45px" name="app_minimum_version_android_store"
                                    step="0.001"   min="0" value="{{env('APP_MODE')!='demo'?$app_minimum_version_android_store??'':''}}">
                            </div>
                            <div class="form-group m-0">
                                <label class="form-label text-capitalize">{{translate('messages.Download_Url')}} {{translate('messages.for_store')}} ({{translate('messages.android')}})</label>
                                <input type="text" placeholder="{{translate('messages.Download_Url')}}" class="form-control h--45px" name="app_url_android_store"
                                    value="{{env('APP_MODE')!='demo'?$app_url_android_store??'':''}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label text-capitalize">{{translate('messages.app_minimum_version')}} {{translate('messages.for_store')}} ({{translate('messages.ios')}})
                                    <span class="input-label-secondary text--title" data-toggle="tooltip"
                                    data-placement="right"
                                    data-original-title="{{ translate('messages.app_min_version_hint') }}">
                                    <i class="tio-info-outined"></i>
                                </span>
                                </label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control h--45px" name="app_minimum_version_ios_store"
                                step="0.001"  min="0" value="{{env('APP_MODE')!='demo'?$app_minimum_version_ios_store??'':''}}">
                            </div>
                            <div class="form-group m-0">
                                <label class="form-label text-capitalize">{{translate('messages.Download_Url')}} {{translate('messages.for_store')}} ({{translate('messages.ios')}})</label>
                                <input type="text" placeholder="{{translate('messages.Download_Url')}}" class="form-control h--45px" name="app_url_ios_store"
                                value="{{env('APP_MODE')!='demo'?$app_url_ios_store??'':''}}">
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-2"> {{ translate('deliveryman_app_section') }}</h3>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label text-capitalize">{{translate('messages.app_minimum_version')}} {{translate('messages.for_deliveryman')}} ({{translate('messages.android')}})
                                    <span class="input-label-secondary text--title" data-toggle="tooltip"
                                    data-placement="right"
                                    data-original-title="{{ translate('messages.app_min_version_hint') }}">
                                    <i class="tio-info-outined"></i>
                                </span>
                                </label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control h--45px" name="app_minimum_version_android_deliveryman"
                                    step="0.001"   min="0" value="{{env('APP_MODE')!='demo'?$app_minimum_version_android_deliveryman??'':''}}">
                            </div>
                            <div class="form-group m-0">
                                <label class="form-label text-capitalize">{{translate('messages.Download_Url')}} {{translate('messages.for_deliveryman')}} ({{translate('messages.android')}})</label>
                                <input type="text" placeholder="{{translate('messages.Download_Url')}}" class="form-control h--45px" name="app_url_android_deliveryman"
                                value="{{env('APP_MODE')!='demo'?$app_url_android_deliveryman??'':''}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label  class="form-label text-capitalize">{{translate('messages.app_minimum_version')}} {{translate('messages.for_deliveryman')}} ({{translate('messages.ios')}})
                                    <span class="input-label-secondary text--title" data-toggle="tooltip"
                                    data-placement="right"
                                    data-original-title="{{ translate('messages.app_min_version_hint') }}">
                                    <i class="tio-info-outined"></i>
                                </span>
                                </label>
                                <input type="number" placeholder="{{translate('messages.app_minimum_version')}}" class="form-control h--45px" name="app_minimum_version_ios_deliveryman"
                                step="0.001"  min="0" value="{{env('APP_MODE')!='demo'?$app_minimum_version_ios_deliveryman??'':''}}">
                            </div>
                            <div class="form-group m-0">
                                <label class="form-label text-capitalize">{{translate('messages.Download_Url')}} {{translate('messages.for_deliveryman')}} ({{translate('messages.ios')}})</label>
                                <input type="text" placeholder="{{translate('messages.Download_Url')}}" class="form-control h--45px" name="app_url_ios_deliveryman"
                                value="{{env('APP_MODE')!='demo'?$app_url_ios_deliveryman??'':''}}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}" class="btn btn--primary mb-2">{{translate('messages.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('script_2')

@endpush
