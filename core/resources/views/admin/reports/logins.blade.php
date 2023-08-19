@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Login at')</th>
                                <th>@lang('IP')</th>
                                <th>@lang('Location')</th>
                                <th>@lang('Browser | OS')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($loginLogs as $log)
                                <tr>

                                <td>
                                    <span class="fw-bold">{{ @$log->user->fullname }}</span>
                                    <br>
                                    <span class="small"> 
                                        <a href="{{ permit('admin.users.detail') ? route('admin.users.detail', $log->user_id) : 'javascript:void(0)' }}">
                                            <span>@</span>{{ @$log->user->username }}
                                        </a>
                                    </span>
                                </td>


                                    <td>
                                        {{showDateTime($log->created_at) }} <br> {{diffForHumans($log->created_at) }}
                                    </td>



                                    <td>
                                        <span class="fw-bold">
                                            @permit('admin.report.login.ipHistory')
                                                <a href="{{route('admin.report.login.ipHistory',[$log->user_ip])}}">{{ $log->user_ip }}</a>
                                            @else 
                                                <a href="javascript:void(0)">{{ $log->user_ip }}</a>
                                            @endpermit
                                        </span>
                                    </td>

                                    <td>{{ __($log->city) }} <br> {{ __($log->country) }}</td>
                                    <td>
                                        {{ __($log->browser) }} <br> {{ __($log->os) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($loginLogs->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($loginLogs) }}
                </div>
                @endif
            </div><!-- card end -->
        </div>


    </div>
@endsection



@push('breadcrumb-plugins')
    @if(request()->routeIs('admin.report.login.history'))
        @permit('admin.report.login.history')
            <x-search-form placeholder="Enter Username" />
        @endpermit
    @endif
@endpush
@if(request()->routeIs('admin.report.login.ipHistory'))
    @permit('admin.report.login.ipHistory')
        @push('breadcrumb-plugins')
            <a href="https://www.ip2location.com/{{ $ip }}" target="_blank" class="btn btn--primary">@lang('Lookup IP') {{ $ip }}</a>
        @endpush
    @endpermit
@endif
