@extends('admin.layouts.master')
@section('title','Dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{trans('messages.events')}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{trans('messages.add_event')}}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="0" name="edit_value">

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="name" class="form-label">{{trans('messages.name')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('messages.name')}}">
                            </div>
                        </div>
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-lg-3">--}}
{{--                                <label for="currency" class="form-label">{{trans('messages.currency')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <input type="text" class="form-control" id="currency" name="currency"--}}
{{--                                       placeholder="{{trans('messages.currency')}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-lg-3">--}}
{{--                                <label for="currency" class="form-label">uploadExcleHere</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <input type="file" class="form-control" id="excle" name="excle"--}}
{{--                                       placeholder="uploadExcleHere">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">{{trans('messages.save')}}</button>
                            <a href="{{ route('admin.event.index') }}" class="btn btn-danger btn-sm">{{trans('messages.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-script')
    <script>
        let form_url = '/event'
        let redirect_url = '/event'
    </script>
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
@endsection
