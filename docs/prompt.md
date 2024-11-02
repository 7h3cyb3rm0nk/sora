Project Path: /home/ramees/progs/php/sora

Source Tree:

```
sora
├── tailwind.config.js
├── public
│   ├── images
│   │   ├── sora-login.jpg
│   │   ├── sora-bg1.jpg
│   │   ├── icons
│   │   │   └── user-avatar.png
│   │   ├── pfps
│   │   │   ├── profile_8_1729844133.png
│   │   │   ├── profile_8_1729842219.png
│   │   │   ├── profile_8_1729843607.png
│   │   │   ├── arch.png
│   │   │   ├── profile_8_1729846445.png
│   │   │   ├── profile_8_1729846587.png
│   │   │   ├── profile_8.png
│   │   │   ├── profile_8_1729845933.png
│   │   │   ├── profile_8_1729842162.png
│   │   │   ├── profile_8_1729845713.png
│   │   │   ├── profile_8_1729844742.png
│   │   │   ├── profile_8_1729846207.png
│   │   │   ├── profile_8_1729847225.png
│   │   │   ├── profile_8_1729846223.png
│   │   │   ├── profile_8_1729842549.png
│   │   │   ├── profile_8_1729842280.png
│   │   │   ├── profile_8_1729846182.png
│   │   │   └── profile_6.png
│   │   ├── user-edit.png
│   │   └── sora-bg.png
│   ├── css
│   │   ├── imports.css
│   │   └── styles.css
│   └── index.php
├── vendor
├── tests
│   └── sample.php
├── docs
├── src
│   ├── Helpers
│   │   └── Helper.php
│   ├── Config
│   │   ├── Database.php
│   │   ├── sample.php
│   │   ├── sora.sql
│   │   └── init.php
│   ├── Core
│   │   ├── Router.php
│   │   └── Application.php
│   ├── Controllers
│   │   ├── HomeController.php
│   │   ├── PostController.php
│   │   └── UserController.php
│   ├── Models
│   │   ├── UserModel.php
│   │   └── PostModel.php
│   └── Views
│       ├── navbar.html
│       ├── login.html
│       ├── profile.html
│       ├── signup.html
│       ├── home.html
│       ├── html_head.html
│       └── user_profile.html
├── composer.json
└── README.md

```

`/home/ramees/progs/php/sora/tailwind.config.js`:

```````js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{html,php,js}',
    './**/*.{html,php,js}'],
  theme: {
    extend: {
      colors: {
          'sora-primary': '#4F46E5',
          'sora-secondary': '#818CF8',
          'sora-bg': '#F3F4F6',
          'sora-text': '#1F2937',
      }
  },
  },
  plugins: [],
}


```````

`/home/ramees/progs/php/sora/public/css/imports.css`:

```````css
@tailwind base;
@tailwind components;
@tailwind utilities;

*{
    margin: 0;
    padding:0;
    box-sizing: border-box;
}
```````

`/home/ramees/progs/php/sora/public/css/styles.css`:

