<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Payment | AIX Investment Group</title>
    <link rel="stylesheet" href="{{ asset('asset/vendor/google-fonts/fonts.css') }}">
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
            max-width: 1080px;
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
            max-width: 760px;
        }

        .selected-plan {
            background: rgba(176, 131, 97, 0.13);
            border: 1px solid rgba(176, 131, 97, 0.42);
            color: #fff;
            display: inline-block;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 34px;
            padding: 14px 18px;
            text-transform: uppercase;
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

        @media (max-width: 700px) {
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
            <a href="{{ route('cryptocurrencies') }}">Plans</a>
            <a href="{{ url('/') }}">Home</a>
        </nav>
    </header>

    <main class="payment-section">
        <div class="payment-wrap">
            <span class="eyebrow">Crypto Payment</span>
            <h1>Complete Your Investment Payment</h1>
            <p class="lead">Send your selected investment amount to one of the payment wallet addresses below. After payment, contact support through the live chat and send a screenshot of your payment for confirmation.</p>

            @if (request('plan'))
                <div class="selected-plan">Selected plan: {{ request('plan') }}</div>
            @endif

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
                <strong>Important:</strong> After making payment, open the live chat support and send your payment screenshot so the support team can verify and activate your investment.
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
