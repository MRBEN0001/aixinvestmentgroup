<div class="custom-block custom-block-balance">
    <small>Your Balance</small>

    <h2 style="font-size: 1.2rem" class="mt-2 mb-3">${{number_format(me()->account->balance,2)}}</h2>

    {{-- <div class="custom-block-numbers d-flex align-items-center">
        <span>****</span>
        <span>****</span>
        <span>****</span>
        <p>2560</p>
    </div> --}}
    <div class="custom-block-numbers  align-items-center">
        {{-- <span>Routing No:</span> --}}
        <small>Routine Number</small>
        <p>{{me()->account->routine ?? ''}}</p>
    </div>

    <div class="d-flex">
        <div>
            {{-- <small>Created Date</small> --}}
            <small>Account Number</small>
            <p>{{me()->account->account_number ?? ''}}</p>
        </div> 

        <div class="ms-auto">
            <small>Account Holder</small>
            <p>{{me()->name ?? ''}}</p>
        </div>
    </div>
</div>