```````css
*, ::before, ::after {
  --tw-border-spacing-x: 0;
  --tw-border-spacing-y: 0;
  --tw-translate-x: 0;
  --tw-translate-y: 0;
  --tw-rotate: 0;
  --tw-skew-x: 0;
  --tw-skew-y: 0;
  --tw-scale-x: 1;
  --tw-scale-y: 1;
  --tw-pan-x:  ;
  --tw-pan-y:  ;
  --tw-pinch-zoom:  ;
  --tw-scroll-snap-strictness: proximity;
  --tw-gradient-from-position:  ;
  --tw-gradient-via-position:  ;
  --tw-gradient-to-position:  ;
  --tw-ordinal:  ;
  --tw-slashed-zero:  ;
  --tw-numeric-figure:  ;
  --tw-numeric-spacing:  ;
  --tw-numeric-fraction:  ;
  --tw-ring-inset:  ;
  --tw-ring-offset-width: 0px;
  --tw-ring-offset-color: #fff;
  --tw-ring-color: rgb(59 130 246 / 0.5);
  --tw-ring-offset-shadow: 0 0 #0000;
  --tw-ring-shadow: 0 0 #0000;
  --tw-shadow: 0 0 #0000;
  --tw-shadow-colored: 0 0 #0000;
  --tw-blur:  ;
  --tw-brightness:  ;
  --tw-contrast:  ;
  --tw-grayscale:  ;
  --tw-hue-rotate:  ;
  --tw-invert:  ;
  --tw-saturate:  ;
  --tw-sepia:  ;
  --tw-drop-shadow:  ;
  --tw-backdrop-blur:  ;
  --tw-backdrop-brightness:  ;
  --tw-backdrop-contrast:  ;
  --tw-backdrop-grayscale:  ;
  --tw-backdrop-hue-rotate:  ;
  --tw-backdrop-invert:  ;
  --tw-backdrop-opacity:  ;
  --tw-backdrop-saturate:  ;
  --tw-backdrop-sepia:  ;
  --tw-contain-size:  ;
  --tw-contain-layout:  ;
  --tw-contain-paint:  ;
  --tw-contain-style:  ;
}

::backdrop {
  --tw-border-spacing-x: 0;
  --tw-border-spacing-y: 0;
  --tw-translate-x: 0;
  --tw-translate-y: 0;
  --tw-rotate: 0;
  --tw-skew-x: 0;
  --tw-skew-y: 0;
  --tw-scale-x: 1;
  --tw-scale-y: 1;
  --tw-pan-x:  ;
  --tw-pan-y:  ;
  --tw-pinch-zoom:  ;
  --tw-scroll-snap-strictness: proximity;
  --tw-gradient-from-position:  ;
  --tw-gradient-via-position:  ;
  --tw-gradient-to-position:  ;
  --tw-ordinal:  ;
  --tw-slashed-zero:  ;
  --tw-numeric-figure:  ;
  --tw-numeric-spacing:  ;
  --tw-numeric-fraction:  ;
  --tw-ring-inset:  ;
  --tw-ring-offset-width: 0px;
  --tw-ring-offset-color: #fff;
  --tw-ring-color: rgb(59 130 246 / 0.5);
  --tw-ring-offset-shadow: 0 0 #0000;
  --tw-ring-shadow: 0 0 #0000;
  --tw-shadow: 0 0 #0000;
  --tw-shadow-colored: 0 0 #0000;
  --tw-blur:  ;
  --tw-brightness:  ;
  --tw-contrast:  ;
  --tw-grayscale:  ;
  --tw-hue-rotate:  ;
  --tw-invert:  ;
  --tw-saturate:  ;
  --tw-sepia:  ;
  --tw-drop-shadow:  ;
  --tw-backdrop-blur:  ;
  --tw-backdrop-brightness:  ;
  --tw-backdrop-contrast:  ;
  --tw-backdrop-grayscale:  ;
  --tw-backdrop-hue-rotate:  ;
  --tw-backdrop-invert:  ;
  --tw-backdrop-opacity:  ;
  --tw-backdrop-saturate:  ;
  --tw-backdrop-sepia:  ;
  --tw-contain-size:  ;
  --tw-contain-layout:  ;
  --tw-contain-paint:  ;
  --tw-contain-style:  ;
}

/*
! tailwindcss v3.4.14 | MIT License | https://tailwindcss.com
*/

/*
1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
*/

*,
::before,
::after {
  box-sizing: border-box;
  /* 1 */
  border-width: 0;
  /* 2 */
  border-style: solid;
  /* 2 */
  border-color: #e5e7eb;
  /* 2 */
}

::before,
::after {
  --tw-content: '';
}

/*
1. Use a consistent sensible line-height in all browsers.
2. Prevent adjustments of font size after orientation changes in iOS.
3. Use a more readable tab size.
4. Use the user's configured `sans` font-family by default.
5. Use the user's configured `sans` font-feature-settings by default.
6. Use the user's configured `sans` font-variation-settings by default.
7. Disable tap highlights on iOS
*/

html,
:host {
  line-height: 1.5;
  /* 1 */
  -webkit-text-size-adjust: 100%;
  /* 2 */
  -moz-tab-size: 4;
  /* 3 */
  -o-tab-size: 4;
     tab-size: 4;
  /* 3 */
  font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  /* 4 */
  font-feature-settings: normal;
  /* 5 */
  font-variation-settings: normal;
  /* 6 */
  -webkit-tap-highlight-color: transparent;
  /* 7 */
}

/*
1. Remove the margin in all browsers.
2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
*/

body {
  margin: 0;
  /* 1 */
  line-height: inherit;
  /* 2 */
}

/*
1. Add the correct height in Firefox.
2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
3. Ensure horizontal rules are visible by default.
*/

hr {
  height: 0;
  /* 1 */
  color: inherit;
  /* 2 */
  border-top-width: 1px;
  /* 3 */
}

/*
Add the correct text decoration in Chrome, Edge, and Safari.
*/

abbr:where([title]) {
  -webkit-text-decoration: underline dotted;
          text-decoration: underline dotted;
}

/*
Remove the default font size and weight for headings.
*/

h1,
h2,
h3,
h4,
h5,
h6 {
  font-size: inherit;
  font-weight: inherit;
}

/*
Reset links to optimize for opt-in styling instead of opt-out.
*/

a {
  color: inherit;
  text-decoration: inherit;
}

/*
Add the correct font weight in Edge and Safari.
*/

b,
strong {
  font-weight: bolder;
}

/*
1. Use the user's configured `mono` font-family by default.
2. Use the user's configured `mono` font-feature-settings by default.
3. Use the user's configured `mono` font-variation-settings by default.
4. Correct the odd `em` font sizing in all browsers.
*/

code,
kbd,
samp,
pre {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  /* 1 */
  font-feature-settings: normal;
  /* 2 */
  font-variation-settings: normal;
  /* 3 */
  font-size: 1em;
  /* 4 */
}

/*
Add the correct font size in all browsers.
*/

small {
  font-size: 80%;
}

/*
Prevent `sub` and `sup` elements from affecting the line height in all browsers.
*/

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

/*
1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
3. Remove gaps between table borders by default.
*/

table {
  text-indent: 0;
  /* 1 */
  border-color: inherit;
  /* 2 */
  border-collapse: collapse;
  /* 3 */
}

/*
1. Change the font styles in all browsers.
2. Remove the margin in Firefox and Safari.
3. Remove default padding in all browsers.
*/

button,
input,
optgroup,
select,
textarea {
  font-family: inherit;
  /* 1 */
  font-feature-settings: inherit;
  /* 1 */
  font-variation-settings: inherit;
  /* 1 */
  font-size: 100%;
  /* 1 */
  font-weight: inherit;
  /* 1 */
  line-height: inherit;
  /* 1 */
  letter-spacing: inherit;
  /* 1 */
  color: inherit;
  /* 1 */
  margin: 0;
  /* 2 */
  padding: 0;
  /* 3 */
}

/*
Remove the inheritance of text transform in Edge and Firefox.
*/

button,
select {
  text-transform: none;
}

/*
1. Correct the inability to style clickable types in iOS and Safari.
2. Remove default button styles.
*/

button,
input:where([type='button']),
input:where([type='reset']),
input:where([type='submit']) {
  -webkit-appearance: button;
  /* 1 */
  background-color: transparent;
  /* 2 */
  background-image: none;
  /* 2 */
}

/*
Use the modern Firefox focus style for all focusable elements.
*/

:-moz-focusring {
  outline: auto;
}

/*
Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
*/

:-moz-ui-invalid {
  box-shadow: none;
}

/*
Add the correct vertical alignment in Chrome and Firefox.
*/

progress {
  vertical-align: baseline;
}

/*
Correct the cursor style of increment and decrement buttons in Safari.
*/

::-webkit-inner-spin-button,
::-webkit-outer-spin-button {
  height: auto;
}

/*
1. Correct the odd appearance in Chrome and Safari.
2. Correct the outline style in Safari.
*/

[type='search'] {
  -webkit-appearance: textfield;
  /* 1 */
  outline-offset: -2px;
  /* 2 */
}

/*
Remove the inner padding in Chrome and Safari on macOS.
*/

::-webkit-search-decoration {
  -webkit-appearance: none;
}

/*
1. Correct the inability to style clickable types in iOS and Safari.
2. Change font properties to `inherit` in Safari.
*/

::-webkit-file-upload-button {
  -webkit-appearance: button;
  /* 1 */
  font: inherit;
  /* 2 */
}

/*
Add the correct display in Chrome and Safari.
*/

summary {
  display: list-item;
}

/*
Removes the default spacing and border for appropriate elements.
*/

blockquote,
dl,
dd,
h1,
h2,
h3,
h4,
h5,
h6,
hr,
figure,
p,
pre {
  margin: 0;
}

fieldset {
  margin: 0;
  padding: 0;
}

legend {
  padding: 0;
}

ol,
ul,
menu {
  list-style: none;
  margin: 0;
  padding: 0;
}

/*
Reset default styling for dialogs.
*/

dialog {
  padding: 0;
}

/*
Prevent resizing textareas horizontally by default.
*/

textarea {
  resize: vertical;
}

/*
1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
2. Set the default placeholder color to the user's configured gray 400 color.
*/

input::-moz-placeholder, textarea::-moz-placeholder {
  opacity: 1;
  /* 1 */
  color: #9ca3af;
  /* 2 */
}

input::placeholder,
textarea::placeholder {
  opacity: 1;
  /* 1 */
  color: #9ca3af;
  /* 2 */
}

/*
Set the default cursor for buttons.
*/

button,
[role="button"] {
  cursor: pointer;
}

/*
Make sure disabled buttons don't get the pointer cursor.
*/

:disabled {
  cursor: default;
}

/*
1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
   This can trigger a poorly considered lint error in some tools but is included by design.
*/

img,
svg,
video,
canvas,
audio,
iframe,
embed,
object {
  display: block;
  /* 1 */
  vertical-align: middle;
  /* 2 */
}

/*
Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
*/

img,
video {
  max-width: 100%;
  height: auto;
}

/* Make elements with the HTML hidden attribute stay hidden by default */

[hidden]:where(:not([hidden="until-found"])) {
  display: none;
}

.container {
  width: 100%;
}

@media (min-width: 640px) {
  .container {
    max-width: 640px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 768px;
  }
}

@media (min-width: 1024px) {
  .container {
    max-width: 1024px;
  }
}

@media (min-width: 1280px) {
  .container {
    max-width: 1280px;
  }
}

@media (min-width: 1536px) {
  .container {
    max-width: 1536px;
  }
}

.visible {
  visibility: visible;
}

.collapse {
  visibility: collapse;
}

.static {
  position: static;
}

.fixed {
  position: fixed;
}

.absolute {
  position: absolute;
}

.relative {
  position: relative;
}

.sticky {
  position: sticky;
}

.-right-2 {
  right: -0.5rem;
}

.-top-2 {
  top: -0.5rem;
}

.-top-2\.5 {
  top: -0.625rem;
}

.bottom-0 {
  bottom: 0px;
}

.bottom-3 {
  bottom: 0.75rem;
}

.left-2 {
  left: 0.5rem;
}

.right-0 {
  right: 0px;
}

.right-3 {
  right: 0.75rem;
}

.top-10 {
  top: 2.5rem;
}

.m-2 {
  margin: 0.5rem;
}

.mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.-mb-px {
  margin-bottom: -1px;
}

.mb-2 {
  margin-bottom: 0.5rem;
}

.mb-3 {
  margin-bottom: 0.75rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

.mb-6 {
  margin-bottom: 1.5rem;
}

.mb-8 {
  margin-bottom: 2rem;
}

.mr-1 {
  margin-right: 0.25rem;
}

.mr-2 {
  margin-right: 0.5rem;
}

.mr-3 {
  margin-right: 0.75rem;
}

.mt-1 {
  margin-top: 0.25rem;
}

.mt-2 {
  margin-top: 0.5rem;
}

.mt-3 {
  margin-top: 0.75rem;
}

.mt-4 {
  margin-top: 1rem;
}

.block {
  display: block;
}

.inline-block {
  display: inline-block;
}

.inline {
  display: inline;
}

.flex {
  display: flex;
}

.inline-flex {
  display: inline-flex;
}

.table {
  display: table;
}

.grid {
  display: grid;
}

.contents {
  display: contents;
}

.hidden {
  display: none;
}

.h-10 {
  height: 2.5rem;
}

.h-12 {
  height: 3rem;
}

.h-24 {
  height: 6rem;
}

.h-4 {
  height: 1rem;
}

.h-full {
  height: 100%;
}

.min-h-\[calc\(100vh-4rem\)\] {
  min-height: calc(100vh - 4rem);
}

.min-h-screen {
  min-height: 100vh;
}

.w-10 {
  width: 2.5rem;
}

.w-24 {
  width: 6rem;
}

.w-4 {
  width: 1rem;
}

.w-64 {
  width: 16rem;
}

.w-fit {
  width: -moz-fit-content;
  width: fit-content;
}

.w-full {
  width: 100%;
}

.max-w-3xl {
  max-width: 48rem;
}

.max-w-4xl {
  max-width: 56rem;
}

.max-w-md {
  max-width: 28rem;
}

.flex-1 {
  flex: 1 1 0%;
}

.flex-grow {
  flex-grow: 1;
}

.transform {
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.cursor-pointer {
  cursor: pointer;
}

.resize-none {
  resize: none;
}

.resize {
  resize: both;
}

.appearance-none {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
}

.grid-cols-1 {
  grid-template-columns: repeat(1, minmax(0, 1fr));
}

.flex-col {
  flex-direction: column;
}

.flex-col-reverse {
  flex-direction: column-reverse;
}

.items-start {
  align-items: flex-start;
}

.items-center {
  align-items: center;
}

.justify-center {
  justify-content: center;
}

.justify-between {
  justify-content: space-between;
}

.gap-3 {
  gap: 0.75rem;
}

.gap-4 {
  gap: 1rem;
}

.gap-6 {
  gap: 1.5rem;
}

.gap-7 {
  gap: 1.75rem;
}

.space-x-1 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.25rem * var(--tw-space-x-reverse));
  margin-left: calc(0.25rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-2 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.5rem * var(--tw-space-x-reverse));
  margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-3 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.75rem * var(--tw-space-x-reverse));
  margin-left: calc(0.75rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-4 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(1rem * var(--tw-space-x-reverse));
  margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-6 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(1.5rem * var(--tw-space-x-reverse));
  margin-left: calc(1.5rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-8 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(2rem * var(--tw-space-x-reverse));
  margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-y-2 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
}

.space-y-3 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(0.75rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(0.75rem * var(--tw-space-y-reverse));
}

.space-y-4 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(1rem * var(--tw-space-y-reverse));
}

.space-y-reverse > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 1;
}

.overflow-hidden {
  overflow: hidden;
}

.overflow-y-auto {
  overflow-y: auto;
}

.rounded {
  border-radius: 0.25rem;
}

.rounded-full {
  border-radius: 9999px;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.rounded-md {
  border-radius: 0.375rem;
}

.rounded-xl {
  border-radius: 0.75rem;
}

.rounded-l-md {
  border-top-left-radius: 0.375rem;
  border-bottom-left-radius: 0.375rem;
}

.rounded-r-md {
  border-top-right-radius: 0.375rem;
  border-bottom-right-radius: 0.375rem;
}

.border {
  border-width: 1px;
}

.border-b {
  border-bottom-width: 1px;
}

.border-b-2 {
  border-bottom-width: 2px;
}

.border-blue-500 {
  --tw-border-opacity: 1;
  border-color: rgb(59 130 246 / var(--tw-border-opacity));
}

.border-gray-200 {
  --tw-border-opacity: 1;
  border-color: rgb(229 231 235 / var(--tw-border-opacity));
}

.border-transparent {
  border-color: transparent;
}

.border-violet-600 {
  --tw-border-opacity: 1;
  border-color: rgb(124 58 237 / var(--tw-border-opacity));
}

.bg-black {
  --tw-bg-opacity: 1;
  background-color: rgb(0 0 0 / var(--tw-bg-opacity));
}

.bg-blue-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(59 130 246 / var(--tw-bg-opacity));
}

.bg-blue-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(37 99 235 / var(--tw-bg-opacity));
}

.bg-gray-100 {
  --tw-bg-opacity: 1;
  background-color: rgb(243 244 246 / var(--tw-bg-opacity));
}

.bg-gray-200 {
  --tw-bg-opacity: 1;
  background-color: rgb(229 231 235 / var(--tw-bg-opacity));
}

.bg-gray-300 {
  --tw-bg-opacity: 1;
  background-color: rgb(209 213 219 / var(--tw-bg-opacity));
}

.bg-indigo-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(79 70 229 / var(--tw-bg-opacity));
}

.bg-red-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(239 68 68 / var(--tw-bg-opacity));
}

.bg-sora-bg {
  --tw-bg-opacity: 1;
  background-color: rgb(243 244 246 / var(--tw-bg-opacity));
}

.bg-violet-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(124 58 237 / var(--tw-bg-opacity));
}

.bg-white {
  --tw-bg-opacity: 1;
  background-color: rgb(255 255 255 / var(--tw-bg-opacity));
}

.bg-opacity-90 {
  --tw-bg-opacity: 0.9;
}

.bg-gradient-to-r {
  background-image: linear-gradient(to right, var(--tw-gradient-stops));
}

.from-sora-primary {
  --tw-gradient-from: #4F46E5 var(--tw-gradient-from-position);
  --tw-gradient-to: rgb(79 70 229 / 0) var(--tw-gradient-to-position);
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-sora-secondary {
  --tw-gradient-to: #818CF8 var(--tw-gradient-to-position);
}

.bg-center {
  background-position: center;
}

.bg-no-repeat {
  background-repeat: no-repeat;
}

.object-cover {
  -o-object-fit: cover;
     object-fit: cover;
}

.p-1 {
  padding: 0.25rem;
}

.p-2 {
  padding: 0.5rem;
}

.p-3 {
  padding: 0.75rem;
}

.p-4 {
  padding: 1rem;
}

.p-6 {
  padding: 1.5rem;
}

.px-1 {
  padding-left: 0.25rem;
  padding-right: 0.25rem;
}

.px-2 {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
}

.px-3 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.px-6 {
  padding-left: 1.5rem;
  padding-right: 1.5rem;
}

.py-12 {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.py-3 {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
}

.py-4 {
  padding-top: 1rem;
  padding-bottom: 1rem;
}

.py-8 {
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.pb-4 {
  padding-bottom: 1rem;
}

.pr-12 {
  padding-right: 3rem;
}

.pt-3 {
  padding-top: 0.75rem;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-2xl {
  font-size: 1.5rem;
  line-height: 2rem;
}

.text-3xl {
  font-size: 1.875rem;
  line-height: 2.25rem;
}

.text-lg {
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.text-xl {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

.text-xs {
  font-size: 0.75rem;
  line-height: 1rem;
}

.font-bold {
  font-weight: 700;
}

.font-medium {
  font-weight: 500;
}

.font-semibold {
  font-weight: 600;
}

.uppercase {
  text-transform: uppercase;
}

.lowercase {
  text-transform: lowercase;
}

.ordinal {
  --tw-ordinal: ordinal;
  font-variant-numeric: var(--tw-ordinal) var(--tw-slashed-zero) var(--tw-numeric-figure) var(--tw-numeric-spacing) var(--tw-numeric-fraction);
}

.leading-tight {
  line-height: 1.25;
}

.text-blue-600 {
  --tw-text-opacity: 1;
  color: rgb(37 99 235 / var(--tw-text-opacity));
}

.text-gray-400 {
  --tw-text-opacity: 1;
  color: rgb(156 163 175 / var(--tw-text-opacity));
}

.text-gray-500 {
  --tw-text-opacity: 1;
  color: rgb(107 114 128 / var(--tw-text-opacity));
}

.text-gray-600 {
  --tw-text-opacity: 1;
  color: rgb(75 85 99 / var(--tw-text-opacity));
}

.text-gray-700 {
  --tw-text-opacity: 1;
  color: rgb(55 65 81 / var(--tw-text-opacity));
}

.text-gray-800 {
  --tw-text-opacity: 1;
  color: rgb(31 41 55 / var(--tw-text-opacity));
}

.text-gray-900 {
  --tw-text-opacity: 1;
  color: rgb(17 24 39 / var(--tw-text-opacity));
}

.text-red-600 {
  --tw-text-opacity: 1;
  color: rgb(220 38 38 / var(--tw-text-opacity));
}

.text-slate-900 {
  --tw-text-opacity: 1;
  color: rgb(15 23 42 / var(--tw-text-opacity));
}

.text-sora-primary {
  --tw-text-opacity: 1;
  color: rgb(79 70 229 / var(--tw-text-opacity));
}

.text-sora-secondary {
  --tw-text-opacity: 1;
  color: rgb(129 140 248 / var(--tw-text-opacity));
}

.text-sora-text {
  --tw-text-opacity: 1;
  color: rgb(31 41 55 / var(--tw-text-opacity));
}

.text-violet-600 {
  --tw-text-opacity: 1;
  color: rgb(124 58 237 / var(--tw-text-opacity));
}

.text-white {
  --tw-text-opacity: 1;
  color: rgb(255 255 255 / var(--tw-text-opacity));
}

.underline {
  text-decoration-line: underline;
}

.placeholder-gray-500::-moz-placeholder {
  --tw-placeholder-opacity: 1;
  color: rgb(107 114 128 / var(--tw-placeholder-opacity));
}

.placeholder-gray-500::placeholder {
  --tw-placeholder-opacity: 1;
  color: rgb(107 114 128 / var(--tw-placeholder-opacity));
}

.opacity-85 {
  opacity: 0.85;
}

.opacity-95 {
  opacity: 0.95;
}

.shadow {
  --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-lg {
  --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-md {
  --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-sm {
  --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.outline-none {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.outline {
  outline-style: solid;
}

.blur {
  --tw-blur: blur(8px);
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.invert {
  --tw-invert: invert(100%);
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.filter {
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.transition {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.transition-colors {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.duration-200 {
  transition-duration: 200ms;
}

.duration-300 {
  transition-duration: 300ms;
}

*{
  margin: 0;
  padding:0;
  box-sizing: border-box;
}

.hover\:scale-105:hover {
  --tw-scale-x: 1.05;
  --tw-scale-y: 1.05;
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.hover\:border-gray-300:hover {
  --tw-border-opacity: 1;
  border-color: rgb(209 213 219 / var(--tw-border-opacity));
}

.hover\:bg-blue-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(37 99 235 / var(--tw-bg-opacity));
}

.hover\:bg-blue-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(29 78 216 / var(--tw-bg-opacity));
}

.hover\:bg-indigo-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(67 56 202 / var(--tw-bg-opacity));
}

.hover\:bg-red-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(220 38 38 / var(--tw-bg-opacity));
}

.hover\:bg-violet-50:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(245 243 255 / var(--tw-bg-opacity));
}

.hover\:bg-violet-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(109 40 217 / var(--tw-bg-opacity));
}

.hover\:bg-white:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(255 255 255 / var(--tw-bg-opacity));
}

.hover\:text-blue-500:hover {
  --tw-text-opacity: 1;
  color: rgb(59 130 246 / var(--tw-text-opacity));
}

.hover\:text-gray-700:hover {
  --tw-text-opacity: 1;
  color: rgb(55 65 81 / var(--tw-text-opacity));
}

.hover\:text-green-500:hover {
  --tw-text-opacity: 1;
  color: rgb(34 197 94 / var(--tw-text-opacity));
}

.hover\:text-sora-bg:hover {
  --tw-text-opacity: 1;
  color: rgb(243 244 246 / var(--tw-text-opacity));
}

.hover\:text-sora-secondary:hover {
  --tw-text-opacity: 1;
  color: rgb(129 140 248 / var(--tw-text-opacity));
}

.hover\:shadow-md:hover {
  --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.focus\:border-transparent:focus {
  border-color: transparent;
}

.focus\:outline-none:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.focus\:ring-2:focus {
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}

.focus\:ring-blue-500:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity));
}

.focus\:ring-sora-bg:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(243 244 246 / var(--tw-ring-opacity));
}

.focus\:ring-violet-500:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(139 92 246 / var(--tw-ring-opacity));
}

.focus\:ring-offset-2:focus {
  --tw-ring-offset-width: 2px;
}

@media (min-width: 640px) {
  .sm\:flex {
    display: flex;
  }

  .sm\:w-\[90\%\] {
    width: 90%;
  }

  .sm\:w-auto {
    width: auto;
  }

  .sm\:grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .sm\:flex-row {
    flex-direction: row;
  }

  .sm\:items-end {
    align-items: flex-end;
  }

  .sm\:items-center {
    align-items: center;
  }

  .sm\:justify-end {
    justify-content: flex-end;
  }

  .sm\:space-x-4 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(1rem * var(--tw-space-x-reverse));
    margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .sm\:space-x-6 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(1.5rem * var(--tw-space-x-reverse));
    margin-left: calc(1.5rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .sm\:space-y-0 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-y-reverse: 0;
    margin-top: calc(0px * calc(1 - var(--tw-space-y-reverse)));
    margin-bottom: calc(0px * var(--tw-space-y-reverse));
  }

  .sm\:overflow-y-auto {
    overflow-y: auto;
  }

  .sm\:p-8 {
    padding: 2rem;
  }

  .sm\:px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
  }

  .sm\:text-3xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
  }

  .sm\:text-xl {
    font-size: 1.25rem;
    line-height: 1.75rem;
  }
}

@media (min-width: 768px) {
  .md\:mx-0 {
    margin-left: 0px;
    margin-right: 0px;
  }

  .md\:mr-12 {
    margin-right: 3rem;
  }

  .md\:block {
    display: block;
  }

  .md\:flex {
    display: flex;
  }

  .md\:hidden {
    display: none;
  }

  .md\:w-\[80\%\] {
    width: 80%;
  }

  .md\:gap-\[7em\] {
    gap: 7em;
  }

  .md\:space-x-8 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(2rem * var(--tw-space-x-reverse));
    margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .md\:overflow-auto {
    overflow: auto;
  }

  .md\:overflow-hidden {
    overflow: hidden;
  }

  .md\:overflow-y-auto {
    overflow-y: auto;
  }

  .md\:p-12 {
    padding: 3rem;
  }

  .md\:text-4xl {
    font-size: 2.25rem;
    line-height: 2.5rem;
  }
}

@media (min-width: 1024px) {
  .lg\:w-\[40\%\] {
    width: 40%;
  }

  .lg\:px-8 {
    padding-left: 2rem;
    padding-right: 2rem;
  }
}

@media (min-width: 1280px) {
  .xl\:w-\[30\%\] {
    width: 30%;
  }
}
```````

