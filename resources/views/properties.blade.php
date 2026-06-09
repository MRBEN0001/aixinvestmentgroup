<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties | AIX Investment Group</title>
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

        .properties-header {
            align-items: center;
            background: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 6%;
        }

        .properties-header img {
            max-width: 145px;
        }

        .properties-header a:last-child {
            border: 1px solid var(--aix-gold);
            color: var(--aix-gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 18px;
            text-transform: uppercase;
        }

        .properties-hero,
        .properties-main {
            padding: 80px 6%;
        }

        .properties-hero {
            background:
                linear-gradient(120deg, rgba(0, 0, 0, 0.92), rgba(0, 0, 0, 0.66)),
                radial-gradient(circle at top right, rgba(176, 131, 97, 0.34), transparent 35%),
                var(--aix-dark);
        }

        .properties-wrap {
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
            font-size: clamp(42px, 7vw, 74px);
            line-height: 1;
            margin: 0 0 22px;
            text-transform: uppercase;
        }

        .hero-text {
            color: var(--aix-muted);
            font-size: 18px;
            line-height: 1.8;
            max-width: 760px;
        }

        .properties-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .property-card {
            background: linear-gradient(180deg, #1d1d1d 0%, #0c0c0c 100%);
            border: 1px solid rgba(176, 131, 97, 0.38);
            overflow: hidden;
        }

        .property-card img,
        .property-image-placeholder {
            display: block;
            height: 235px;
            object-fit: cover;
            width: 100%;
        }

        .property-image-trigger {
            background: none;
            border: 0;
            cursor: zoom-in;
            display: block;
            padding: 0;
            width: 100%;
        }

        .property-image-placeholder {
            background: linear-gradient(135deg, rgba(176, 131, 97, 0.32), rgba(255, 255, 255, 0.06));
        }

        .property-card-content {
            padding: 24px;
        }

        .property-card h2 {
            color: #fff;
            font-size: 23px;
            margin: 0 0 14px;
            text-transform: uppercase;
        }

        .property-card p {
            color: var(--aix-muted);
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 18px;
        }

        .property-price {
            color: var(--aix-light-gold);
            display: block;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .property-action,
        .empty-action {
            background: var(--aix-gold);
            color: #fff;
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 12px 18px;
            text-transform: uppercase;
        }

        .empty-state {
            border: 1px solid rgba(176, 131, 97, 0.38);
            color: var(--aix-muted);
            font-size: 17px;
            line-height: 1.8;
            padding: 34px;
        }

        .property-image-modal {
            align-items: center;
            background: rgba(0, 0, 0, 0.88);
            display: none;
            inset: 0;
            justify-content: center;
            padding: 28px;
            position: fixed;
            z-index: 99999;
        }

        .property-image-modal.is-open {
            display: flex;
        }

        .property-image-modal img {
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
            max-height: 90vh;
            max-width: 95vw;
            object-fit: contain;
        }

        .property-modal-close {
            background: var(--aix-gold);
            border: 0;
            color: #fff;
            cursor: pointer;
            font-size: 30px;
            height: 48px;
            line-height: 1;
            position: absolute;
            right: 24px;
            top: 24px;
            width: 48px;
        }

        @media (max-width: 980px) {
            .properties-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .properties-header {
                gap: 16px;
                padding: 16px 5%;
            }

            .properties-header img {
                max-width: 110px;
            }

            .properties-hero,
            .properties-main {
                padding-left: 5%;
                padding-right: 5%;
            }

            .properties-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="properties-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('asset/wp-content/themes/twentytwenty-child/assets/images/logo.png') }}" alt="AIX Investment Group Logo">
        </a>
        <a href="{{ route('aix-property-secure') }}">AIX Property Secure</a>
    </header>

    <section class="properties-hero">
        <div class="properties-wrap">
            <span class="eyebrow">AIX Property Secure</span>
            <h1>Properties</h1>
            <p class="hero-text">Browse available property-backed investment opportunities.</p>
        </div>
    </section>

    <main class="properties-main">
        <div class="properties-wrap">
            @forelse ($properties as $property)
                @if ($loop->first)
                    <div class="properties-grid">
                @endif

                <article class="property-card">
                    @if ($property->image_url)
                        <button class="property-image-trigger" type="button" data-property-image="{{ $property->image_url }}" data-property-title="{{ $property->title }}">
                            <img src="{{ $property->image_url }}" alt="{{ $property->title }}">
                        </button>
                    @else
                        <div class="property-image-placeholder" aria-hidden="true"></div>
                    @endif
                    <div class="property-card-content">
                        <h2>{{ $property->title }}</h2>
                        <p>{{ $property->description }}</p>
                        <span class="property-price">${{ number_format($property->price, 2) }}</span>
                        <a class="property-action" href="{{ route('properties.payment', $property) }}">Invest</a>
                    </div>
                </article>

                @if ($loop->last)
                    </div>
                @endif
            @empty
                <div class="empty-state">
                    No properties are available yet. Add active properties from the admin panel to display them here.
                </div>
            @endforelse
        </div>
    </main>

    <div class="property-image-modal" id="propertyImageModal" aria-hidden="true">
        <button class="property-modal-close" type="button" aria-label="Close property image">&times;</button>
        <img src="" alt="">
    </div>

    @include('partials.jivo-chat')
    @include('partials.schedule-meeting-modal')
    <script>
        (function () {
            var modal = document.getElementById('propertyImageModal');
            var modalImage = modal.querySelector('img');
            var closeButton = modal.querySelector('.property-modal-close');

            function closeModal() {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                modalImage.setAttribute('src', '');
                modalImage.setAttribute('alt', '');
            }

            document.querySelectorAll('.property-image-trigger').forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    modalImage.setAttribute('src', trigger.getAttribute('data-property-image'));
                    modalImage.setAttribute('alt', trigger.getAttribute('data-property-title') || 'Property image');
                    modal.classList.add('is-open');
                    modal.setAttribute('aria-hidden', 'false');
                });
            });

            closeButton.addEventListener('click', closeModal);

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                    closeModal();
                }
            });
        })();
    </script>
</body>
</html>
