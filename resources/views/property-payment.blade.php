<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Payment | AIX Investment Group</title>
    <style>
        :root {
            --aix-black: #070707;
            --aix-dark: #141414;
            --aix-gold: #b08361;
            --aix-light-gold: #c9aa79;
            --aix-text: #f5f1eb;
            --aix-muted: #bdb7ae;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--aix-black);
            color: var(--aix-text);
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .payment-header {
            align-items: center;
            background: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 6%;
        }

        .payment-header img {
            max-width: 145px;
        }

        .payment-header nav {
            display: flex;
            gap: 14px;
        }

        .payment-header nav a {
            border: 1px solid var(--aix-gold);
            color: var(--aix-gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 18px;
            text-transform: uppercase;
        }

        .payment-section {
            background:
                linear-gradient(120deg, rgba(0, 0, 0, 0.92), rgba(0, 0, 0, 0.7)),
                radial-gradient(circle at top right, rgba(176, 131, 97, 0.28), transparent 35%),
                var(--aix-dark);
            min-height: calc(100vh - 85px);
            padding: 90px 6%;
        }

        .payment-wrap {
            margin: 0 auto;
            max-width: 1120px;
        }

        .eyebrow {
            color: var(--aix-light-gold);
            display: block;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 18px;
            text-transform: uppercase;
        }

        h1 {
            font-size: clamp(38px, 6vw, 70px);
            line-height: 1;
            margin: 0 0 20px;
            max-width: 850px;
            text-transform: uppercase;
        }

        .lead {
            color: var(--aix-muted);
            font-size: 18px;
            line-height: 1.8;
            margin: 0 0 36px;
            max-width: 780px;
        }

        .property-summary {
            align-items: stretch;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(176, 131, 97, 0.38);
            display: grid;
            gap: 24px;
            grid-template-columns: 280px 1fr;
            margin-bottom: 34px;
            padding: 22px;
        }

        .property-summary img,
        .property-image-placeholder {
            display: block;
            height: 210px;
            object-fit: cover;
            width: 100%;
        }

        .property-image-placeholder {
            background: linear-gradient(135deg, rgba(176, 131, 97, 0.32), rgba(255, 255, 255, 0.06));
        }

        .property-summary h2 {
            color: #fff;
            font-size: 28px;
            margin: 0 0 14px;
            text-transform: uppercase;
        }

        .property-summary p {
            color: var(--aix-muted);
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 18px;
        }

        .property-amount {
            color: var(--aix-light-gold);
            display: block;
            font-size: 26px;
            font-weight: 700;
        }

        .coin-grid {
            display: grid;
            gap: 22px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .coin-card {
            background: linear-gradient(180deg, #1d1d1d 0%, #0c0c0c 100%);
            border: 1px solid rgba(176, 131, 97, 0.38);
            padding: 28px 22px;
        }

        .coin-card h2 {
            color: #fff;
            font-size: 24px;
            margin: 0 0 18px;
            text-transform: uppercase;
        }

        .coin-card span {
            color: var(--aix-muted);
            display: block;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .wallet-address {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--aix-light-gold);
            font-family: "Courier New", monospace;
            font-size: 14px;
            line-height: 1.6;
            overflow-wrap: anywhere;
            padding: 14px;
        }

        .copy-wallet {
            background: var(--aix-gold);
            border: 0;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 16px;
            padding: 11px 16px;
            text-transform: uppercase;
            transition: background 0.2s ease;
        }

        .copy-wallet:hover,
        .copy-wallet:focus {
            background: var(--aix-light-gold);
        }

        .support-note {
            border-left: 3px solid var(--aix-gold);
            color: var(--aix-muted);
            font-size: 16px;
            line-height: 1.8;
            margin-top: 38px;
            padding-left: 18px;
        }

        .support-note strong {
            color: #fff;
        }

        @media (max-width: 1100px) {
            .coin-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .property-summary,
            .coin-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .payment-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
                padding: 16px 5%;
            }

            .payment-header img {
                max-width: 110px;
            }

            .payment-section {
                padding: 70px 5%;
            }
        }
    </style>
</head>
<body>
    <header class="payment-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('asset/wp-content/themes/twentytwenty-child/assets/images/logo.png') }}" alt="AIX Investment Group Logo">
        </a>
        <nav>
            <a href="{{ route('properties') }}">Properties</a>
            <a href="{{ url('/') }}">Home</a>
        </nav>
    </header>

    <main class="payment-section">
        <div class="payment-wrap">
            <span class="eyebrow">Property Payment</span>
            <h1>Complete Your Property Investment</h1>
            <p class="lead">Pay the exact property amount shown below to one of the wallet addresses. After payment, chat support with your payment screenshot so they can proceed with your investment.</p>

            <section class="property-summary">
                @if ($property->image_url)
                    <img src="{{ $property->image_url }}" alt="{{ $property->title }}">
                @else
                    <div class="property-image-placeholder" aria-hidden="true"></div>
                @endif

                <div>
                    <h2>{{ $property->title }}</h2>
                    <p>{{ $property->description }}</p>
                    <span class="property-amount">${{ number_format($property->price, 2) }}</span>
                </div>
            </section>

            <div class="coin-grid">
                <article class="coin-card">
                    <h2>Bitcoin</h2>
                    <span>Wallet Address</span>
                    <div class="wallet-address">bc1qljw4nhyw7qtf8hyh8wjul8m0fafqqm6g9nwef2</div>
                    <button class="copy-wallet" type="button" data-wallet-address="bc1qljw4nhyw7qtf8hyh8wjul8m0fafqqm6g9nwef2">Copy Address</button>
                </article>

                <article class="coin-card">
                    <h2>ETH</h2>
                    <span>Wallet Address</span>
                    <div class="wallet-address">0xb6fa7cd22ab0d6ba01cd2f6c56fe3ebe77b205f8</div>
                    <button class="copy-wallet" type="button" data-wallet-address="0xb6fa7cd22ab0d6ba01cd2f6c56fe3ebe77b205f8">Copy Address</button>
                </article>

                <article class="coin-card">
                    <h2>USDT TR20</h2>
                    <span>Wallet Address</span>
                    <div class="wallet-address">TUra5xqfwoPzKZCzZe7rhRgv4Fyp8VdQiP</div>
                    <button class="copy-wallet" type="button" data-wallet-address="TUra5xqfwoPzKZCzZe7rhRgv4Fyp8VdQiP">Copy Address</button>
                </article>

                <article class="coin-card">
                    <h2>USDT ETH</h2>
                    <span>Wallet Address</span>
                    <div class="wallet-address">0xb6fa7cd22ab0d6ba01cd2f6c56fe3ebe77b205f8</div>
                    <button class="copy-wallet" type="button" data-wallet-address="0xb6fa7cd22ab0d6ba01cd2f6c56fe3ebe77b205f8">Copy Address</button>
                </article>
            </div>

            <div class="support-note">
                <strong>Important:</strong> Pay the exact amount of ${{ number_format($property->price, 2) }}, then open live chat support and send your screenshot so the support team can verify the payment and proceed with your investment.
            </div>
        </div>
    </main>

    @include('partials.jivo-chat')
    @include('partials.schedule-meeting-modal')
    <script>
        document.querySelectorAll('.copy-wallet').forEach(function (button) {
            button.addEventListener('click', function () {
                var address = button.getAttribute('data-wallet-address');
                navigator.clipboard.writeText(address).then(function () {
                    var originalText = button.textContent;
                    button.textContent = 'Copied';

                    setTimeout(function () {
                        button.textContent = originalText;
                    }, 1800);
                });
            });
        });
    </script>
</body>
</html>
