<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'OnlyMLM | Enterprise-Grade MLM & Binary Platform')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --ink: #0b1220;
            --steel: #1d3347;
            --muted: #4c6073;
            --accent: #0ea5a4;
            --accent-dark: #0a7f7d;
            --paper: #f6f8fb;
            --panel: #0f172a;
            --line: #dbe4ee;
        }

        body {
            font-family: "Manrope", system-ui, -apple-system, sans-serif;
            color: var(--ink);
            background: var(--paper);
        }

        .title-font {
            font-family: "Space Grotesk", system-ui, -apple-system, sans-serif;
        }

        .grid-pattern {
            background-image:
                linear-gradient(90deg, rgba(29, 51, 71, 0.08) 1px, transparent 1px),
                linear-gradient(rgba(29, 51, 71, 0.08) 1px, transparent 1px);
            background-size: 36px 36px;
        }
    </style>
</head>