`/home/ramees/progs/php/sora/public/index.php`:

```````php
<?php 
require __DIR__."/../vendor/autoload.php";
ini_set('session.cookie_httponly', 1); 
ini_set('session.cookie_secure', 1); 
ini_set('session.use_strict_mode', 1); // Prevents session fixation in some cases
ini_set('session.gc_maxlifetime', 1800);



session_start();
use Sora\Core\Application;
use Sora\Core\Router;
use Sora\Controllers\UserController;
use Sora\Controllers\HomeController;
use Sora\Controllers\PostController;
use Sora\Helpers\Helper;
$router = new Router();
$app = new Application($router);

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/login', [HomeController::class, 'login']);
$app->router->post('/login', [UserController::class, 'login']);
$app->router->get('/register', [HomeController::class, 'register']);
$app->router->post('/register', [UserController::class, 'register']);
$app->router->get('/logout', [UserController::class, 'logout']);
$app->router->get('/profile', [UserController::class, 'profile']);
$app->router->get('/profile/:any', [UserController::class, 'profile']);

$app->router->post('/create', [PostController::class, 'create']);
$app->router->post('/edit_profile', [UserController::class, 'edit_user_details']);
$app->router->post('/add_likes', [PostController::class, 'add_likes']);
$app->router->post('/remove_likes', [PostController::class, 'remove_likes']);
$app->router->post('/add_comment', [PostController::class, 'add_comment']);
$app->router->get('/get_followed_users', [UserController::class, 'get_followed_users']);
$app->router->get('/search_users', [UserController::class, 'search_users']);
$app->run();


 
?>


```````

`/home/ramees/progs/php/sora/src/Helpers/Helper.php`:

```````php
<?php
namespace Sora\Helpers;

class Helper{
    public static function generate_token(): string {
        return bin2hex(random_bytes(32));
    }

    public static function validate_user(){
        if(!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }
    }

    public static function time_ago($timestamp) {
        $current_time = time();
        $time_difference = $current_time - strtotime($timestamp);
        
        // Define time intervals in seconds
        $intervals = array(
            'year'   => 31536000,
            'month'  => 2592000,
            'week'   => 604800,
            'day'    => 86400,
            'hour'   => 3600,
            'minute' => 60,
            'second' => 1
        );
        
        // Handle future dates
        if ($time_difference < 0) {
            return "just now";
        }
        
        // Handle very recent times
        if ($time_difference < 10) {
            return "just now";
        }
        
        // Find the appropriate interval
        foreach ($intervals as $interval => $seconds) {
            $difference = floor($time_difference / $seconds);
            
            if ($difference >= 1) {
                // Handle plural vs singular
                $interval_text = $difference == 1 ? $interval : $interval . 's';
                return $difference . " " . $interval_text . " ago";
            }
        }
    }
}

?>


```````

