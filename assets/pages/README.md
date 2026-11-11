# assets/pages/ — Per-page CSS & JS

**Rule:** Har page ki apni CSS aur JS apne alag folder mein jayegi.

```
assets/pages/
├── home/
│   ├── css/home.css
│   └── js/home.js
├── about/
│   ├── css/about.css
│   └── js/about.js
└── contact/
    ├── css/contact.css
    └── js/contact.js
```

## HTML mein load order

```html
<!-- 1) Bootstrap (sirf grid/layout) -->
<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">

<!-- 2) Main style (variables + fonts + icons + utility + base) -->
<link rel="stylesheet" href="assets/css/style.css">

<!-- 3) Us page ki CSS (LAST mein — takke override ho sake) -->
<link rel="stylesheet" href="assets/pages/home/css/home.css">
...
<script src="assets/gsap/dist/gsap.min.js"></script>
<script src="assets/gsap/dist/ScrollTrigger.min.js"></script>
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/pages/home/js/home.js"></script>
```

## Notes

- Global cheezein (variables, utilities, fonts, icons) `assets/css/` mein — page folders mein NAHI.
- Page CSS mein sirf us page ke sections/components ki styling.
- Page JS IIFE mein rakhein; `data-page="home"` attribute `<body>` par dein.
