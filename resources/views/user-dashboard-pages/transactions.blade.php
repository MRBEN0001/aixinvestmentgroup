@extends('layouts.user-dashboard')
@section('content')
 <main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
                    <div class="title-group mb-3">
                        {{-- <h1 class="h2 mb-0">Wallet</h1> --}}
                    </div>

                    <div class="row my-4">
                        <div class="col-lg-12 col-12">
                            <div class="custom-block bg-white">
                                <h5 class="mb-4">Account Activities</h5>

                                    
                         

                                <div class="bw_container mb-3 d-flex justify-content-end">
                        
                                    
                                    <form action="{{ route('transactions') }}" method="GET" class="d-flex align-items-center" style="font-size: 0.875rem;">
                                        <label for="type" class="me-2 text-muted" style="font-size: 0.875rem;">Filter by Type:</label>
                                        <select name="type" id="type" class="bw_custom_input me-2 rounded" onchange="this.form.submit()" style="background-color: #e0f0ff; font-size: 0.875rem;">
                                            <option value="">All</option>
                                            <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                                            <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Withdraw</option>
                                            <option value="transfer" {{ request('type') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="purchase" {{ request('type') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                        </select>
                                    </form>
                                    
                                </div>
                                
                                <div class="table-responsive">

                                    <table class="account-table table">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Date</th>

                                                <th scope="col">Time</th>

                                                <th scope="col">Description</th>

                                                <th scope="col">Transaction  Type</th>

                                                <th scope="col">Amount</th>


                                                <th scope="col">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td> <!-- S/N -->
                                                    <td>{{ $transaction->created_at->format('F j, Y') }}</td>
                                                    <td>{{ $transaction->created_at->format('g:i A') }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ $transaction->transaction_type }}</td>
                                                    <td class="{{ in_array($transaction->transaction_type, ['withdrawal','purchase', 'transfer']) ? 'text-danger' : 'text-success' }}">
                                                        <span class="me-1">{{ in_array($transaction->transaction_type, ['withdrawal','purchase', 'transfer']) ? '-' : '+' }}</span>
                                                        ${{ number_format($transaction->amount, 2) }}
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                        <span class="badge text-bg-{{ strtolower($transaction->status) === 'success' ? 'success' : (strtolower($transaction->status) === 'pending' ? 'danger' : 'dark') }}">
                                                            {{ ucfirst($transaction->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No transactions found.</td> <!-- Note: colspan increased by 1 -->
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        
                                    </table>
                                </div>
                             

                                @if ($transactions->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mb-0">
            {{-- Previous Page Link --}}
            <li class="page-item {{ $transactions->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $transactions->previousPageUrl() ?? '#' }}" aria-label="Previous">
                    <span aria-hidden="true">Prev</span>
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($transactions->links()->elements[0] as $page => $url)
                <li class="page-item {{ $transactions->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item {{ !$transactions->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $transactions->nextPageUrl() ?? '#' }}" aria-label="Next">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
    </nav>
@endif

                            </div>
                        </div>

                      
                    </div>

                    @include('user-dashboard-pages.footer-include')

                </main>
                @endsection