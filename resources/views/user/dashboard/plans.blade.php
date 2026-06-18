@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')

<style>
    .plans-caption {
        background: linear-gradient(135deg, #b01763 0%, #8b1249 100%);
        color: #fff;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.02em;
    }

    .plan-card {
        height: 100%;
        border: 1px solid rgba(176, 23, 99, 0.15);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(176, 23, 99, 0.12);
    }

    .plan-card .card-title {
        color: #b01763;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .plan-detail {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.55rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        font-size: 0.95rem;
    }

    .plan-detail:last-of-type {
        border-bottom: none;
        margin-bottom: 1rem;
    }

    .plan-detail span:first-child {
        color: #6c757d;
    }

    .plan-detail span:last-child {
        font-weight: 600;
        text-align: right;
    }
</style>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Investment Plans</h4>
                <p class="plans-caption mb-4">All plans are 6 days</p>

                @if ($plans->isEmpty())
                    <p class="text-muted mb-0">No plans are available right now. Please contact support.</p>
                @else
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                                <div class="card plan-card">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $plan->name }}</h5>

                                        <div class="plan-detail">
                                            <span>Minimum investment</span>
                                            <span>{{ config('app.currency') }}{{ number_format($plan->min) }}</span>
                                        </div>
                                        <div class="plan-detail">
                                            <span>Maximum investment</span>
                                            <span>{{ config('app.currency') }}{{ number_format($plan->max) }}</span>
                                        </div>
                                        <div class="plan-detail">
                                            <span>Daily return</span>
                                            <span>{{ $plan->percentage_return }}%</span>
                                        </div>
                                        <div class="plan-detail">
                                            <span>Referral bonus</span>
                                            <span>{{ $plan->referral_bonus ?? 0 }}%</span>
                                        </div>

                                        <a href="/invest" class="btn btn-primary mt-auto">Invest Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
