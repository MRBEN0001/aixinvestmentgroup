<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} | AIX Investment Group</title>
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

        .property-header {
            align-items: center;
            background: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 6%;
        }

        .property-header img {
            max-width: 145px;
        }

        .property-header nav {
            display: flex;
            gap: 14px;
        }

        .property-header nav a {
            border: 1px solid var(--aix-gold);
            color: var(--aix-gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 18px;
            text-transform: uppercase;
        }

        .property-details {
            background:
                linear-gradient(120deg, rgba(0, 0, 0, 0.93), rgba(0, 0, 0, 0.76)),
                radial-gradient(circle at top right, rgba(176, 131, 97, 0.28), transparent 36%),
                var(--aix-dark);
            min-height: calc(100vh - 85px);
            padding: 86px 6%;
        }

        .property-wrap {
            display: grid;
            gap: 42px;
            grid-template-columns: 1.08fr 0.92fr;
            margin: 0 auto;
            max-width: 1180px;
        }

        .property-gallery {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(176, 131, 97, 0.38);
            padding: 16px;
        }

        .property-main-image {
            display: block;
            height: 560px;
            object-fit: cover;
            width: 100%;
        }

        .property-gallery-placeholder {
            display: block;
            height: 560px;
            width: 100%;
        }

        .property-gallery-placeholder {
            background: linear-gradient(135deg, rgba(176, 131, 97, 0.32), rgba(255, 255, 255, 0.06));
        }

        .property-thumbnail-grid {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-top: 14px;
        }

        .property-thumbnail {
            background: none;
            border: 2px solid transparent;
            cursor: pointer;
            padding: 0;
        }

        .property-thumbnail.is-active {
            border-color: var(--aix-gold);
        }

        .property-thumbnail img {
            display: block;
            height: 92px;
            object-fit: cover;
            width: 100%;
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
            font-size: clamp(38px, 5vw, 68px);
            line-height: 1;
            margin: 0 0 22px;
            text-transform: uppercase;
        }

        .property-description {
            color: var(--aix-muted);
            font-size: 17px;
            line-height: 1.85;
            margin: 0 0 26px;
        }

        .property-price {
            color: var(--aix-light-gold);
            display: block;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 28px;
        }

        .property-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 34px;
        }

        .property-action {
            background: var(--aix-gold);
            color: #fff;
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 13px 20px;
            text-transform: uppercase;
        }

        .property-action.secondary {
            background: transparent;
            border: 1px solid var(--aix-gold);
            color: var(--aix-light-gold);
        }

        .features {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 28px;
        }

        .features h2 {
            color: #fff;
            font-size: 22px;
            margin: 0 0 18px;
            text-transform: uppercase;
        }

        .features ul {
            display: grid;
            gap: 12px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .features li {
            background: rgba(255, 255, 255, 0.06);
            border-left: 3px solid var(--aix-gold);
            color: var(--aix-muted);
            line-height: 1.6;
            padding: 12px 14px;
        }

        @media (max-width: 900px) {
            .property-wrap {
                grid-template-columns: 1fr;
            }

            .property-main-image,
            .property-gallery-placeholder {
                height: 420px;
            }
        }

        @media (max-width: 640px) {
            .property-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
                padding: 16px 5%;
            }

            .property-header img {
                max-width: 110px;
            }

            .property-details {
                padding: 64px 5%;
            }

            .property-main-image,
            .property-gallery-placeholder {
                height: 280px;
            }

            .property-thumbnail-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .property-thumbnail img {
                height: 76px;
            }

            .property-action {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="property-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('asset/wp-content/themes/twentytwenty-child/assets/images/logo.png') }}" alt="AIX Investment Group Logo">
        </a>
        <nav>
            <a href="{{ route('properties') }}">Properties</a>
            <a href="{{ route('aix-property-secure') }}">AIX Property Secure</a>
        </nav>
    </header>

    <main class="property-details">
        <div class="property-wrap">
            <section class="property-gallery" data-property-gallery>
                @if (! empty($property->property_images))
                    <img class="property-main-image" src="{{ $property->property_images[0] }}" alt="{{ $property->title }}" data-property-main-image>

                    <div class="property-thumbnail-grid">
                        @foreach ($property->property_images as $image)
                            <button class="property-thumbnail {{ $loop->first ? 'is-active' : '' }}" type="button" data-property-thumbnail="{{ $image }}" aria-label="View property image {{ $loop->iteration }}">
                                <img src="{{ $image }}" alt="{{ $property->title }}">
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="property-gallery-placeholder" aria-hidden="true"></div>
                @endif
            </section>

            <section>
                <span class="eyebrow">Property Details</span>
                <h1>{{ $property->title }}</h1>
                <p class="property-description">{{ $property->description }}</p>
                <span class="property-price">${{ number_format($property->price, 2) }}</span>

                <div class="property-actions">
                    <a class="property-action" href="{{ route('properties.payment', $property) }}">Invest</a>
                    <a class="property-action secondary" href="{{ route('properties') }}">View More Properties</a>
                </div>

                @if (! empty($property->feature_list))
                    <div class="features">
                        <h2>Property Features</h2>
                        <ul>
                            @foreach ($property->feature_list as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>
        </div>
    </main>

    @include('partials.jivo-chat')
    @include('partials.schedule-meeting-modal')
    <script>
        document.querySelectorAll('[data-property-gallery]').forEach(function (gallery) {
            var mainImage = gallery.querySelector('[data-property-main-image]');
            var thumbnails = gallery.querySelectorAll('[data-property-thumbnail]');

            if (! mainImage || thumbnails.length === 0) {
                return;
            }

            thumbnails.forEach(function (thumbnail) {
                thumbnail.addEventListener('click', function () {
                    thumbnails.forEach(function (item) {
                        item.classList.remove('is-active');
                    });

                    thumbnail.classList.add('is-active');
                    mainImage.setAttribute('src', thumbnail.getAttribute('data-property-thumbnail'));
                });
            });
        });
    </script>
</body>
</html>