`/home/ramees/progs/php/sora/src/Config/Database.php`:

```````php
<?php



namespace Sora\Config;
/** Database class to return a database object */
class Database {
      public static function get_connection(): \mysqli {

        $env = parse_ini_file(__DIR__."/.env");
        $username = $env['USERNAME'];
        $passwd = $env['PASSWORD'];
        $hostname = $env['HOSTNAME'];
        $database = $env['DATABASE'];


        /**
         * @var mysqli $mysqli object to be returned
         *
         */
        $mysqli = new \mysqli(
            $hostname,     // Database host (e.g., 'localhost')
            $username, // Database username
            $passwd, // Database password
            $database  // Database name
        );

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}

?>

```````

`/home/ramees/progs/php/sora/src/Config/sora.sql`:

```````sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2024 at 06:56 PM
-- Server version: 11.4.2-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sora`
--
CREATE DATABASE IF NOT EXISTS `sora` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sora`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 8, 21, 'hi', '2024-10-31 13:54:29', '2024-10-31 13:54:29'),
(2, 8, 21, 'hello', '2024-10-31 13:54:32', '2024-10-31 13:54:32'),
(3, 8, 32, 'hi', '2024-10-31 13:59:05', '2024-10-31 13:59:05'),
(4, 8, 22, 'hi', '2024-10-31 14:20:51', '2024-10-31 14:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followed_id`, `created_at`) VALUES
(8, 6, '2024-10-22 22:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(76, 8, 29, '2024-10-24 18:21:05'),
(93, 6, 22, '2024-10-25 10:35:35'),
(94, 6, 21, '2024-10-25 10:35:37'),
(95, 6, 23, '2024-10-25 10:35:39'),
(99, 6, 28, '2024-10-25 17:39:52'),
(105, 8, 31, '2024-10-31 14:36:40'),
(118, 8, 32, '2024-10-31 14:37:04'),
(120, 8, 28, '2024-10-31 14:38:13'),
(126, 8, 30, '2024-10-31 14:40:50'),
(137, 8, 22, '2024-10-31 14:44:54'),
(138, 8, 23, '2024-10-31 15:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(21, 6, 'hellooo', '2024-10-18 09:32:45', '2024-10-18 09:32:45'),
(22, 6, 'haai guyysss\r\n', '2024-10-18 09:33:01', '2024-10-18 09:33:01'),
(23, 6, 'hiiii', '2024-10-18 09:37:11', '2024-10-18 09:37:11'),
(28, 8, 'hi\r\n', '2024-10-22 20:17:53', '2024-10-22 20:17:53'),
(29, 8, 'hi', '2024-10-22 20:26:52', '2024-10-22 20:26:52'),
(30, 8, 'hi', '2024-10-22 22:21:59', '2024-10-22 22:21:59'),
(31, 8, 'hello\r\n', '2024-10-23 05:21:57', '2024-10-23 05:21:57'),
(32, 8, 'hi', '2024-10-25 17:09:51', '2024-10-25 17:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `profile_picture`, `bio`, `created_at`, `updated_at`, `status`) VALUES
(6, 'Irene', 'J Kooran', 'irene', 'irene@gmail.com', '$2y$10$1z346OHrI8UQqkPyMNWS4e1SkrhvKJDpTtxCJ6Odk1t.CkF0dD6CC', '/images/icons/user-avatar.png', 'Hello guyss', '2024-10-18 09:32:40', '2024-10-31 14:12:07', 'hii guyss'),
(8, 'Ramees', 'Mohammed M M', 'ramees', 'rameesmohd2004@gmail.com', '$2y$10$YUoHmD.7bEGe/vqYJoJk1O199bzV1zziBycJooDKvIw.uw8W6QGYy', '/images/pfps/profile_8.png', 'C,C++, Rust Enthusiast, Systems Programmer', '2024-10-22 20:15:34', '2024-10-31 14:36:32', 'hi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_comments_post_id` (`post_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `idx_follows_follower_id` (`follower_id`),
  ADD KEY `idx_follows_followed_id` (`followed_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `idx_likes_post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `firstname` (`firstname`,`lastname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```````

`/home/ramees/progs/php/sora/src/Config/init.php`:

```````php
<?php

define("ROOT", __DIR__."/../../");
define("APPROOT", __DIR__."/../../public/");

?>

```````

`/home/ramees/progs/php/sora/src/Core/Router.php`:

```````php
<?php
namespace Sora\Core;

class Router {
    protected $routes = [];

    /**
     * Route GET requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function get($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Route POST requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function post($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Prepare route pattern by converting :any and :num to regex
     *
     * @param string $path Original route path
     * @return string Prepared route pattern
     */
    protected function prepareRoute($path) {
        $path = str_replace(
            array(':any', ':num'),
            array('([^/]+)', '([0-9]+)'),
            $path
        );
        return '#^' . $path . '/?$#';
    }

    /**
     * Match URI against route pattern
     *
     * @param string $pattern Route pattern
     * @param string $uri Request URI
     * @return bool|array False if no match, array of matches if found
     */
    protected function matchRoute($pattern, $uri) {
        $matches = array();
        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches); 
            return $matches;
        }
        return false;
    }

    /**
     * Dispatch to the routes from the URI
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (substr($uri, -1) === '/' && strlen($uri) > 1) {
            $uri = substr($uri, 0, -1);
        }

        // Check each route pattern for the current method
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $callback) {
                $matches = $this->matchRoute($pattern, $uri);
                         
                if ($matches !== false) {
                    if (is_callable($callback)) {
                        call_user_func_array($callback, $matches);
                        return;
                    } else if (is_array($callback)) {
                        $controller = new $callback[0]();
                        $method = $callback[1];
                        
                        if (method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], $matches);
                            return;
                        } else {
                            http_response_code(500);
                            echo "Error: Method '$method' not found in controller '$callback[0]'.";
                            return;
                        }
                    }
                }
            }
        }

        // No matching route found
        http_response_code(404);
        echo "404 Not Found\n";
        echo $_SERVER['REQUEST_URI'];
    }
}
```````

`/home/ramees/progs/php/sora/src/Core/Application.php`:

```````php
<?php

namespace Sora\Core;

class Application {
  public $router;


  public function __construct(Router $router){
    $this->router = $router;
  }

  public function run(){
    $this->router->dispatch();
  }
}
?>

```````

`/home/ramees/progs/php/sora/src/Controllers/HomeController.php`:

```````php
<?php 
namespace Sora\Controllers;
use \Sora\Helpers\Helper;

class HomeController{
  

  
  public function home(){

    Helper::validate_user();
    
    require "../src/Views/home.html";
    
    
  }

  public function login(){

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $this->home();
      
    }
    else{
      require_once __DIR__."/../Views/login.html";
    }
  }

  public function register() {
    if($_SERVER['REQUEST_METHOD'] == "POST"){

    }
    else{
      require_once __DIR__."/../Views/signup.html";
    }
  }
}

```````

`/home/ramees/progs/php/sora/src/Controllers/PostController.php`:

```````php
<?php
namespace Sora\Controllers;

use \Sora\Models\PostModel;
use \Sora\Config\Database;
use \Sora\Helpers\Helper;


class PostController {
    private $postModel;
    
    public function __construct(){
        $db = Database::get_connection();
        $this->postModel = new PostModel($db);

    }

    public function create(){
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $user_id = $_SESSION['user_id'];
            $content = $_POST['content'];
            
            if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
                unset($_SESSION['csrf_token']);
                http_response_code(400);
                exit;
            }
            else{
                unset($_SESSION['csrf_token']);
                if($this->postModel->create_post($user_id, $content)){
                   header("Location: /");
                   exit;
                } else{
                    $error[] = "Error creating post";
                }
            }
        }
        else{
            $errors[] = "invalid request method";
        }
    }

    public  function render_tweet($tweet){
        $is_liked = $this->postModel->check_user_likes($tweet["id"]);
        $like_class = $is_liked == 1 ? "liked" : "";
        $id = $tweet["id"];
        $username = $tweet["username"];
        $content = $tweet['content'];
        $created_at = Helper::time_ago($tweet['created_at']);
        $upvotes = $tweet['upvotes'] ?? 0;
        $comments = $tweet['comment_count'] ?? 0;
        $dp_available = $tweet['profile_picture'] ?? false;
        $comments_html = self::render_comments($id);
        if($dp_available){
            $pfp_avatar = <<<HTML
             <img src="{$tweet['profile_picture']}" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }

        else{
            $pfp_avatar = <<<HTML
            <img src="images/icons/user-avatar.png" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }
        $html = <<<HTML
    <div class="bg-gray-300 p-4 rounded-lg shadow opacity-95 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex items-center mb-2">
            $pfp_avatar
            <div>
                <a href="/profile/{$username}" class="font-bold text-slate-900 block">@{$username}</a>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{$created_at}</span>
                </div>
            </div>
        </div>
        <p class="mb-3 text-slate-900">{$content}</p>
        <div class="flex items-center space-x-4 text-gray-500">
            
            <button class="upvotes flex items-center space-x-1 hover:text-blue-500 transition duration-300 $like_class " data-post-id="$id" data-liked-id="$is_liked">
                <i class="fas fa-arrow-up"></i>
                <span id="upvotes">{$upvotes}</span>
            </button>
            <button class="flex items-center space-x-1 hover:text-green-500 transition duration-300 comment-toggle" data-post-id="$id">
            
                <i class="fas fa-comment"></i>
                <span>{$comments} comments</span>
            </button>
        </div>
        <div class="comments-section mt-4 hidden" id="comments-section-{$id}">
                <h4 class="text-lg font-semibold mb-2">Comments</h4>
                <div class="space-y-2 mb-4" id="comments-{$id}">
                    {$comments_html}
                </div>
                <form action="/add_comment" method="post" class="flex">
                    <input type="hidden" name="post_id" value="{$id}">
                    <input type="text" name="content" class="flex-grow p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Add a comment...">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition-colors duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        
    </div>
    HTML;
    return $html;

    }

    public function render_tweets($user_id=NULL, $self=false){
        if($user_id == NULL){

         $data = $this->postModel->get_tweets($_SESSION['user_id'], $self);
        }
        else{
            $data = $this->postModel->get_tweets($user_id, $self);
           
        }
        

        foreach($data as $tweet){
            $html = $this->render_tweet($tweet);
            echo $html;
        }
    
    }
    
    private static function render_comments($post_id) {
        $db = Database::get_connection();
        $postModel = new PostModel($db);
        $comments = $postModel->get_comments($post_id);

        $comments_html = '';
        foreach ($comments as $comment) {
            $comment_time = Helper::time_ago($comment['created_at']);
            $comments_html .= <<<HTML
            <div class="bg-gray-100 p-3 rounded-md">
                <p class="font-semibold text-sm">{$comment['username']}</p>
                <p class="text-gray-700">{$comment['content']}</p>
                <p class="text-xs text-gray-500 mt-1">{$comment_time}</p>
            </div>
            HTML;
        }

        return $comments_html;
    }
    


    public function add_likes()
{
    // Fetch the raw POST body and decode the JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->add_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like added successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}

public function remove_likes(){
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->remove_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like removed successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to remove like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}


public function add_comment() {
    Helper::validate_user();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        if ($this->postModel->add_comment($user_id, $post_id, $content)) {
            // Comment added successfully
            header("Location: /?post_id=" . $post_id);
            exit;
        } else {
            $error[] = "Error adding comment";
        }
    }
}

public function get_comments($post_id) {
    return $this->postModel->get_comments($post_id);
}

   
}

?>
```````

`/home/ramees/progs/php/sora/src/Controllers/UserController.php`:

```````php
<?php

namespace Sora\Controllers;
use Sora\Config\Database;
use Sora\Models\UserModel;
// require_once __DIR__ . "/../../vendor/autoload.php";
// session_start();

/** Controller class for User Model
 *
 */
class UserController {

  /**@var Sora\Models\User $userModel user model object
   */
  private $userModel;
  public $postController;
  
  /**Constructor for User Controller
   */

  public function __construct() {
  /** @var mysqli $db object returned from Sora\Config\Database::get_connection()
   */
  try{
  $db = Database::get_connection();
  }
  catch(Exception $e){
    echo "error getting a database connection";
    exit;
  }

  $this->userModel = new UserModel($db);
  $this->postController = new PostController();

    
  }

  public function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: /login');
    exit;
  }

  public function is_logged_in(): bool{
    return isset($_SESSION['user_id']);
  }


  public function register(): array {
    $response =  $this->userModel->register($_POST);
    if($response['success'] === true) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['user_id'] = $response['user']['id'];
      header('Location: /');
      exit;
    }
    else{
      $_SESSION['error'] = $response['error'];
    
      header('Location: /register');
      exit;
    }
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $response = $this->userModel->authenticate($username, $password);

    if (!$response['success']){
      $_SESSION['login_error'] = ["Username/Password incorrect"];
      header("Location: /login");
      exit;
    }
    session_regenerate_id(true);
    $_SESSION['username'] = $response['user']['username'];
    $_SESSION['user_id'] = $response['user']['id'];
    
    header('Location: /');
    exit;
    }
    else{
      include __DIR__."/../Views/login.html";
    }
  
  }

  public function profile($username=NULL) {
    if($username == NULL){
      if($_SERVER['REQUEST_METHOD'] == "GET"){
        $username = $_SESSION['username'];
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
        include __DIR__ ."/../Views/profile.html";
      
      }
    }
    else{
      if($username == $_SESSION["username"]){
        $username = $_SESSION['username'];
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
        header("Location: /profile");
        exit;
      }
      $user = $this->get_user_details($username);
      if (empty($user)){
        http_response_code(404);
        echo "404 Not Found\n";
        exit;
      }
      $this->render_profile($user);
    }
  } 

  protected function render_profile($user) {
    
    echo <<<BODY
    <body style="background: url('/images/sora-bg.png')" >
    BODY;
    
    $data = [];
    $data["user"] = $user;

    $data["posts"] = $this->userModel->get_user_posts($user["username"]);
    $data["likes"] = $this->userModel->get_user_likes($user["username"]);
    $data["comments"] = $this->userModel->get_user_comments($user["username"]);
    $data["followers"] = $this->userModel->get_user_followers($user["username"]);
    $data["following"] = $this->userModel->get_user_following($user["username"]);
    

    require __DIR__ ."/../Views/user_profile.html";
}

public function render_user_tweets($data){
  $posts = $data["posts"];
  $user_id = $data["user"]["id"];
  $this->postController->render_tweets($user_id);
}

  public function get_user_details($username) {
    $user = $this->userModel->get_user_details($username);
    return $user;


  }
  



  public function edit_user_details(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){


      $username = $_SESSION['username'];
      $password = $_POST['old_password'];
      $response = $this->userModel->authenticate($username, $password);
      if($response['success'] != true){
        $_SESSION['update_error'] = "Invalid Credentials";
        header("Location: /profile");
        exit;

      }
      else{
        $data = [
        "username" => $_POST['username'],
        "password" => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
        "firstname" => $_POST['firstname'] ?? "",
        "lastname" => $_POST['lastname'] ?? "",
        "bio" =>     $_POST['bio'],
        // "profile_picture" => $_FILES['profile_picture'] ?? "",
        ];

        if($_POST['new_password'] == ""){
          unset($data["password"]);
        }
        
        
      }
      if ($this->userModel->update_user_details($username, $data)) {
        // Success message (optional)
        $_SESSION['update_success'] = "Profile updated successfully!"; 
        $_SESSION['username'] = $data["username"];
      } else {
        // Handle the case where no changes were made (optional)
        $_SESSION['update_info'] = "No changes were made to your profile."; 
      }
      header("Location: /profile");
    }
  
    else{
      header("Location: /profile");
    }
  }
  


public function get_followed_users() {
  $user_id = $_SESSION['user_id'];
  $followed_users = $this->userModel->get_followed_users($user_id);
  echo json_encode($followed_users);
}

public function search_users() {
  $query = $_GET['query'] ?? '';
  $results = $this->userModel->search_users($query);
  $formatted_results = array_map(function($user) {
    return [
        'id' => $user['id'],
        'username' => $user['username'],
        'profile_picture' => $user['profile_picture'] ?? '/images/icons/user-avatar.png'
    ];
}, $results);

echo json_encode($formatted_results);
}

  


}

```````

`/home/ramees/progs/php/sora/src/Models/UserModel.php`:

```````php
<?php                                         
namespace Sora\Models;
// require_once __DIR__."../../vendor/autoload.php"; 
/** User class for handling user-related operations                                       
 */

class UserModel {  

		/** @var mysqli $db Database connection object */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object 
		*/                                                                                     
		public function __construct(\mysqli $db ) {                                                        
		$this->db = $db;                                                                        
		} 

		/**                                                                                     
		* Register a new user                                                                                                                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                     Expected keys: 'firstName', 'LastName',        
		*                                     'username', 'email',           
		*                                     'password', 'confirmPassword'.                                                                                                                   
		* @return (bool|string[]) An associative array with keys:                                        
		*             'success' (bool) - Whether the registration was successful.              
		*             'error' (string[])  - Any error messages if registration failed.            
		*/                                                                                     
	
	public function register(array $data): array {              
      $validatedResult = $this->validate_user_registration($data);
      if (!$validatedResult['isValid']) {
				return [
					'success' => 'false',
					'error'   => $validatedResult['error'],
					'user' => null
				];
			}
			$username  = $data['username'];
			$email = $data['email'];
			$firstName = $data['firstname'];
			$lastName = $data['lastname'];
			$password = $data['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);


			$stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? or email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				return [
					'success' => false,
					'error' => ["USER ALREADY EXISTS"],
					'user' => null,
				];
			}

			$stmt = $this->db->prepare("insert into users(firstname, lastname, username, email, password) 
				                          values(?,?,?,?,?)");
			$stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashed_password);
			if($stmt->execute()){
				$query = $this->db->prepare("select id from users where username = ?");
				$query->bind_param("s", $username);
				$query->execute();
				$result = $query->get_result();
				$user = $result->fetch_assoc();
				return [
					'success' => true,
					'error'   => null,
					'user' => $user,
				];
			}
			else {
				return [
					'success' => false,
					'error'   => ["cannot register user try again later."],
					'user' => null
				];
			}

		}                                                                                       

		/**                                                                                     
		* Authenticate a user                                                                  
		* @param string $username The username of the user                                     
		* @param string $password The 	password of the user                                    
		* @return string[] An array of user data if login is successful or null if it fails.
		* Expected keys: 'success' (bool),
		*                 'message' (string) - Login status message. 
		*                 'user'  (array) - user details.
		*/                                                                                     
	public function authenticate(string $username, string $password): ?array { 
       $stmt = $this->db->prepare("SELECT id, username, password FROM users where username = ? or email = ?" );
       $stmt->bind_param("ss", $username,$username);     
 			 $stmt->execute();
 			 $result = $stmt->get_result();

 			 if ($result->num_rows === 0) {
				 return [
					 'success' => false,
					 'message' => 'INVALID_DETAILS_ERROR',
				 ];
			 } 

			 $user = $result->fetch_assoc();

			 if(password_verify($password, $user['password'])) {

				 return [
					 'success' => true,
					 'message' => 'LOGIN_SUCCESSFUL',
					 'user' => $user,
				 ];
				 
			 }
			 else {
				 return [
					 'success' => false,
					 'message' => 'INVALID_PASSWORD_ERROR',
				 ];
			 }
		                                                               
		}


    


		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return string[]|null An array of user data if found, or null if not found.              
		*/                                                                                     
	public function find_user_by_email(string $email): array|null {                                               
	  $stmt = $this->db->prepare("select * from users where email=? limit 1"); 
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows() === 0) {
				return null;
			}
			else {
				$user = $result->fetch_assoc();
				return $user;
			}
		}                                                                                       
	
		/**                                                                                     
		* validate user registration data.                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                    Expected keys: 'firstName', 'LastName',         
		*                                    'username', 'email' ,            
		*                                     'password', 'confirmPassword'.                             
		* @return (bool|string[])[] An associative array with keys:                                        
		*               'isValid' (bool) - Whether the data is valid.                          
		*                'error' (?array) - Any validation error messages.                      
		*/                                                                                     
	private function validate_user_registration(array $data): array {                                
			$username = $data['username'];
			$firstName = $data['firstname'];
			$lastName = $data['lastname'];
			$password = $data['password'];
			$retype_password = $data['retype_password'];

			
			return [
				'isValid' => true,
				'error' => null
			];

	} 

public function get_user_details($username): array{
	$stmt = $this->db->prepare("SELECT * from users where username = ? limit 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
	$rows = $result->fetch_assoc();
	return $rows;
	}
	else{
		return Array();
	}
}

public function get_user_posts($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN users u ON p.user_id = u.id
	WHERE u.username = ?;");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_likes($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN likes l on p.id = l.post_id
	JOIN users u on l.user_id = u.id
	WHERE u.username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}

}

public function get_user_comments($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN comments c on c.post_id = p.id
	JOIN users u on c.user_id = u.id
	WHERE u.username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_followers($username){
	$stmt = $this->db->prepare("SELECT u.* 
	FROM users u
	JOIN follows f on u.id = f.follower_id
	WHERE f.followed_id = (SELECT  id from users where username = ?)");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_following($username){
	$stmt = $this->db->prepare("SELECT u.* 
	FROM users u
	JOIN follows f on u.id = f.followed_id
	WHERE f.follower_id = (SELECT  id from users where username = ?)");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}
private function handle_profile_picture($files, $action) {
	$userId = $_SESSION['user_id'];
	
	// Get current profile picture
	$stmt = $this->db->prepare("SELECT profile_picture FROM users WHERE id = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	$current_picture = $user['profile_picture'] ?? null;

	
			if (isset($files['profile_picture']) && $files['profile_picture']['error'] === UPLOAD_ERR_OK) {
				// Delete old file if exists
				if ($current_picture && file_exists($current_picture)) {
					unlink($current_picture);
				}
				
				// Handle new upload
				$file = $files['profile_picture'];
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$filename = 'profile_' . $userId .'.' . $ext;
				$upload_path = 'images/pfps/' . $filename;
				
				if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
					throw new \Exception("Failed to upload profile picture");
				}
				
				return $upload_path;
			}
			
		
	
	return null;
}

public function update_user_details($username, $data){
	$update_fields = array();
	if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["name"] != ""  ){

	$uploadfile = $this->handle_profile_picture($_FILES, 'update');
	move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadfile);
	$data["profile_picture"] = "/".$uploadfile;
	

	}

	if($_POST["profile_picture_state"] === "delete"){
		$data["profile_picture"] = "/images/icons/user-avatar.png";
	}
	
	

		$original_fields = $this->get_user_details($username);
		// if($data["profile_picture"] == "./images/pfps/"){
		// 	$data["profile_picture"] = NULL;
		// }
		if(!isset($_FILES["profile_picture"]) && file_exists($original_fields["profile_picture"])){
			unlink($current_picture);
		}
		if($original_fields){
			foreach($data as $field => $value){
				if ($original_fields[$field] !== $value){
					$update_fields[$field] = $value;
				}
			}
			return $this->update($username, $update_fields);
		}
		else{
			return false;
		}
}

function update($username, $data){
	
	if (!empty($data)){
		$sql = "UPDATE users set ";
		foreach($data as $key => $value){
			$sql .= "$key = '$value', ";

		}
		$sql = rtrim($sql, ", ");
		$sql .= " WHERE username=?";
		

		$stmt = $this->db->prepare($sql);
		
		$stmt->bind_param("s", $username);
		
		
		return $stmt->execute();
	}
	else{
		return false;
	}
	
}



public function get_followed_users($user_id) {
    $stmt = $this->db->prepare("
        SELECT u.id, u.username, u.profile_picture
        FROM users u
        JOIN follows f ON u.id = f.followed_id
        WHERE f.follower_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function search_users($query) {
    $query = "%$query%";
    $stmt = $this->db->prepare("
        SELECT id, username, profile_picture
        FROM users
        WHERE username LIKE ?
        LIMIT 10
    ");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

}                   

function test_input(string $data): string{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;

}

                                                                                      
?>

```````

`/home/ramees/progs/php/sora/src/Models/PostModel.php`:

```````php
<?php
namespace Sora\Models;

class PostModel{
    private \mysqli $db;
    public function __construct(\mysqli $db){
        $this->db = $db;

    }

    public function create_post($user_id, $content): bool{

        
        $stmt =  $this->db->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");

        $stmt->bind_param("is", $user_id, $content);
        return $stmt->execute();

    }

    public function view_posts(): array{
        $stmt = $this->db->prepare("Select * from posts");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;

        }
        else {
            return [
                'error' => 'NO_RESULT'  
            ];
        }
    }
    // self variable to check if the user wants only his/her posts

    public function get_tweets($user_id, $self=false) {
        if($user_id == $_SESSION["user_id"] && $self==false){
        $stmt = $this->db->prepare("SELECT 
                p.id, 
                p.content, 
                p.created_at,
                u.username, 
                u.profile_picture,
                COUNT(l.post_id) AS upvotes,
                COUNT(DISTINCT c.id) AS comment_count
            FROM 
                posts p
            JOIN 
                users u ON p.user_id = u.id 
            LEFT JOIN 
                likes l ON p.id = l.post_id
            LEFT JOIN
                follows f ON p.user_id = f.followed_id AND f.follower_id = ? 
            LEFT JOIN
                 comments c on p.id = c.post_id
            WHERE 
                p.user_id = ? OR f.follower_id = ?
            GROUP BY
                p.id
            ORDER BY 
                p.created_at DESC;");
              $stmt->bind_param("iii", $user_id, $user_id, $user_id);
        }
        else if($user_id == $_SESSION["user_id"] && $self==true){
            $stmt = $this->db->prepare("SELECT 
            p.id, 
            p.content, 
            p.created_at,
            u.username, 
            u.profile_picture,
            COUNT(l.post_id) AS upvotes,
            COUNT(DISTINCT c.id) AS comment_count
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.id 
        LEFT JOIN 
            likes l ON p.id = l.post_id
        LEFT JOIN 
            comments c on p.id = c.post_id
         
        WHERE 
            p.user_id = ? 
        GROUP BY
            p.id
        ORDER BY 
            p.created_at DESC;");
            
        $stmt->bind_param("i", $_SESSION["user_id"]);

        }
        else{
            $stmt = $this->db->prepare("SELECT 
            p.id, 
            p.content, 
            p.created_at,
            u.username, 
            u.profile_picture,
            COUNT(l.post_id) AS upvotes,
            COUNT(DISTINCT c.id) AS comment_count
            
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.id 
        LEFT JOIN 
            likes l ON p.id = l.post_id
        LEFT JOIN comments c on p.id = c.post_id
         
        WHERE 
            p.user_id = ? 
        GROUP BY
            p.id
        ORDER BY 
            p.created_at DESC;");
        $stmt->bind_param("i", $user_id);
        }
        
    
       
    
        $stmt->execute();
    
        $result = $stmt->get_result();
        
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add_likes($post_id){
        
        $user_id = $_SESSION['user_id'];
       

            $stmt = $this->db->prepare("insert ignore into likes(user_id, post_id) values(?,?)");
            $stmt->bind_param("ss",$user_id, $post_id );
            $result = $stmt->execute();
            return $result;

    }

    public function remove_likes($post_id) {
        $user_id = $_SESSION['user_id'];

        $stmt = $this->db->prepare("delete from likes where user_id=? and post_id=?");
        $stmt->bind_param("ss", $user_id, $post_id);
        $result = $stmt->execute();
        return $result;
    }
    
    public function check_user_likes($post_id){
        if(!isset($_SESSION["user_id"])){
            return false;
        }
        else {

            $user_id = $_SESSION["user_id"];
            $stmt = $this->db->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ? LIMIT 1");
            if (!$stmt) {
              error_log("Error preparing statement: " . $this->db->error);
             return false;
            }

    // Bind parameters with error handling
        if (!$stmt->bind_param("ss", $post_id, $user_id)) {
            error_log("Error binding parameters: " . $stmt->error);
           $stmt->close();
           return false;
        }

    // Execute with error handling
        if (!$stmt->execute()) {
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false;
        }

    // Get result
        $result = $stmt->get_result();
        if (!$result) {
            error_log("Error getting result: " . $stmt->error);
            $stmt->close();
            return false;
        }

    // Get row count and clean up
        $has_liked = $result->num_rows;
        $result->close();
        $stmt->close();

        return $has_liked;
        }
        
    }


    public function add_comment() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['user_id'];
            $post_id = $_POST['post_id'];
            $content = $_POST['content'];

            if ($this->postModel->add_comment($user_id, $post_id, $content)) {
                // Comment added successfully
                header("Location: /#post-" . $post_id);
                exit;
            } else {
                $_SESSION['error'] = "Error adding comment";
                header("Location: /#post-" . $post_id);
                exit;
            }
        }
    }

    public function get_comments($post_id) {
        $stmt = $this->db->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.created_at DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
}
```````

`/home/ramees/progs/php/sora/src/Views/navbar.html`:

```````html
<header class="bg-gradient-to-r flex  from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg w-full">
    <nav class=" md:mx-0 mx-auto flex-grow flex justify-between items-center w-full">
        <span class="text-2xl sm:text-3xl md:text-4xl font-bold"><a href="/"> SORA</a></span>
         
        <div class="sm:flex hidden md:flex items-center md:space-x-8 md:mr-12"> 
            <a href="/profile" class="text-white text-lg hover:text-sora-bg transition-colors duration-300">
                <i class="fas fa-user mr-2"></i><?=$_SESSION['username']??'Profile'?>
            </a>
            <a href="/logout" class="text-white text-lg hover:text-sora-bg transition-colors duration-300">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>
        
        <button class="md:hidden text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
</header>
```````

`/home/ramees/progs/php/sora/src/Views/login.html`:

```````html
<!DOCTYPE html>
<html class="h-full sm:overflow-y-auto md:overflow-hidden" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login | SORA</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="h-full bg-gray-100 text-sora-text"> 
    <header class="bg-gradient-to-r from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg"> 
        <nav class="text-2xl sm:text-3xl md:text-4xl font-bold">SORA</nav>
    </header>
    <main class="h-full text-sora-text"> 

        <div
            class="flex flex-col sm:flex-row gap-7 sm:gap-15 md:gap-[7em] justify-center items-center p-4 sm:p-8 md:p-12 min-h-[calc(100vh-4rem)]">
            <div
                class="login-card  p-6 flex items-center justify-center rounded-md shadow-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md">
                <div class="login w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/login" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Login</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="password" required>
                        </div>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['login_error'])){
                            echo implode("<br>", $_SESSION['login_error']); 
                            $_SESSION['login_error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Login</button>
                    </form>
                </div>
            </div>

            <div class="signup-card  p-6 flex items-center justify-center rounded-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md  shadow-md">
                <div class="signup w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/register" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Signup</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-email">Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" name="email" id="signup-email" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-first-name">First Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="firstname" id="signup-first-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-last-name">Last Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="lastname" id="signup-last-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="signup-username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="signup-password" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-retype-password">Retype
                                Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="retype_password" id="signup-retype-password" required>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Signup</button>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['error'])){
                            echo implode("<br>", $_SESSION['error']); 
                            $_SESSION['error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        let login_card = document.querySelector(".login-card");
        let signup_card = document.querySelector(".signup-card");

        let styles_array = ["bg-gray-200", "shadow-md"];

        login_card.addEventListener("mouseenter", () => {
            login_card.classList.add(...styles_array);
            signup_card.classList.remove(...styles_array);
        });

        signup_card.addEventListener("mouseenter", () => {
            signup_card.classList.add(...styles_array);
            login_card.classList.remove(...styles_array);
        });

        let error = document.querySelector(".error");
        if (error.textContent.trim() !== "") {
            error.classList.remove("hidden");
            document.querySelector("html").classList.add("md:overflow-y-auto");
        }
    </script>
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/profile.html`:

```````html
<!DOCTYPE html>
<html lang="en" class=" sm:overflow-y-auto md:overflow-auto">
<?php include_once __DIR__."/html_head.html" ?>

<body style="background: url('images/sora-bg.png'); background-repeat: no-repeat; background-size:cover"
    class="bg-no-repeat bg-center">
    <?php include_once __DIR__ ."/navbar.html"?>

    <?php
    use Sora\Controllers\UserController;
    $userController = new UserController();
    $user = $userController->get_user_details($_SESSION['username']);
    ?>

    <!-- Profile View (Default) -->
    <main class="min-h-screen py-12 px-4 sm:px-6 lg:px-8  ">
        <div class="max-w-3xl mx-auto">
            <!-- Profile Card (Visible when not editing) -->
            <div id="profile-view" class="bg-white rounded-xl shadow-lg p-6 sm:p-8 mb-6">
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6">
                    <div class="relative group">
                        <div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                            <?php if(isset($user['profile_picture']) && !empty($user['profile_picture'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile"
                                class="h-full w-full object-cover">
                            <?php else: ?>
                            <svg class="h-full w-full text-gray-400 p-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">
                            <?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
                        </h2>
                        <p class="text-gray-500 mb-2">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </p>
                        <p class="text-gray-700">
                            <?php echo htmlspecialchars($user['bio'] ?? 'No bio added yet'); ?>
                        </p>
                    </div>
                    
                    <button onclick="toggleEdit()"
                        class="inline-flex items-center px-4 py-2 border border-violet-600 rounded-md shadow-sm text-sm font-medium text-violet-600 bg-white hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profile
                    </button>
                </div>
                <div class="border-t border-b border-gray-200 mt-4 py-3">
                    <div class="flex justify-around items-center gap-3">
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900"><?php echo count($data['posts']); ?></span>
                            <span class="text-sm text-gray-500">Posts</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900"><?php echo count($data['followers']); ?></span>
                            <span class="text-sm text-gray-500">Followers</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900"><?php echo count($data['following']); ?></span>
                            <span class="text-sm text-gray-500">Following</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form (Hidden by default) -->
            <div id="edit-form" class="hidden bg-white rounded-xl shadow-lg p-6 sm:p-8">
                <form action="/edit_profile" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-6">
                            <div class="relative group">
                                <div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                                    <?php if(isset($user['profile_picture']) && !empty($user['profile_picture'])): ?>
                                    <img id="preview-image"
                                        src="<?php echo htmlspecialchars('../'.$user['profile_picture']); ?>"
                                        alt="Profile" class="h-full w-full object-cover">
                                    <?php else: ?>
                                    <img id="preview-image" src="#" alt="Profile"
                                        class="h-full w-full object-cover hidden">
                                    <svg id="default-image" class="h-full w-full text-gray-400 p-6" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php endif; ?>
                                </div>
                                <!-- Upload button -->
                                <label
                                    class="absolute bottom-0 right-0 bg-violet-600 rounded-full p-2 cursor-pointer hover:bg-violet-700 transition-colors">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <input type="file" name="profile_picture" id="profile-picture-input"
                                        accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <input type="text" name="profile_picture_state" id="profile-picture-state" 
                                    class="hidden" value="update">
                                </label>
                                <!-- Delete button -->
                                <button type="button" id="delete-image-btn" onclick="deleteProfilePicture()"
                                    class="absolute -top-2 -right-2 bg-red-500 rounded-full p-1 cursor-pointer hover:bg-red-600 transition-colors">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <!-- Hidden input to track deletion -->
                                <input type="hidden" name="delete_profile_picture" id="delete-profile-picture"
                                    value="0">
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Profile photo</h3>
                                <p class="text-xs text-gray-500">JPG, PNG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>


                    <!-- Bio Section -->
                    <div class="relative mb-8">
                        <textarea name="bio" rows="4"
                            class="peer w-full px-4 py-3 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all resize-none"
                            placeholder="Write something about yourself..."><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                        <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                            Bio
                        </label>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="relative">
                            <input type="text" name="username"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['username']); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Username
                            </label>
                        </div>

                        <div class="relative">
                            <input type="text" name="firstname"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                First name
                            </label>
                        </div>

                        <div class="relative">
                            <input type="text" name="lastname"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Last name
                            </label>
                        </div>

                        <div class="relative">
                            <input type="email" name="email"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['email']); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Email
                            </label>
                        </div>

                        <div class="relative">
                            <input type="password" name="old_password"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                placeholder="Enter your current password" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Current Password
                            </label>
                        </div>

                        <div class="relative">
                            <input type="password" name="new_password"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                placeholder="Leave blank to keep current password" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                New Password
                            </label>
                        </div>


                    </div>

                    <!-- Buttons -->
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end space-y-4 space-y-reverse sm:space-y-0 sm:space-x-4">
                        <button type="button" onclick="toggleEdit()"
                            class="w-full sm:w-auto px-6 py-3 text-sm font-medium text-violet-600 bg-white border border-violet-600 rounded-lg hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex flex-col space-y-4 overflow-y-auto">
            <?php
            $this->postController->render_tweets( $_SESSION["user_id"], $self=true);

            ?>
            </div>
        </div>
    </main>
    <style>
        /* Upvote button styles */
        .upvotes {
            transition: color 0.2s ease-in-out;
        }

        .upvotes.liked {
            color: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes.liked svg {
            stroke: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes:hover {
            color: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes:hover svg {
            stroke: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes svg {
            transition: stroke 0.2s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all upvote buttons
            document.querySelectorAll('.upvotes').forEach(button => {
                button.addEventListener('click', handleLike);
            });

            async function handleLike(event) {
                const button = event.currentTarget;
                const postId = button.dataset.postId;
                const isLiked = button.dataset.likedId === "1";
                const upvoteSpan = button.querySelector('#upvotes');
                const currentUpvotes = parseInt(upvoteSpan.textContent);

                try {
                    const endpoint = isLiked ? '/remove_likes' : '/add_likes';
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ post_id: postId })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Toggle the liked state
                        button.dataset.likedId = isLiked ? "0" : "1";
                        button.classList.toggle('liked');

                        // Update the upvote count
                        upvoteSpan.textContent = isLiked ?
                            (currentUpvotes - 1) :
                            (currentUpvotes + 1);
                    } else {
                        console.error('Error:', data.message);
                        // alert('Failed to update like. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // alert('Failed to update like. Please try again.');
                }
            }
        });
    </script>

    <script>
        function toggleEdit() {
            const profileView = document.getElementById('profile-view');
            const editForm = document.getElementById('edit-form');

            if (profileView.classList.contains('hidden')) {
                profileView.classList.remove('hidden');
                editForm.classList.add('hidden');
            } else {
                profileView.classList.add('hidden');
                editForm.classList.remove('hidden');
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview-image');
                    const fileInput = document.getElementById('profile-picture-input');
                    const defaultImage = document.getElementById('default-image');
                    const deleteButton = document.getElementById('delete-image-btn');
                    const profileState = document.querySelector("#profile-picture-state");

                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    deleteButton.style.display = 'block';
                    document.getElementById('delete-profile-picture').value = "0";

                    if (defaultImage) {
                        defaultImage.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteProfilePicture() {
            const preview = document.getElementById('preview-image');
            const defaultImage = document.getElementById('default-image');
            const fileInput = document.getElementById('profile-picture-input');
            const deleteButton = document.getElementById('delete-image-btn');
            const deleteFlag = document.getElementById('delete-profile-picture');
            const profileState = document.querySelector("#profile-picture-state");


            // Reset the file input
            fileInput.value = '';
            profileState.value="delete";

            // Show default image
            preview.classList.add('hidden');
            preview.src = '#';
            if (defaultImage) {
                defaultImage.classList.remove('hidden');
            }

            // Set delete flag to true
            deleteFlag.value = "1";

            // Hide delete button if there's no default profile picture
            if (!preview.src || preview.src === window.location.href) {
                deleteButton.style.display = 'none';
            }
        }

        // Initialize delete button visibility
        document.addEventListener('DOMContentLoaded', function () {
            const preview = document.getElementById('preview-image');
            const deleteButton = document.getElementById('delete-image-btn');

            if (!preview.src || preview.src === window.location.href || preview.classList.contains('hidden')) {
                deleteButton.style.display = 'none';
            }
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comment toggle functionality
            const commentToggles = document.querySelectorAll('.comment-toggle');
            commentToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const postId = toggle.getAttribute('data-post-id');
                    const commentsSection = document.getElementById(`comments-section-${postId}`);
                    commentsSection.classList.toggle('hidden');
                });
            });
        
            // Comment submission
            const commentForms = document.querySelectorAll('form[action="/add_comment"]');
            commentForms.forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    const response = await fetch('/add_comment', {
                        method: 'POST',
                        body: formData
                    });
        
                    if (response.ok) {
                        const postId = formData.get('post_id');
                        const content = formData.get('content');
                        const commentsContainer = document.getElementById(`comments-${postId}`);
                        const newComment = document.createElement('div');
                        newComment.className = 'bg-gray-100 p-3 rounded-md';
                        newComment.innerHTML = 
                        '<p class="font-semibold text-sm">' + <?php echo json_encode($_SESSION['username']); ?> + '</p>' +
                        '<p class="text-gray-700">' + content + '</p>' +
                        '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                        commentsContainer.prepend(newComment);
                        form.reset();
        
                        // Update comment count
                        const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                        const countSpan = commentToggle.querySelector('span');
                        const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                        countSpan.textContent = `${currentCount + 1} comments`;
                    }
                });
            });
        });
        </script>
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/signup.html`:

```````html
<!DOCTYPE html>
<html class="h-full sm:overflow-y-auto md:overflow-hidden" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login | SORA</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="h-full bg-gray-100 text-sora-text"> 
    <header class="bg-gradient-to-r from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg"> 
        <nav class="text-2xl sm:text-3xl md:text-4xl font-bold">SORA</nav>
    </header>
    <main class="h-full text-sora-text"> 

        <div
            class="flex flex-col sm:flex-row gap-7 sm:gap-15 md:gap-[7em] justify-center items-center p-4 sm:p-8 md:p-12 min-h-[calc(100vh-4rem)]">

            <div class="signup-card  p-6 flex items-center justify-center rounded-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md  shadow-md">
                <div class="signup w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/register" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Signup</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-email">Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" name="email" id="signup-email" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-first-name">First Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="firstname" id="signup-first-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-last-name">Last Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="lastname" id="signup-last-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="signup-username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="signup-password" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-retype-password">Retype
                                Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="retype_password" id="signup-retype-password" required>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Signup</button>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['error'])){
                            echo implode("<br>", $_SESSION['error']); 
                            $_SESSION['error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="login-card  p-6 flex items-center justify-center rounded-md shadow-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md">
                <div class="login w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/login" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Login</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="password" required>
                        </div>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['login_error'])){
                            echo implode("<br>", $_SESSION['login_error']); 
                            $_SESSION['login_error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        let login_card = document.querySelector(".login-card");
        let signup_card = document.querySelector(".signup-card");

        let styles_array = ["bg-gray-200", "shadow-md"];

        login_card.addEventListener("mouseenter", () => {
            login_card.classList.add(...styles_array);
            signup_card.classList.remove(...styles_array);
        });

        signup_card.addEventListener("mouseenter", () => {
            signup_card.classList.add(...styles_array);
            login_card.classList.remove(...styles_array);
        });

        let error = document.querySelector(".error");
        if (error.textContent.trim() !== "") {
            error.classList.remove("hidden");
            document.querySelector("html").classList.add("md:overflow-y-auto");
        }
    </script>
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/home.html`:

```````html
<!DOCTYPE html>
<html class="h-full" lang="en">
<?php include_once __DIR__."/html_head.html"?>
<body class="h-full text-gray-900 flex flex-col w-full" style="background: url('/images/sora-bg.png')">
       
<?php include_once __DIR__."/navbar.html" ?>
    <main class="flex-grow flex overflow-hidden">
        <aside class="w-64 bg-gray-100 opacity-85 shadow-lg overflow-y-auto hidden md:block">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 text-sora-primary">Peeps</h2>
                <div class="space-y-4">
                    <div class="bg-gray-300 rounded-lg p-4 transition duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Followed Users</h3>
                        <ul class="space-y-3" id="followed-users-list">
                            <!-- Followed users will be populated here -->
                        </ul>
                    </div>
                    <div class="bg-gray-300 rounded-lg p-4 transition duration-300 hover:shadow-md">
                        <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Search Users</h3>
                        <input type="text" id="user-search" class="w-full p-2 rounded-md" placeholder="Search users...">
                        <ul class="space-y-3 mt-3" id="search-results">
                            <!-- Search results will be populated here -->
                        </ul>
                    </div>
                </div>
            </div>
        </aside> 

        <div class="flex-grow flex flex-col overflow-hidden">
            <section class="flex-grow p-4 overflow-y-auto">
                <h1 class="text-2xl font-bold mb-4 text-sora-primary bg-gray-300 w-fit p-2 rounded-md shadow-md">Tweets</h1>
                <div class="space-y-4">
                    <?php
                    use Sora\Controllers\PostController;
                    
                    $postController = new PostController();
                    $postController->render_tweets();
                    ?>
                </div>
            </section>
            <footer class="bg-gradient-to-r from-sora-primary to-sora-secondary p-4 shadow-lg m-2 rounded-lg">
                <div class="max-w-4xl mx-auto">
                    <form action="/create" method="post" class="flex flex-col sm:flex-row sm:items-end items-center gap-3">
                        <div class="relative flex-grow">
                            <textarea name="content" id="tweet" rows="3" class="w-full p-3 pr-12 rounded-lg resize-none bg-white bg-opacity-90 focus:ring-2 focus:ring-sora-bg focus:outline-none placeholder-gray-500" placeholder="What's on your mind?"></textarea>
                            <div class="absolute bottom-3 right-3 flex space-x-2">
                            </div>
                        </div>
                        <?php 
                        use Sora\Helpers\Helper;
                        $_SESSION['csrf_token'] = Helper::generate_token()
                        ?>
                        <input type="hidden" name="csrf_token" value=<?=$_SESSION['csrf_token'] ?>>
                        <button name="post-btn" class="bg-sora-bg text-sora-primary py-2 px-6 rounded-full hover:bg-white hover:text-sora-secondary transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-sora-bg">
                            <i class="fas fa-paper-plane mr-2"></i>Post
                        </button>
                    </form>
                </div>
            </footer>
        </div>

        <style>
            /* Upvote button styles */
            .upvotes {
                transition: color 0.2s ease-in-out;
            }

            .upvotes.liked {
                color: #3b82f6; /* Tailwind blue-500 */
            }

            .upvotes.liked svg {
                stroke: #3b82f6; /* Tailwind blue-500 */
            }

            .upvotes:hover {
                color: #60a5fa; /* Tailwind blue-400 for hover */
            }

            .upvotes:hover svg {
                stroke: #60a5fa; /* Tailwind blue-400 for hover */
            }

            .upvotes svg {
                transition: stroke 0.2s ease-in-out;
            }
        </style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all upvote buttons
    document.querySelectorAll('.upvotes').forEach(button => {
        button.addEventListener('click', handleLike);
    });

    async function handleLike(event) {
        const button = event.currentTarget;
        const postId = button.dataset.postId;
        const isLiked = button.dataset.likedId === "1";
        const upvoteSpan = button.querySelector('#upvotes');
        const currentUpvotes = parseInt(upvoteSpan.textContent);

        try {
            const endpoint = isLiked ? '/remove_likes' : '/add_likes';
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ post_id: postId })
            });

            const data = await response.json();

            if (data.status === 'success') {
                // Toggle the liked state
                button.dataset.likedId = isLiked ? "0" : "1";
                button.classList.toggle('liked');
                
                // Update the upvote count
                upvoteSpan.textContent = isLiked ? 
                    (currentUpvotes - 1) : 
                    (currentUpvotes + 1);
            } else {
                console.error('Error:', data.message);
                // alert('Failed to update like. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            // alert('Failed to update like. Please try again.');
        }
    }
});
    </script>   

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Comment toggle functionality
        const commentToggles = document.querySelectorAll('.comment-toggle');
        commentToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const postId = toggle.getAttribute('data-post-id');
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                commentsSection.classList.toggle('hidden');
            });
        });
    
        // Comment submission
        const commentForms = document.querySelectorAll('form[action="/add_comment"]');
        commentForms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const response = await fetch('/add_comment', {
                    method: 'POST',
                    body: formData
                });
    
                if (response.ok) {
                    const postId = formData.get('post_id');
                    const content = formData.get('content');
                    const commentsContainer = document.getElementById(`comments-${postId}`);
                    const newComment = document.createElement('div');
                    newComment.className = 'bg-gray-100 p-3 rounded-md';
                    newComment.innerHTML = 
                    '<p class="font-semibold text-sm">' + <?php echo json_encode($_SESSION['username']); ?> + '</p>' +
                    '<p class="text-gray-700">' + content + '</p>' +
                    '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                    commentsContainer.prepend(newComment);
                    form.reset();
    
                    // Update comment count
                    const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                    const countSpan = commentToggle.querySelector('span');
                    const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                    countSpan.textContent = `${currentCount + 1} comments`;
                }
            });
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded' , function() {
    // Load followed users
    fetch('/get_followed_users')
        .then(response => response.json())
        .then(users => {
            const usersList = document.getElementById('followed-users-list');
            users.forEach(user => {
                const li = document.createElement('li');
                li.className = 'flex items-center space-x-3';
                li.innerHTML = `
                    <div class="relative">
                        <img src="${user.profile_picture || '/images/icons/user-avatar.png'}" alt="${user.username}" class="w-10 h-10 rounded-full">
                    </div>
                    <span class="font-medium">${user.username}</span>
                `;
                usersList.appendChild(li);
            });
        });

    // Handle user search
    const searchInput = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');

    searchInput.addEventListener('input', debounce(function() {
        console.log("in here");
        const query = this.value;
        if (query.length < 1) {
            searchResults.innerHTML = '';
            return;
        }

        fetch(`/search_users?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(users => {
                searchResults.innerHTML = '';
                users.forEach(user => {
                    const li = document.createElement('li');
                    li.className = 'flex items-center space-x-3';
                    li.innerHTML = `
                        <div class="relative">
                            <img src="${user.profile_picture || '/images/icons/user-avatar.png'}" alt="${user.username}" class="w-10 h-10 rounded-full">
                        </div>
                        <a href="/profile/${user.username}" class="font-medium">${user.username}</a>
                    `;
                    searchResults.appendChild(li);
                });
            });
    }, 100));

    // Debounce function to limit API calls
    function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }
});
</script>

    </main>
