<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrencies Investment | AIX Investment Group</title>
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

        .crypto-header {
            align-items: center;
            background: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 6%;
        }

        .crypto-header img {
            max-width: 145px;
        }

        .crypto-header a:last-child {
            border: 1px solid var(--aix-gold);
            color: var(--aix-gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 18px;
            text-transform: uppercase;
        }

        .crypto-hero {
            background:
                linear-gradient(120deg, rgba(0, 0, 0, 0.92), rgba(0, 0, 0, 0.62)),
                radial-gradient(circle at top right, rgba(176, 131, 97, 0.34), transparent 35%),
                var(--aix-dark);
            padding: 110px 6% 90px;
        }

        .crypto-wrap {
            margin: 0 auto;
            max-width: 1180px;
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
            font-size: clamp(42px, 7vw, 82px);
            line-height: 0.98;
            margin: 0 0 26px;
            max-width: 850px;
            text-transform: uppercase;
        }

        .hero-text {
            color: var(--aix-muted);
            font-size: 18px;
            line-height: 1.8;
            max-width: 760px;
        }

        .crypto-intro,
        .crypto-plans {
            padding: 80px 6%;
        }

        .crypto-intro {
            background: #fff;
            color: #191919;
        }

        .intro-grid {
            display: grid;
            gap: 42px;
            grid-template-columns: 0.9fr 1.1fr;
        }

        h2 {
            font-size: clamp(32px, 5vw, 56px);
            line-height: 1.05;
            margin: 0;
            text-transform: uppercase;
        }

        .intro-copy {
            color: #4a4a4a;
            font-size: 17px;
            line-height: 1.9;
        }

        .intro-copy p {
            margin: 0 0 22px;
        }

        .crypto-plans {
            background: var(--aix-black);
        }

        .plans-heading {
            margin-bottom: 42px;
            max-width: 780px;
        }

        .plans-heading p {
            color: var(--aix-muted);
            font-size: 17px;
            line-height: 1.7;
        }

        .return-notice {
            background: rgba(176, 131, 97, 0.13);
            border: 1px solid rgba(176, 131, 97, 0.42);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
            line-height: 1.6;
            margin-top: 24px;
            padding: 18px 22px;
            text-transform: uppercase;
        }

        .plans-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        .plan-card {
            background: linear-gradient(180deg, #1d1d1d 0%, #0c0c0c 100%);
            border: 1px solid rgba(176, 131, 97, 0.38);
            min-height: 310px;
            padding: 28px 22px;
            position: relative;
        }

        .plan-card::before {
            background: var(--aix-gold);
            content: "";
            height: 3px;
            left: 22px;
            position: absolute;
            right: 22px;
            top: 0;
        }

        .plan-card h3 {
            color: #fff;
            font-size: 22px;
            line-height: 1.2;
            margin: 20px 0 24px;
            text-transform: uppercase;
        }

        .plan-meta {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 18px;
        }

        .plan-meta span {
            color: var(--aix-muted);
            display: block;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .plan-meta strong {
            color: var(--aix-light-gold);
            display: block;
            font-size: 20px;
            margin-bottom: 18px;
        }

        .plan-card p {
            color: var(--aix-muted);
            font-size: 14px;
            line-height: 1.65;
            margin: 0;
        }

        .plan-action {
            background: var(--aix-gold);
            color: #fff;
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 24px;
            padding: 12px 18px;
            text-transform: uppercase;
            transition: background 0.2s ease;
        }

        .plan-action:hover,
        .plan-action:focus {
            background: var(--aix-light-gold);
        }

        .risk-note {
            border-left: 3px solid var(--aix-gold);
            color: var(--aix-muted);
            font-size: 14px;
            line-height: 1.7;
            margin-top: 34px;
            padding-left: 18px;
        }

        @media (max-width: 1100px) {
            .plans-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .crypto-header {
                gap: 16px;
                padding: 16px 5%;
            }

            .crypto-header img {
                max-width: 110px;
            }

            .crypto-hero,
            .crypto-intro,
            .crypto-plans {
                padding-left: 5%;
                padding-right: 5%;
            }

            .intro-grid,
            .plans-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="crypto-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('asset/wp-content/themes/twentytwenty-child/assets/images/logo.png') }}" alt="AIX Investment Group Logo">
        </a>
        <a href="{{ url('/') }}">Home</a>
    </header>

    <section class="crypto-hero">
        <div class="crypto-wrap">
            <span class="eyebrow">Investment Solutions</span>
            <h1>Cryptocurrencies Investment</h1>
            <p class="hero-text">A structured digital asset investment opportunity designed for clients who want exposure to the growing cryptocurrency market through a guided, company-backed investment approach.</p>
        </div>
    </section>

    <section class="crypto-intro">
        <div class="crypto-wrap intro-grid">
            <h2>Invest in Digital Assets With Confidence</h2>
            <div class="intro-copy">
                <p>AIX Investment Group provides cryptocurrency investment solutions for clients seeking access to digital assets while maintaining a disciplined approach to capital allocation, risk review, and portfolio planning.</p>
                <p>Our cryptocurrency investment offering focuses on major digital assets, market opportunities, and structured participation for different investment sizes. Each plan is designed to help clients choose an entry level that matches their goals, capital range, and long-term outlook.</p>
                <p>Cryptocurrency markets can be volatile, so investors should carefully consider their financial objectives and risk tolerance before participating.</p>
            </div>
        </div>
    </section>

    <section class="crypto-plans">
        <div class="crypto-wrap">
            <div class="plans-heading">
                <span class="eyebrow">Plans</span>
                <h2>Cryptocurrency Investment Plans</h2>
                <p>Select from five structured plans with clear minimum and maximum investment ranges.</p>
                <div class="return-notice">All cryptocurrency investment plans give 100% return in 30 days.</div>
            </div>

            <div class="plans-grid">
                <article class="plan-card">
                    <h3>Starter Crypto Plan</h3>
                    <div class="plan-meta">
                        <span>Minimum Investment</span>
                        <strong>$500</strong>
                        <span>Maximum Investment</span>
                        <strong>$4,999</strong>
                    </div>
                    <p>Built for new investors who want a simple entry into cryptocurrency investment.</p>
                    <a class="plan-action" href="{{ route('cryptocurrencies.payment', ['plan' => 'Starter Crypto Plan']) }}">Invest Now</a>
                </article>

                <article class="plan-card">
                    <h3>Growth Crypto Plan</h3>
                    <div class="plan-meta">
                        <span>Minimum Investment</span>
                        <strong>$5,000</strong>
                        <span>Maximum Investment</span>
                        <strong>$24,999</strong>
                    </div>
                    <p>Designed for clients ready to build broader digital asset exposure.</p>
                    <a class="plan-action" href="{{ route('cryptocurrencies.payment', ['plan' => 'Growth Crypto Plan']) }}">Invest Now</a>
                </article>

                <article class="plan-card">
                    <h3>Premium Crypto Plan</h3>
                    <div class="plan-meta">
                        <span>Minimum Investment</span>
                        <strong>$25,000</strong>
                        <span>Maximum Investment</span>
                        <strong>$99,999</strong>
                    </div>
                    <p>A balanced plan for investors seeking a stronger position in the crypto market.</p>
                    <a class="plan-action" href="{{ route('cryptocurrencies.payment', ['plan' => 'Premium Crypto Plan']) }}">Invest Now</a>
                </article>

                <article class="plan-card">
                    <h3>Executive Crypto Plan</h3>
                    <div class="plan-meta">
                        <span>Minimum Investment</span>
                        <strong>$100,000</strong>
                        <span>Maximum Investment</span>
                        <strong>$249,999</strong>
                    </div>
                    <p>Created for high-value investors who want a larger structured allocation.</p>
                    <a class="plan-action" href="{{ route('cryptocurrencies.payment', ['plan' => 'Executive Crypto Plan']) }}">Invest Now</a>
                </article>

                <article class="plan-card">
                    <h3>Institutional Crypto Plan</h3>
                    <div class="plan-meta">
                        <span>Minimum Investment</span>
                        <strong>$250,000</strong>
                        <span>Maximum Investment</span>
                        <strong>$1,000,000+</strong>
                    </div>
                    <p>Suitable for advanced investors and institutions seeking significant exposure.</p>
                    <a class="plan-action" href="{{ route('cryptocurrencies.payment', ['plan' => 'Institutional Crypto Plan']) }}">Invest Now</a>
                </article>
            </div>

        </div>
    </section>
    @include('partials.jivo-chat')
    @include('partials.schedule-meeting-modal')
</body>
</html>