</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/html_head.html`:

```````html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Sora</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
```````

`/home/ramees/progs/php/sora/src/Views/user_profile.html`:

```````html
<?php
require __DIR__ . "/../Views/html_head.html";
require __DIR__ . "/../Views/navbar.html";


?>


<main class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                        <img src="<?=$user['profile_picture']?>" alt="<?= $user['username']?>'s avatar"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            <?=$user["username"]?>
                        </h1>
                        <!-- <p class="text-gray-500">Student at University</p>
                        <p class="text-gray-600 mt-1">
                            <i class="fas fa-map-marker-alt"></i> Kerala, India
                        </p> -->
                    </div>
                </div>
                <div class="space-x-3">
                    <button
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Follow
                    </button>
                </div>
            </div>

            <p class="text-gray-700 mb-6">
                <?= $user["bio"]?>
            </p>

            <div class="flex space-x-8">
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["posts"])?>
                    </div>
                    <div class="text-gray-500">Posts</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["followers"])?>
                    </div>
                    <div class="text-gray-500">Followers</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["following"])?>
                    </div>
                    <div class="text-gray-500">Following</div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 bg-gray-100 pt-3 px-4 rounded-md mb-6 hover:shadow-md">
            <nav class="-mb-px flex space-x-8">
                <a href="#" class="border-b-2 border-blue-500 pb-4 px-1 text-sm font-medium text-blue-600">
                    Posts
                </a>
                <a href="#"
                    class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Comments
                </a>
                <a href="#"
                    class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Likes
                </a>
            </nav>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 gap-6">
            <!-- <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-800">Just deployed my first web application! Check it out at example.com #webdev #coding</p>
                <div class="mt-4 text-gray-500 text-sm">
                    2 hours ago
                </div>
            </div> -->

            <?php $this->render_user_tweets($data); ?>

        </div>
    </div>
    <style>
        /* Upvote button styles */
        .upvotes {
            transition: color 0.2s ease-in-out;
        }

        .upvotes.liked {
            color: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes.liked svg {
            stroke: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes:hover {
            color: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes:hover svg {
            stroke: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes svg {
            transition: stroke 0.2s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all upvote buttons
            document.querySelectorAll('.upvotes').forEach(button => {
                button.addEventListener('click', handleLike);
            });

            async function handleLike(event) {
                const button = event.currentTarget;
                const postId = button.dataset.postId;
                const isLiked = button.dataset.likedId === "1";
                const upvoteSpan = button.querySelector('#upvotes');
                const currentUpvotes = parseInt(upvoteSpan.textContent);

                try {
                    const endpoint = isLiked ? '/remove_likes' : '/add_likes';
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ post_id: postId })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Toggle the liked state
                        button.dataset.likedId = isLiked ? "0" : "1";
                        button.classList.toggle('liked');

                        // Update the upvote count
                        upvoteSpan.textContent = isLiked ?
                            (currentUpvotes - 1) :
                            (currentUpvotes + 1);
                    } else {
                        console.error('Error:', data.message);
                        // alert('Failed to update like. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // alert('Failed to update like. Please try again.');
                }
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Comment toggle functionality
        const commentToggles = document.querySelectorAll('.comment-toggle');
        commentToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const postId = toggle.getAttribute('data-post-id');
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                commentsSection.classList.toggle('hidden');
            });
        });
    
        // Comment submission
        const commentForms = document.querySelectorAll('form[action="/add_comment"]');
        commentForms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const response = await fetch('/add_comment', {
                    method: 'POST',
                    body: formData
                });
    
                if (response.ok) {
                    const postId = formData.get('post_id');
                    const content = formData.get('content');
                    const commentsContainer = document.getElementById(`comments-${postId}`);
                    const newComment = document.createElement('div');
                    newComment.className = 'bg-gray-100 p-3 rounded-md';
                    newComment.innerHTML = 
                    '<p class="font-semibold text-sm">' + <?php echo json_encode($_SESSION['username']); ?> + '</p>' +
                    '<p class="text-gray-700">' + content + '</p>' +
                    '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                    commentsContainer.prepend(newComment);
                    form.reset();
    
                    // Update comment count
                    const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                    const countSpan = commentToggle.querySelector('span');
                    const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                    countSpan.textContent = `${currentCount + 1} comments`;
                }
            });
        });
    });
    </script>
</main>

</body>
```````

`/home/ramees/progs/php/sora/README.md`:

```````md
# സൊറ 
Micro blogging Social media platform for cs department U.C College

```````